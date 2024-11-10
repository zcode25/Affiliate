<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Affiliate Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1">      
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-5">
                    
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200">Total Click</h4>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $totalClicks }}</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200">Total Project</h4>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $totalProjects }}</p>
                    </div>

                    
            
                    <!-- Project Status Cards -->
                    @foreach ($projectStatus as $status)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200">
                                Project {{ ucfirst($status->status) }}
                            </h4>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $status->count }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        Number of Clicks Per Day Graph
                    </h3>
                    <canvas id="clickChart"></canvas>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Script untuk Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('clickChart').getContext('2d');
            const clickChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($clicksPerDay->pluck('date')->toArray()),
                    datasets: [{
                        label: 'Clicks per Day',
                        data: @json($clicksPerDay->pluck('clicks')->toArray()),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    },
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        });
    </script>
</x-app-layout>
