<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerasWeb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-indigo-600">TerasWeb</a>
            <ul class="flex space-x-6">
                <li><a href="#form" class="text-gray-700 hover:text-indigo-600">Hubungi Kami</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto text-center lg:px-80">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-indigo-600">
                <span class="text-black">Buat Website Bisnis Online</span> Sesuai Keinginan Kamu
            </h1>            
            <p class="text-lg mt-7 text-gray-800 leading-normal">Tingkatkan Bisnis Kamu Dengan Memiliki Website Bisnis Online Sesuai Keinginan Kamu dengan <b>Desain Modern</b>, <b>Fitur Lengkap</b>, dan <b>Teknologi Terbaru!</b></p>
            <a href="#form"
                class="mt-8 inline-block px-8 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">
                Ajukan Proyek
            </a>
        </div>
    </section>

    <!-- Service Highlights -->
    <section id="layanan" class="py-16">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center text-indigo-600 mb-12">Website Apa yang Kamu Inginkan?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white shadow-lg rounded-lg p-8 text-center">
                    <h3 class="text-2xl font-semibold text-gray-800">Portofolio</h3>
                    <p class="text-gray-600 mt-4">Kami dapat membuat website yang menampilkan karya dan proyek terbaik kamu, membantu menarik perhatian calon klien dengan keahlian kamu.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-8 text-center">
                    <h3 class="text-2xl font-semibold text-gray-800">Company Profile</h3>
                    <p class="text-gray-600 mt-4">Kami dapat membuat website yang memperkenalkan bisnis kamu, menampilkan informasi lengkap tentang visi, misi, dan layanan untuk membangun kepercayaan.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-8 text-center">
                    <h3 class="text-2xl font-semibold text-gray-800">Website Custom</h3>
                    <p class="text-gray-600 mt-4">Kami dapat merancang website sesuai kebutuhan kamu, dengan fitur dan desain yang dapat menciptakan pengalaman pengguna yang baik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-orange-600 py-16">
        <div class="container mx-auto text-center text-white">
            <h2 class="text-4xl font-bold">Siap Membantu Anda Membuat Website Impian</h2>
            <p class="text-lg mt-4">Hubungi kami sekarang untuk konsultasi gratis.</p>
            <a href="#form"
                class="mt-6 inline-block px-8 py-3 bg-white text-orange-600 font-semibold rounded-lg shadow-md hover:bg-gray-200 transition">
                Ajukan Proyek
            </a>
        </div>
    </section>

    <!-- Project Request Form -->
    <section id="form" class="py-16">
        <div class="container mx-auto max-w-2xl bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center">Ajukan Proyek Anda</h2>
            <p class="text-gray-600 text-center mt-2">Isi form di bawah ini untuk mendapatkan penawaran terbaik dari kami.</p>
            <form action="{{ route('landing.submitProject') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="ref" value="{{ request('ref') }}">

                <div>
                    <label for="client_name" class="block text-gray-700 font-semibold">Nama Calon Klien</label>
                    <input type="text" id="client_name" name="client_name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500"
                        placeholder="Masukkan nama klien" value="{{ old('client_name') }}">
                    @error('client_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="client_email" class="block text-gray-700 font-semibold">Email Calon Klien</label>
                    <input type="email" id="client_email" name="client_email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500"
                        placeholder="Masukkan email klien" value="{{ old('client_email') }}">
                    @error('client_email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="project_type" class="block text-gray-700 font-semibold">Jenis Proyek</label>
                    <select id="project_type" name="project_type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500">
                        <option value="website" {{ old('project_type') == 'website' ? 'selected' : '' }}>Website</option>
                        <option value="application" {{ old('project_type') == 'application' ? 'selected' : '' }}>Aplikasi</option>
                        <option value="other" {{ old('project_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('project_type')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="project_description" class="block text-gray-700 font-semibold">Deskripsi Proyek</label>
                    <textarea id="project_description" name="project_description" rows="4"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500"
                        placeholder="Masukkan deskripsi proyek">{{ old('project_description') }}</textarea>
                    @error('project_description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-orange-600 text-white py-3 rounded-lg font-semibold hover:bg-orange-700 transition">
                    Ajukan Proyek
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6">
        <div class="container mx-auto text-center text-white">
            <p>&copy; 2024 TerasWeb. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
