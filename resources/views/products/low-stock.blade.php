<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            ⚠️ Low Stock Alert Report
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 flex justify-between items-center">
                    <p class="text-gray-600">The following items have reached or fallen below their minimum stock levels.</p>
                    <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded text-sm hover:bg-black">
                        Print Report
                    </button>
                </div>

                @if($products->isEmpty())
                    <div class="bg-green-50 border border-green-200 text-green-700 p-10 text-center rounded-lg">
                        <span class="text-4xl mb-4 block">✅</span>
                        <h3 class="text-xl font-bold">All stock levels are healthy!</h3>
                        <p>No items currently require reordering.</p>
                    </div>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-red-50 border-b border-red-100">
                                <th class="p-4 text-red-700">SKU</th>
                                <th class="p-4 text-red-700">Product Name</th>
                                <th class="p-4 text-red-700">Current Stock</th>
                                <th class="p-4 text-red-700">Alert Level</th>
                                <th class="p-4 text-red-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-mono text-sm">{{ $product->sku }}</td>
                                <td class="p-4 font-bold">{{ $product->name }}</td>
                                <td class="p-4 text-red-600 font-black">{{ $product->quantity }}</td>
                                <td class="p-4 text-gray-500">{{ $product->alert_level }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full font-bold uppercase">
                                        Reorder Required
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>