<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Withdrawal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            

            <!-- Admin's Information: Total Withdrawals, Pending, and Remaining -->

                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-5">
                    
                    <div class="bg-gradient-to-br from-purple-600 to-blue-500 dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                        <p class="font-normal text-md text-white dark:text-gray-200 mb-2">Commission Balance</p>
                        <p class="text-2xl font-bold text-white dark:text-white">Rp {{ number_format($remainingAmount, 0, ',', '.') }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                        <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Commission</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalCommission, 0, ',', '.') }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                        <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Withdrawal Pending</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalPending, 0, ',', '.') }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                        <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Withdrawal</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalWithdrawal, 0, ',', '.') }}</p>
                    </div>
                    
                </div>


            @if(Auth::user()->role == 'Affiliate')
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-5 p-6">
                <h3 class="font-bold text-xl mb-3">Fund Withdrawal Request</h3>
                <form method="POST" action="{{ route('withdrawal.request') }}">
                    @csrf
                    <p class="text-gray-600 mb-2">Withdrawal Amount (Rp)</p>
                    <div class="flex items-center mb-3">
                        <div class="w-10/12">
                          <input 
                              type="number" 
                              name="amount" 
                              id="amount" 
                              placeholder="Your maximum withdrawal (Rp {{ number_format($remainingAmount, 0, ',', '.') }})" 
                              class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500"
                          >
                        </div>
                        <div class="w-2/12 pl-2">
                          <button 
                              type="submit" 
                              class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                          >
                              Withdrawal
                          </button>
                        </div>
                    </div>

                </form>
            </div>
            @endif

            <!-- Withdrawal History -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-5 p-6">
                <h3 class="font-bold text-xl mb-3">Withdrawal History</h3>
                @if(Auth::user()->role == 'Admin')
                <table id="withdrawalTable" class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-2">Date</th>
                            <th class="py-2">Affiliate</th>
                            <th class="py-2">Amount</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Processed On</th>
                            @if(Auth::user()->role == 'Admin')
                                <th class="py-2">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $withdrawal)
                            <tr>
                                <td class="py-2">{{ $withdrawal->requested_at }}</td>
                                <td class="py-2">{{ $withdrawal->affiliate->user->name }}</td>
                                <td class="py-2">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                                @if ($withdrawal->status == 'pending')
                                <td><span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ ucfirst(trans($withdrawal->status)) }}</span></td>
                                @elseif ($withdrawal->status == 'approved')
                                <td><span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ ucfirst(trans($withdrawal->status)) }}</span></td>
                                @else
                                <td><span class="bg-pink-100 text-pink-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ ucfirst(trans($withdrawal->status)) }}</span></td>
                                @endif
                                <td class="py-2">{{ $withdrawal->processed_at ? $withdrawal->processed_at : 'Unprocessed' }}</td>
                                @if(Auth::user()->role == 'Admin' && $withdrawal->status == 'pending')
                                <td class="py-2 flex space-x-2">
                                    <form method="POST" action="{{ route('withdrawal.process', $withdrawal) }}">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="swalWithdrawalConfirm text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('withdrawal.process', $withdrawal) }}">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="swalWithdrawalReject text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                            Reject
                                        </button>
                                    </form>
                                </td>
                                @else
                                    <td class="py-2"></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <table id="withdrawalTable" class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-2">Date</th>
                            <th class="py-2">Affiliate</th>
                            <th class="py-2">Amount</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Processed On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $withdrawal)
                            <tr>
                                <td class="py-2">{{ $withdrawal->requested_at }}</td>
                                <td class="py-2">{{ $withdrawal->affiliate->user->name }}</td>
                                <td class="py-2">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                                @if ($withdrawal->status == 'pending')
                                <td><span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ ucfirst(trans($withdrawal->status)) }}</span></td>
                                @elseif ($withdrawal->status == 'approved')
                                <td><span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ ucfirst(trans($withdrawal->status)) }}</span></td>
                                @else
                                <td><span class="bg-pink-100 text-pink-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ ucfirst(trans($withdrawal->status)) }}</span></td>
                                @endif
                                {{-- <td class="py-2">{{ ucfirst($withdrawal->status) }}</td> --}}
                                <td class="py-2">{{ $withdrawal->processed_at ? $withdrawal->processed_at : 'Unprocessed' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
