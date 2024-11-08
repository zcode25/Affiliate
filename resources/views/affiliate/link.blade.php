<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Affiliate Link') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Link Afiliasi Saya</h1>
                    <p class="text-gray-600 mb-1">Bagikan link afiliasi Anda di bawah ini untuk mendapatkan komisi dari setiap konversi.</p>
                    
                    @if ($affiliateLink)
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
                                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
                                    onclick="copyToClipboard()"
                                >
                                    Salin Link
                                </button>
                            </div>
                        </div>
                    @else
                        <p class="text-red-500">Anda belum memiliki kode afiliasi. Hubungi admin untuk informasi lebih lanjut.</p>
                    @endif
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
