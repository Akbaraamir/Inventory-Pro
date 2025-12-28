<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Inventory Management') }}
            </h2>
            <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
                + Add New Product
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                
                <div class="mb-6">
                    <form action="{{ route('products.index') }}" method="GET" class="flex flex-wrap gap-4">
                        <div class="flex-1 min-w-[300px]">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search by name or SKU..." 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <select name="category" onchange="this.form.submit()" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500">
                            <option value="">All Categories</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-medium transition">
                            Apply Filters
                        </button>

                        @if(request('search') || request('category'))
                            <a href="{{ route('products.index') }}" class="py-2 text-red-500 hover:underline text-sm font-medium">
                                Clear Filters
                            </a>
                        @endif
                    </form>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 mb-6 flex justify-between items-center border border-gray-200">
                    <div class="flex space-x-6">
                        <span class="text-sm text-gray-600">Showing: <strong>{{ $products->count() }}</strong> products</span>
                        <span class="text-sm text-gray-600">Total Page Value: <strong>${{ number_format($products->sum(fn($p) => $p->price * $p->quantity), 2) }}</strong></span>
                    </div>
                    <div class="text-xs text-gray-400 italic">
                        Last updated: {{ now()->format('M d, Y H:i') }}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b text-gray-600 text-sm">
                                <th class="p-4 font-semibold uppercase">SKU</th>
                                <th class="p-4 font-semibold uppercase">Product Name</th>
                                <th class="p-4 font-semibold uppercase">Category</th>
                                <th class="p-4 font-semibold uppercase">Status & Stock</th>
                                <th class="p-4 font-semibold uppercase">Price</th>
                                <th class="p-4 text-center font-semibold uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($products as $product)
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="p-4 font-mono text-xs text-gray-500 uppercase">{{ $product->sku }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-800">{{ $product->name }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                
                                <td class="p-4">
                                    <div class="flex items-center space-x-3">
                                        <form action="{{ route('products.adjustStock', $product) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="w-7 h-7 flex items-center justify-center bg-white border border-gray-300 rounded-full text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition shadow-sm font-bold">
                                                -
                                            </button>
                                        </form>

                                        @if($product->quantity <= $product->alert_level)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                                {{ $product->quantity }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                                {{ $product->quantity }}
                                            </span>
                                        @endif

                                        <form action="{{ route('products.adjustStock', $product) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="w-7 h-7 flex items-center justify-center bg-white border border-gray-300 rounded-full text-gray-600 hover:bg-green-50 hover:text-green-600 hover:border-green-200 transition shadow-sm font-bold">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mt-1">
                                        @if($product->quantity <= $product->alert_level)
                                            <span class="text-[10px] text-red-500 font-bold uppercase">Low Stock Alert</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="p-4 text-gray-700 font-medium">
                                    ${{ number_format($product->price, 2) }}
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm" onclick="return confirm('Delete this product?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400">
                                    No products found matching your criteria.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>