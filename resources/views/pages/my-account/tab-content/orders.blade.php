@php use Carbon\Carbon; @endphp
<div class="tab-pane fade" id="orders">
    <h4>Orders</h4>
    <div class="table_page table-responsive">
        <table>
            <thead>
            <tr>
                <th>SL</th>
                <th>Order No</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ Carbon::parse($order->created_at)->format('jS F, Y') }}</td>
                    <td><span class="success">Completed</span></td>
                    <td>৳ {{ $order->total_charge }}</td>
                    <td><a href="{{ route('user.invoice', [$order->id]) }}" class="view" target="_blank">view</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
