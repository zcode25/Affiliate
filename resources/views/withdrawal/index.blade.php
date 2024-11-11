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
                    
                    <!-- Total Withdrawal Card -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                        <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Commission</p>
                        <p class="text-2xl font-bold text-purple-600 dark:text-white">Rp {{ number_format($totalCommission, 0, ',', '.') }}</p>
                    </div>

                    

                    <!-- Remaining Payment Card -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                        <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Remaining Amount</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($remainingAmount, 0, ',', '.') }}</p>
                    </div>


                    <!-- Withdrawal Pending Card -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                        <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Withdrawal Pending</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalPending, 0, ',', '.') }}</p>
                    </div>

                    <!-- Total Withdrawal Card -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md w-full sm:w-1/3">
                        <p class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Withdrawal</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalWithdrawal, 0, ',', '.') }}</p>
                    </div>
                    
                </div>


            @if(Auth::user()->role == 'Affiliate')
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-5 p-6">
                <h3 class="font-bold text-xl mb-3">Pengajuan Penarikan Dana</h3>
                <form method="POST" action="{{ route('withdrawal.request') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="amount" class="block text-gray-700 dark:text-gray-200">Jumlah Penarikan (Rp)</label>
                        <input type="number" name="amount" id="amount" class="w-full mt-1 p-2 border rounded" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Ajukan Penarikan
                    </button>
                </form>
            </div>
            @endif

            <!-- Withdrawal History -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-5 p-6">
                <h3 class="font-bold text-xl mb-3">Riwayat Penarikan Dana</h3>
                @if(Auth::user()->role == 'Admin')
                <table id="withdrawalTable" class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-2">Tanggal</th>
                            <th class="py-2">Affiliate</th>
                            <th class="py-2">Jumlah</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Diproses Pada</th>
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
                                <td class="py-2">{{ ucfirst($withdrawal->status) }}</td>
                                <td class="py-2">{{ $withdrawal->processed_at ? $withdrawal->processed_at : 'Belum Diproses' }}</td>
                                @if(Auth::user()->role == 'Admin' && $withdrawal->status == 'pending')
                                <td class="py-2 flex space-x-2">
                                    <form method="POST" action="{{ route('withdrawal.process', $withdrawal) }}">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('withdrawal.process', $withdrawal) }}">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
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
                            <th class="py-2">Tanggal</th>
                            <th class="py-2">Affiliate</th>
                            <th class="py-2">Jumlah</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Diproses Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $withdrawal)
                            <tr>
                                <td class="py-2">{{ $withdrawal->requested_at }}</td>
                                <td class="py-2">{{ $withdrawal->affiliate->user->name }}</td>
                                <td class="py-2">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                                <td class="py-2">{{ ucfirst($withdrawal->status) }}</td>
                                <td class="py-2">{{ $withdrawal->processed_at ? $withdrawal->processed_at : 'Belum Diproses' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
