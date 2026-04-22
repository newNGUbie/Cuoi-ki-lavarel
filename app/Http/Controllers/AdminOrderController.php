<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillDetail;

class AdminOrderController extends Controller
{
    public function getList(){
        $bill = Bill::with(['customer', 'bill_detail.product'])->orderBy('id', 'DESC')->get();
        return view('admin.order.list', compact('bill'));
    }

    public function getDelete($id){
        $bill = Bill::find($id);
        $bill->delete();
        // Also delete details
        BillDetail::where('id_bill', $id)->delete();
        return redirect()->route('admin.order.list')->with('success', 'Xoa thanh cong');
    }
}
