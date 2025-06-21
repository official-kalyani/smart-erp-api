<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-xl font-bold mb-4">Create Sales Order</h2>

        <form action="{{ route('sales_orders.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="customer_name" class="block font-medium">Customer Name</label>
                <input type="text" name="customer_name" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <h3 class="font-semibold mb-2">Products</h3>
                <div id="product-list">
                    <div class="flex gap-4 mb-2">
                        <select name="products[0][product_id]" class="border rounded p-2 w-1/2" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} - ₹{{ $product->price }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="products[0][quantity]" class="border rounded p-2 w-1/4" placeholder="Qty" required>
                    </div>
                </div>
                <button type="button" onclick="addProduct()" class="text-blue-600 hover:underline">+ Add Product</button>
            </div>

            <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700">Submit Order</button>
        </form>
    </div>

    <script>
        let index = 1;
        function addProduct() {
            const productList = document.getElementById('product-list');
            const newRow = `
                <div class="flex gap-4 mb-2">
                    <select name="products[${index}][product_id]" class="border rounded p-2 w-1/2" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - ₹{{ $product->price }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="products[${index}][quantity]" class="border rounded p-2 w-1/4" placeholder="Qty" required>
                </div>`;
            productList.insertAdjacentHTML('beforeend', newRow);
            index++;
        }
    </script>
</x-app-layout>
