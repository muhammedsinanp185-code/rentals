@extends('layouts.admin')

@section('header', 'Customers')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-lg font-bold dark:text-slate-100">Manage Customers</h3>
</div>

<div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm overflow-hidden border dark:border-slate-800">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-white dark:bg-slate-950/50 border-b dark:border-slate-800">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-500 uppercase tracking-widest">ID</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-500 uppercase tracking-widest">Name</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-500 uppercase tracking-widest">Email</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-500 uppercase tracking-widest">Phone</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-500 uppercase tracking-widest">Address</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-500 uppercase tracking-widest">Total Bookings</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-blue-600 dark:text-blue-500 uppercase tracking-widest">Registered At</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-blue-50 dark:divide-slate-800">
            @forelse ($customers as $customer)
                <tr class="hover:bg-blue-50/50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4 text-sm text-blue-600 dark:text-blue-500">#{{ $customer->id }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-blue-950 dark:text-slate-100">{{ $customer->name }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-blue-600 dark:text-blue-500">{{ $customer->email }}</td>
                    <td class="px-6 py-4 text-sm text-blue-600 dark:text-blue-500">{{ $customer->phone ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-blue-600 dark:text-blue-500">{{ Str::limit($customer->address, 30) ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-blue-950 dark:text-slate-100">{{ $customer->bookings_count }}</td>
                    <td class="px-6 py-4 text-sm text-blue-600 dark:text-blue-500">{{ $customer->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-blue-600 dark:text-blue-500">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t dark:border-slate-800">
        {{ $customers->links() }}
    </div>
</div>
@endsection
