<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Commission') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-5">
                    
            <!-- Total Withdrawal Card -->
            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Commission</p>
                <p class="text-2xl font-bold text-purple-600 dark:text-white">Rp {{ number_format($totalCommission, 0, ',', '.') }}</p>
            </div>

            

            <!-- Remaining Payment Card -->
            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Commission Balance</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($remainingAmount, 0, ',', '.') }}</p>
            </div>

            
        </div>

          
          <!-- Tabel Commission -->
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h3 class="mb-5 font-bold text-xl">Commission Data</h3>
                
                  <table id="commissionTable" class="w-full text-left">
                      <thead>
                          <tr>
                              <th class="py-2">Date Time</th>
                              <th class="py-2">Project</th>
                              <th class="py-2">Affiliate</th>
                              <th class="py-2">Commission</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($commissions as $item)
                            <tr>
                              <td class="py-2">{{ $item->created_at }}</td>
                              <td class="py-2">{{ $item->project->project_name }}</td>
                              <td class="py-2">{{ $item->affiliate->user->name }}</td>
                              <td class="py-2">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                            </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      
      </div>
  </div>
</x-app-layout>
