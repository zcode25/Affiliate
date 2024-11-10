<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Affiliate Link') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mb-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-gray-800 mb-4">My Affiliate Link</h1>
                    <p class="text-gray-600 mb-2">Share your affiliate link below to earn commission on every conversion.</p>
                        <div class="flex items-center mb-4">
                            <div class="w-10/12">
                                <input 
                                    id="affiliateLink" 
                                    type="text" 
                                    class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
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
