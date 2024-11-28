<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Affiliate Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-5">
                    
            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Commission</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalCommissionPaid, 0, ',', '.') }}</p>
            </div>

            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Withdrawal</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalWithdrawal, 0, ',', '.') }}</p>
            </div>

            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Withdrawal Pending</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingWithdrawals }}</p>
            </div>

            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Affiliate</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalAffiliates }}</p>
            </div>
            
        </div>



          <!-- Grafik Performa Komisi per Bulan -->
          <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mt-6">
              <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Commission Performance per Month</h3>
              <canvas id="commissionChart"></canvas>
          </div>
      </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      // Data untuk Grafik Komisi Bulanan
      const ctx = document.getElementById('commissionChart').getContext('2d');
const commissionData = @json($commissionByMonth->pluck('total'));
const monthLabels = @json($commissionByMonth->pluck('month_name'));

      const chart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: monthLabels,
              datasets: [{
                  label: 'Commission by Month',
                  data: commissionData,
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  </script>
</x-app-layout>
