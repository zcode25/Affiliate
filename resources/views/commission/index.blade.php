<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Commission') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="mb-5 font-bold text-xl">Commission Data</h3>
              
                <table id="commissionTable">
                  <thead>
                      <tr>
                          <th>
                            <span class="flex items-center">
                                Date Time
                            </span>
                          </th>
                          <th>
                              <span class="flex items-center">
                                  Project
                              </span>
                          </th>
                          <th>
                              <span class="flex items-center">
                                  Affiliate
                              </span>
                          </th>
                          <th>
                              <span class="flex items-center">
                                  Commission
                              </span>
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($commissions as $item)
                        <tr>
                          <td>{{ $item->created_at }}</td>
                          <td>{{ $item->project->project_name }}</td>
                          <td>{{ $item->affiliate->user->name }}</td>
                          <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>

      
      </div>
  </div>
  
  
</x-app-layout>
