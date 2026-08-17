@extends('layouts.admin')

@section('header', 'Categories')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-bold dark:text-white">Manage Vehicle Categories</h3>
    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Category</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border dark:border-gray-700">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-gray-50 dark:bg-gray-900/50 border-b dark:border-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Vehicles</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($categories as $category)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 text-gray-900 dark:text-gray-300">
                    <td class="px-6 py-4">{{ $category->id }}</td>
                    <td class="px-6 py-4 font-medium dark:text-white">{{ $category->name }}</td>
                    <td class="px-6 py-4 truncate max-w-xs">{{ $category->description }}</td>
                    <td class="px-6 py-4">{{ $category->vehicles_count }}</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t dark:border-gray-700">
        {{ $categories->links() }}
    </div>
</div>
@endsection
