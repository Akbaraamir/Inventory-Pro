<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Product</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">SKU (Stock Keeping Unit)</label>
                            <input type="text" name="sku" placeholder="e.g. LAP-001" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                            <input type="number" step="0.01" name="price" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Initial Quantity</label>
                            <input type="number" name="quantity" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alert Level</label>
                            <input type="number" name="alert_level" value="5" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500">
                        </div>
                    </div>

                    <div class="flex items-center justify-end border-t pt-4">
                        <a href="{{ route('products.index') }}" class="text-gray-600 mr-4 hover:underline">Cancel</a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700 shadow-md">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>