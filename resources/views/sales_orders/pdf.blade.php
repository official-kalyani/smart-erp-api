<h2>Sales Order #{{ $salesOrder->id }}</h2>
<p>Customer: {{ $salesOrder->customer_name }}</p>
<p>Status: {{ $salesOrder->status }}</p>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Rate</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($salesOrder->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>₹{{ $item->price }}</td>
            <td>₹{{ $item->price * $item->quantity }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>₹{{ $salesOrder->total_amount }}</strong></td>
        </tr>
    </tbody>
</table>
