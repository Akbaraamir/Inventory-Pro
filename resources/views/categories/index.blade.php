<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                
                <h2 class="font-semibold text-xl mb-4">Add New Category</h2>
                
                <form action="{{ route('categories.store') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="flex gap-4">
                        <input type="text" name="name" placeholder="Category Name" class="border p-2 rounded w-full" required>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>

                <hr>

                <h2 class="font-semibold text-xl mt-6 mb-4">Existing Categories</h2>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">ID</th>
                            <th class="p-2">Name</th>
                            <th class="p-2">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr class="border-b">
                            <td class="p-2">{{ $category->id }}</td>
                            <td class="p-2">{{ $category->name }}</td>
                            <td class="p-2">{{ $category->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>