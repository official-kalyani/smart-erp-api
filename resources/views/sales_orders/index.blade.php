<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-semibold">Sales Orders</h2>
            <a href="{{ route('sales_orders.create') }}" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">Add Order</a>
        </div>

        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Customer</th>
                    <th class="p-2 border">Total (₹)</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="border p-2">{{ $order->id }}</td>
                        <td class="border p-2">{{ $order->customer_name }}</td>
                        <td class="border p-2">{{ number_format($order->total_amount, 2) }}</td>
                        <td class="border p-2">{{ $order->status }}</td>
                        <td class="border p-2">
                            <a href="{{ route('sales_orders.pdf', $order) }}" class="text-indigo-600 hover:underline">PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
