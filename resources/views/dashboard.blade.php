<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

   <!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
        <h3 class="text-sm font-medium text-gray-500">Colocations</h3>
        <p class="mt-2 text-2xl font-bold text-gray-800">{{ $totalColocations }}</p>
    </div>

    <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
        <h3 class="text-sm font-medium text-gray-500">Members</h3>
        <p class="mt-2 text-2xl font-bold text-gray-800">{{ $totalMembers }}</p>
    </div>

    <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
        <h3 class="text-sm font-medium text-gray-500">Expenses</h3>
        <p class="mt-2 text-2xl font-bold text-gray-800">${{ number_format($totalExpenses, 2) }}</p>
    </div>

    <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
        <h3 class="text-sm font-medium text-gray-500">Pending Payments</h3>
        <p class="mt-2 text-2xl font-bold text-gray-800">{{ $pendingPayments }}</p>
    </div>
</div>

<!-- Recent Colocations Table -->
<tbody class="bg-white divide-y divide-gray-200">
@foreach($recentColocations as $colocation)
<tr>
    <td class="px-6 py-4 whitespace-nowrap">{{ $colocation->name }}</td>
    <td class="px-6 py-4 whitespace-nowrap">{{ $colocation->owner->name ?? 'N/A' }}</td>
    <td class="px-6 py-4 whitespace-nowrap">{{ $colocation->members()->count() }}</td>
    <td class="px-6 py-4 whitespace-nowrap">
        @if($colocation->status === 'active')
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
        @else
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">{{ ucfirst($colocation->status) }}</span>
        @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-right">
        <a href="{{ route('colocations.show', $colocation->id) }}" class="text-indigo-600 font-semibold hover:text-indigo-800">View</a>
    </td>
</tr>
@endforeach
</tbody>

        <!-- Quick Actions -->


    </div>
</x-app-layout>