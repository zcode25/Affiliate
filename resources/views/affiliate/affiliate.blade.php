<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Affiliate') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                          <td><span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ ucfirst(trans($item->status)) }}</span></td>
                          {{-- <td>{{ $item->status }}</td> --}}
                          <td>
                            <a href="" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">View</a>
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
