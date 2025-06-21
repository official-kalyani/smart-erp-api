<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('products.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600">
                    Add Product
                </a>

                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">SKU</th>
                            <th class="py-2 px-4 border-b">Price</th>
                            <th class="py-2 px-4 border-b">Qty</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->sku }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($product->price, 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->quantity }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

