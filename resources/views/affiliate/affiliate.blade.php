<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Affiliate') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-5">
                        
                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                    <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Affiliate</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalAffiliate }}</p>
                </div>

                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                    <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Affiliate Active</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $affiliateActive }}</p>
                </div>

                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                    <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Affiliate Deactive</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $affiliateDeactive }}</p>
                </div>
                
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="mb-5 font-bold text-xl">Affiliate Data</h3>
              
                <table id="affiliateDataTable">
                  <thead>
                      <tr>
                          <th>
                              <span class="flex items-center">
                                  Name
                              </span>
                          </th>
                          <th>
                              <span class="flex items-center">
                                  Email
                              </span>
                          </th>
                          <th>
                              <span class="flex items-center">
                                  Affiliate Code
                              </span>
                          </th>
                          <th>
                              <span class="flex items-center">
                                  Status
                              </span>
                          </th>
                          <th>
                              <span class="flex items-center">
                                  Action
                              </span>
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($affiliates as $item)
                        <tr>
                          <td>{{ $item->user->name }}</td>
                          <td>{{ $item->user->email }}</td>
                          <td>{{ $item->affiliate_code }}</td>
                            @if ($item->status == 'active')
                                <td><span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ ucfirst(trans($item->status)) }}</span></td>
                            @else
                                <td><span class="bg-pink-100 text-pink-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ ucfirst(trans($item->status)) }}</span></td>
                            @endif
                          {{-- <td>{{ $item->status }}</td> --}}
                          <td>
                            <a href="{{ route('affiliate.detail', $item) }}" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">View</a>
                          </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>

      
      </div>
  </div>
  
  
</x-app-layout>
