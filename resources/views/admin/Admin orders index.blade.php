@extends('layouts.admin')
@section('title', 'Orders')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-900">All Orders</h2>
        <p class="text-sm text-gray-400 mt-0.5">{{ $orders->count() }} orders total</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Order ID</th>
                <th class="px-6 py-3 text-left">Customer</th>
                <th class="px-6 py-3 text-left">Items</th>
                <th class="px-6 py-3 text-left">Total</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-mono text-xs text-gray-500">#{{ $order->id }}</td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-900">{{ $order->customer_name ?? 'Guest' }}</p>
                    <p class="text-xs text-gray-400">{{ $order->customer_email ?? '' }}</p>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $order->items_count ?? '—' }} items</td>
                <td class="px-6 py-4 font-medium">${{ number_format($order->total ?? 0, 0) }}</td>
                <td class="px-6 py-4">
                    <span class="text-xs px-2 py-1 rounded-full
                        {{ ($order->status ?? 'pending') === 'completed' ? 'bg-green-100 text-green-700' :
                          (($order->status ?? 'pending') === 'cancelled' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst($order->status ?? 'pending') }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-400 text-xs">{{ $order->created_at->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                    <p class="text-lg">No orders yet</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection