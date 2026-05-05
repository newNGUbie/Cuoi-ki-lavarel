<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Products</th>
            <th>Total</th>
            <th>Payment</th>
            <th>Note</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bills as $b)
            <tr class="odd gradeX" align="center">
                <td>{{ $b->id }}</td>
                <td>{{ $b->customer->name ?? 'N/A' }}</td>
                <td>{{ $b->date_order }}</td>
                <td>
                    <ul style="list-style: none; padding-left: 0; text-align: left; font-size: 13px;">
                        @foreach ($b->bill_detail as $detail)
                            <li>• {{ $detail->product->name ?? 'N/A' }} (x{{ $detail->quantity }})</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ number_format($b->total) }} VNĐ</td>
                <td>{{ $b->payment }}</td>
                <td>{{ $b->note }}</td>
                <td>
                    <form action="{{ route('admin.order.postUpdateStatus', $b->id) }}" method="POST">
                        @csrf
                        @php
                            $statusClass = 'status-' . Str::slug($b->status, '-');
                        @endphp
                        <select name="status" onchange="this.form.submit()"
                            class="form-control status-select {{ $statusClass }}"
                            style="width: auto; display: inline-block;">
                            <option value="Mới" {{ $b->status == 'Mới' ? 'selected' : '' }}>Mới</option>
                            <option value="Đang giao" {{ $b->status == 'Đang giao' ? 'selected' : '' }}>
                                Đang giao</option>
                            <option value="Đã giao" {{ $b->status == 'Đã giao' ? 'selected' : '' }}>Đã giao
                            </option>
                            <option value="Đã hủy" {{ $b->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy
                            </option>
                        </select>
                    </form>
                </td>
                <td class="center">
                    <i class="fa fa-trash-o fa-fw"></i>
                    <a href="{{ route('admin.order.getDelete', $b->id) }}"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')"> Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
