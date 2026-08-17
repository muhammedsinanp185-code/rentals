@extends('layouts.admin')

@section('header', 'Categories')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-bold">Manage Vehicle Categories</h3>
    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Category</a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicles</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($categories as $category)
                <tr>
                    <td class="px-6 py-4">{{ $category->id }}</td>
                    <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                    <td class="px-6 py-4 truncate max-w-xs">{{ $category->description }}</td>
                    <td class="px-6 py-4">{{ $category->vehicles_count }}</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">
        {{ $categories->links() }}
    </div>
</div>
@endsection
