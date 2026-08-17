@extends('layouts.admin')

@section('header', 'Customers')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-bold">Manage Customers</h3>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-x-auto">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Bookings</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered At</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($customers as $customer)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">#{{ $customer->id }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $customer->name }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $customer->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $customer->phone ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($customer->address, 30) ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ $customer->bookings_count }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $customer->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">
        {{ $customers->links() }}
    </div>
</div>
@endsection
