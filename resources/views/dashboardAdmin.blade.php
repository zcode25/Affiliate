<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Affiliate Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

          <!-- Kartu Statistik -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
              <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                  <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Komisi Dibayarkan</h3>
                  <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($totalCommissionPaid, 0, ',', '.') }}</p>
              </div>
              <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                  <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Withdrawal</h3>
                  <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($totalWithdrawal, 0, ',', '.') }}</p>
              </div>
              <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                  <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Withdrawal Pending</h3>
                  <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $pendingWithdrawals }}</p>
              </div>
              <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                  <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Affiliate</h3>
                  <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalAffiliates }}</p>
              </div>
          </div>

          <!-- Grafik Performa Komisi per Bulan -->
          <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mt-6">
              <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Performa Komisi per Bulan</h3>
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
