<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pembuatan Website - TerasWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-600">Layanan Pembuatan Website Profesional</h1>
            <p class="text-lg mt-2 text-gray-700">Maksimalkan Bisnis Anda dengan Website yang Menarik dan Berkualitas</p>
        </div>

        <!-- Service Highlights -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 my-10">
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-800">Desain Modern</h2>
                <p class="text-gray-600 mt-2">Desain website yang elegan dan sesuai tren untuk brand Anda.</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-800">Optimasi SEO</h2>
                <p class="text-gray-600 mt-2">Meningkatkan visibilitas website di mesin pencari untuk menjangkau lebih banyak pelanggan.</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-800">Keamanan Terjamin</h2>
                <p class="text-gray-600 mt-2">Perlindungan data dan privasi untuk kenyamanan Anda dan pelanggan Anda.</p>
            </div>
        </div>

        <!-- Project Request Form -->
        <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-10">
            <h2 class="text-2xl font-bold text-gray-800 text-center">Ajukan Proyek Anda</h2>
            <p class="text-gray-600 text-center mt-2">Isi form di bawah ini untuk mendapatkan penawaran terbaik dari kami.</p>
            <form action="{{ route('landing.submitProject') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="ref" value="{{ request('ref') }}">

                <div>
                    <label for="client_name" class="block text-gray-700 font-semibold">Nama Calon Klien</label>
                    <input 
                        type="text" 
                        id="client_name" 
                        name="client_name" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama klien"
                        value="{{ old('client_name') }}"
                    >
                    @error('client_name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label for="client_email" class="block text-gray-700 font-semibold">Email Calon Klien</label>
                    <input 
                        type="email" 
                        id="client_email" 
                        name="client_email" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan email klien"
                        value="{{ old('client_email') }}"
                    >
                    @error('client_email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label for="client_phone" class="block text-gray-700 font-semibold">Telepon Calon Klien</label>
                    <input 
                        type="tel" 
                        id="client_phone" 
                        name="client_phone" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan telepon klien"
                        value="{{ old('client_phone') }}"
                    >
                    @error('client_phone')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="project_type" class="block text-gray-700 font-semibold">Jenis Proyek</label>
                    <select 
                        id="project_type" 
                        name="project_type" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="website" {{ old('project_type') == 'website' ? 'selected' : '' }}>Website</option>
                        <option value="application" {{ old('project_type') == 'application' ? 'selected' : '' }}>Aplikasi</option>
                        <option value="other" {{ old('project_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('project_type')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="project_name" class="block text-gray-700 font-semibold">Nama Proyek</label>
                    <input 
                        type="text" 
                        id="project_name" 
                        name="project_name" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama proyek"
                        value="{{ old('project_name') }}"
                    >
                    @error('project_name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="project_description" class="block text-gray-700 font-semibold">Deskripsi Proyek</label>
                    <textarea 
                        id="project_description" 
                        name="project_description" 
                        rows="4" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan deskripsi proyek"
                    >{{ old('project_description') }}</textarea>
                    @error('project_description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition"
                >
                    Ajukan Proyek
                </button>
            </form>

        </div>
    </div>
    @include('sweetalert::alert')
</body>
</html>
