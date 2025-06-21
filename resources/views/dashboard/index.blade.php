<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6">Dashboard Summary</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold">Total Sales</h3>
                <p class="text-2xl font-bold text-green-600">₹{{ number_format($totalSales, 2) }}</p>
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold">Total Orders</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $totalOrders }}</p>
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold">Low Stock Alerts</h3>
                <p class="text-2xl font-bold text-red-600">{{ $lowStockProducts->count() }}</p>
            </div>
        </div>
 <div>{{ Auth::user()->role }}</div>
        @if ($lowStockProducts->count())
            <div class="bg-yellow-100 p-4 rounded shadow">
                <h4 class="text-lg font-semibold mb-2">Products Low on Stock:</h4>
                <ul class="list-disc pl-5">
                    @foreach ($lowStockProducts as $product)
                        <li>{{ $product->name }} (Qty: {{ $product->quantity }})</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-app-layout>
