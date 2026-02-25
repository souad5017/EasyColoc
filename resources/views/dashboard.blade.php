<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Colocations -->
            <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
                <h3 class="text-sm font-medium text-gray-500">Colocations</h3>
                <p class="mt-2 text-2xl font-bold text-gray-800">12</p>
            </div>
            <!-- Total Members -->
            <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
                <h3 class="text-sm font-medium text-gray-500">Members</h3>
                <p class="mt-2 text-2xl font-bold text-gray-800">35</p>
            </div>
            <!-- Total Expenses -->
            <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
                <h3 class="text-sm font-medium text-gray-500">Expenses</h3>
                <p class="mt-2 text-2xl font-bold text-gray-800">$7,240</p>
            </div>
            <!-- Pending Payments -->
            <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
                <h3 class="text-sm font-medium text-gray-500">Pending Payments</h3>
                <p class="mt-2 text-2xl font-bold text-gray-800">5</p>
            </div>
        </div>

        <!-- Recent Colocations Table -->
        <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30 overflow-x-auto">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Colocations</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Members</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Coloc 1</td>
                        <td class="px-6 py-4 whitespace-nowrap">Alice</td>
                        <td class="px-6 py-4 whitespace-nowrap">4</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="text-indigo-600 font-semibold hover:text-indigo-800">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Coloc 2</td>
                        <td class="px-6 py-4 whitespace-nowrap">Bob</td>
                        <td class="px-6 py-4 whitespace-nowrap">3</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="text-indigo-600 font-semibold hover:text-indigo-800">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <a href="" class="block bg-indigo-600 text-white font-semibold py-4 rounded-2xl text-center shadow-lg hover:bg-indigo-700 transition duration-300">
                Create New Colocation
            </a>
            <a href="" class="block bg-purple-600 text-white font-semibold py-4 rounded-2xl text-center shadow-lg hover:bg-purple-700 transition duration-300">
                Add Expense
            </a>
        </div>

    </div>
</x-app-layout>