<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusUpdatedMail;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function getList()
    {
        $all_bills = Bill::with(['customer', 'bill_detail.product'])->orderBy('id', 'DESC')->get();

        // Phân loại đơn hàng để hiển thị theo Tab trong báo cáo
        $bills_new = $all_bills->where('status', 'Mới');
        $bills_shipping = $all_bills->where('status', 'Đang giao');
        $bills_completed = $all_bills->where('status', 'Đã giao');
        $bills_canceled = $all_bills->where('status', 'Đã hủy');

        return view('admin.order.list', compact('all_bills', 'bills_new', 'bills_shipping', 'bills_completed', 'bills_canceled'));
    }

    public function getDelete($id)
    {
        DB::transaction(function () use ($id) {
            $bill = Bill::find($id);
            if ($bill) {
                BillDetail::where('id_bill', $id)->delete();
                $bill->delete();
            }
        });

        return redirect()->route('admin.order.list')->with('success', 'Xoa thanh cong');
    }

    public function postUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Mới,Đang giao,Đã giao,Đã hủy',
        ]);

        $bill = Bill::with('customer')->find($id);
        if (! $bill) {
            return redirect()->route('admin.order.list')->with('error', 'Không tìm thấy hóa đơn');
        }

        $oldStatus = $bill->status;
        $newStatus = $request->input('status');

        if ($oldStatus === $newStatus) {
            return redirect()->back()->with('success', 'Trạng thái không thay đổi');
        }

        $bill->status = $newStatus;
        $bill->save();

        if ($oldStatus !== $newStatus && $bill->customer?->email) {
            try {
                Mail::to($bill->customer->email)->send(new OrderStatusUpdatedMail($bill, $oldStatus, $newStatus));
            } catch (\Throwable $e) {
                Log::error('Lỗi gửi email cập nhật trạng thái: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.order.list')->with('success', 'Cập nhật trạng thái thành công');
    }
}
