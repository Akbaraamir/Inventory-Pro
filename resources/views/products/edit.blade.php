<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">SKU</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Stock Quantity</label>
                            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alert Level</label>
                            <input type="number" name="alert_level" value="{{ old('alert_level', $product->alert_level) }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-end border-t pt-4">
                        <a href="{{ route('products.index') }}" class="text-gray-600 mr-4 hover:underline">Cancel</a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700 shadow-md">
                            Update Product Details
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>