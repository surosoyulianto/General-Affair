<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Dashboard Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Projects</h3>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">24</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Users</h3>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">150</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Tasks</h3>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">12</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Completed</h3>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">98</p>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Project Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Owner</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Deadline</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Project Alpha</td>
                            <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Active</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-12-31</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Project Beta</td>
                            <td class="px-6 py-4 whitespace-nowrap">Jane Smith</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">Pending</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-11-15</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Project Gamma</td>
                            <td class="px-6 py-4 whitespace-nowrap">Alice Johnson</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">Delayed</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-10-20</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Optional Chart Area --}}
            <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Project Completion Chart</h3>
                <canvas id="projectsChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('projectsChart').getContext('2d');
        const projectsChart = new Chart(ctx, {
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
                            color: '#374151', // dark mode handling can be improved
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
