@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Dashboard Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Asset</h3>
                        <!-- Icon link eksternal Asset -->
                        <a href="https://example.com" target="_blank"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 13v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6m3-3h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white mt-2">24</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Asset Active</h3>
                        <!-- Icon link eksternal Asset -->
                        <a href="https://example.com" target="_blank"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 13v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6m3-3h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white mt-2">24</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">List Stationery</h3>
                        <!-- Icon link eksternal List Vendor -->
                        <a href="https://example.com" target="_blank"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 13v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6m3-3h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white mt-2">24</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">List Vendor</h3>
                        <!-- Icon link eksternal List Vendor -->
                        <a href="https://example.com" target="_blank"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 13v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6m3-3h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white mt-2">24</p>
                </div>
            </div>

            {{-- Table Projects --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto mb-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                List Asset</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Nomor Asset</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Owner</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Department</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status Asset</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Deadline</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Project Alpha</td>
                            <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Active</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-12-31</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Project Beta</td>
                            <td class="px-6 py-4 whitespace-nowrap">Jane Smith</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">Pending</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-11-15</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Project Gamma</td>
                            <td class="px-6 py-4 whitespace-nowrap">Alice Johnson</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">Delayed</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-10-20</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Chart --}}
            <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg p-4 mb-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Project Completion Chart</h3>
                <canvas id="projectsChart" class="w-full h-64"></canvas>
            </div>

            {{-- Responsive Card Section --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Card 1</h3>
                    <p class="text-xl font-bold text-gray-800 dark:text-white">Value 1</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Card 2</h3>
                    <p class="text-xl font-bold text-gray-800 dark:text-white">Value 2</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Card 3</h3>
                    <p class="text-xl font-bold text-gray-800 dark:text-white">Value 3</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Card 4</h3>
                    <p class="text-xl font-bold text-gray-800 dark:text-white">Value 4</p>
                </div>
            </div>

            {{-- Bottom 2 large cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 h-48">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Large Card 1</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Some content for the first large card.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 h-48">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Large Card 2</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Some content for the second large card.</p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('projectsChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending', 'Delayed'],
                datasets: [{
                    label: 'Projects',
                    data: [98, 12, 5],
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#374151'
                        }
                    }
                }
            }
        });
    </script>
@endsection
