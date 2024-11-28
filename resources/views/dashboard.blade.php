<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Affiliate Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-5">
                    
                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                    <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Commission</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalCommission, 0, ',', '.') }}</p>
                </div>

                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                    <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Withdrawal</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalWithdrawal, 0, ',', '.') }}</p>
                </div>


                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                    <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Pending Withdrawals</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($pendingWithdrawals, 0, ',', '.') }}</p>
                </div>

                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                    <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Approved Withdrawals</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($approvedWithdrawals, 0, ',', '.') }}</p>
                </div>
                
            </div>

            <!-- Chart Section -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="font-bold text-lg text-gray-800 dark:text-gray-200 mb-4">Commission by Month</h3>
                <canvas id="commissionChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('commissionChart').getContext('2d');
        const commissionData = @json($commissionByMonth->pluck('total'));
        const monthLabels = @json($commissionByMonth->pluck('month_name'));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Total Commission (Rp)',
                    data: commissionData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
