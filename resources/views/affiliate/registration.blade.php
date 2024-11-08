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
                <h3 class="mb-5 font-bold text-xl">Affiliate Registration</h3>
              
                <table id="affiliateRegistrationTable">
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
                      @foreach ($registrations as $item)
                        <tr>
                          <td>{{ $item->user->name }}</td>
                          <td>{{ $item->user->email }}</td>
                          <td><span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ ucfirst(trans($item->status)) }}</span></td>
                          {{-- <td>{{ $item->status }}</td> --}}
                          <td>
                            <form action="{{ route('affiliate.active', $item->id) }}" method="POST" style="display: inline-block;">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="swalDefaultConfirm text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Active</button>
                            </form>

                            <form action="{{ route('affiliate.reject', $item->id) }}" method="POST" style="display: inline-block;">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="swalDefaultReject text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Reject</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
          </div>

          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
              <h3 class="mb-5 font-bold text-xl">Affiliate Registration History</h3>
              

              <table id="affiliateRegistrationHistoryTable">
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
                                Status
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registrationHistories as $item)
                      <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        @if ($item->status == 'pending')
                          <td><span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ ucfirst(trans($item->status)) }}</span></td>
                        @elseif ($item->status == 'active')
                          <td><span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ ucfirst(trans($item->status)) }}</span></td>
                        @else
                          <td><span class="bg-pink-100 text-pink-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ ucfirst(trans($item->status)) }}</span></td>
                        @endif
                      </tr>
                    @endforeach
                </tbody>
              </table>


            </div>
        </div>

          


      </div>
  </div>
  
  
</x-app-layout>
