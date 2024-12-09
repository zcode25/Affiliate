<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Affiliate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mb-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-xl font-semibold text-gray-800 mb-4">{{ $affiliate->user->name }}</h1>
                    

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <div class="mb-3">
                                <span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $affiliate->affiliate_code }}</span>
                                @if ($affiliate->status == 'active')
                                    <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ ucfirst(trans($affiliate->status)) }}</span>
                                @else
                                    <td><span class="bg-pink-100 text-pink-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ ucfirst(trans($affiliate->status)) }}</span></td>
                                @endif
                            </div>
                            <p class="text-gray-600 mb-2">Email : {{ $affiliate->user->email }}</p>
                            <p class="text-gray-600 mb-2">Phone : {{ $affiliate->user->phone }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-2">
                                <i class="fab fa-instagram text-pink-600"></i> Instagram :
                                <a href="https://instagram.com/{{ $affiliate->user->instagram }}" target="_blank" class="hover:underline">
                                    {{ $affiliate->user->instagram }}
                                </a>
                            </p>
                            <p class="text-gray-600 mb-2">
                                <i class="fab fa-facebook text-blue-600"></i> Facebook :
                                <a href="https://facebook.com/{{ $affiliate->user->facebook }}" target="_blank" class="hover:underline">
                                    {{ $affiliate->user->facebook }}
                                </a>
                            </p>
                            <p class="text-gray-600 mb-2">
                                <i class="fab fa-tiktok text-black"></i> TikTok :
                                <a href="https://tiktok.com/@{{ $affiliate->user->tiktok }}" target="_blank" class="hover:underline">
                                    {{ $affiliate->user->tiktok }}
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4">
                        @if ($affiliate->status === 'active')
                            <form action="{{ route('affiliate.deactivate', $affiliate->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this affiliate?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="swalDefaultDeactivate text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Deactivate
                                </button>
                            </form>
                        @elseif ($affiliate->status === 'deactive')
                            <form action="{{ route('affiliate.activate', $affiliate->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to activate this affiliate?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="swalDefaultConfirm text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Activate
                                </button>
                            </form>
                        @endif
                    </div>
                    
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mb-5">
                <!-- Total Commission -->
                <div class="p-4 bg-white shadow rounded-lg dark:bg-gray-800">
                    <h3 class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Clicks This Week</h3>
                    <p class="text-2xl font-bold text-purple-600 dark:text-white">
                        {{ $clicksThisWeek }}
                    </p>
                </div>
                <!-- Total Withdrawal -->
                <div class="p-4 bg-white shadow rounded-lg dark:bg-gray-800">
                    <h3 class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Clicks This Month</h3>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                        {{ $clicksThisMonth }}
                    </p>
                </div>
                <!-- Pending Withdrawals -->
                <div class="p-4 bg-white shadow rounded-lg dark:bg-gray-800">
                    <h3 class="font-normal text-md text-gray-800 dark:text-gray-200 mb-2">Total Clicks</h3>
                    <p class="text-2xl font-bold ttext-gray-800 dark:text-gray-200">
                        {{ $totalClicks }}
                    </p>
                </div>
            </div>
            <div class="bg-white mb-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-xl font-semibold text-gray-800 mb-4">My Affiliate Link</h1>
                    <p class="text-gray-600 mb-2">Share your affiliate link below to earn commission on every conversion.</p>
                        <div class="flex items-center mb-4">
                            <div class="w-10/12">
                                <input 
                                    id="affiliateLink" 
                                    type="text" 
                                    class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500" 
                                    value="{{ $affiliateLink }}" 
                                    readonly
                                />
                            </div>
                            <div class="w-2/12 pl-2">
                                <button 
                                    class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                    onclick="copyToClipboard()"
                                >
                                    Copy
                                </button>
                            </div>
                        </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h3 class="mb-5 font-bold text-xl">Affiliate Click</h3>
                
                  <table id="affiliateClickTable">
                    <thead>
                        <tr>
                            <th>
                                <span class="flex items-center">
                                    Affiliate Code
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    IP Address
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Date Time
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($affiliateClick as $item)
                          <tr>
                            <td>{{ $item->affiliate->affiliate_code }}</td>
                            <td>{{ $item->ip_address }}</td>
                            <td>{{ $item->clicked_at }}</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h3 class="mb-5 font-bold text-xl">Affiliate Project</h3>
                
                  <table id="affiliateProjectTable">
                    <thead>
                        <tr>
                            <th>
                                <span class="flex items-center">
                                    Date
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Klien
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Project Name
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Project Type
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
                        @foreach ($projects as $item)
                          <tr>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ $item->client_name }}</td>
                            <td>{{ $item->project_name }}</td>
                            <td>{{ $item->project_type }}</td>
                            <td>
                                @if($item->status === 'deal')
                                    <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ ucfirst(trans($item->status)) }}</span>
                                @else
                                    <span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ ucfirst(trans($item->status)) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('project.detail', $item) }}" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Detail</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    function copyToClipboard() {
        var copyText = document.getElementById("affiliateLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Untuk perangkat mobile
        document.execCommand("copy");
        alert("Link telah disalin: " + copyText.value);
    }
    </script>
</x-app-layout>
