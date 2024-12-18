<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TerasWeb Affiliate</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @include('sweetalert::alert')
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script>
            if (document.getElementById("affiliateRegistrationTable") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#affiliateRegistrationTable", {
                    searchable: true,
                    sortable: false
                });
            }

            if (document.getElementById("affiliateDataTable") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#affiliateDataTable", {
                    searchable: true,
                    sortable: false
                });
            }

            if (document.getElementById("affiliateRegistrationHistoryTable") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#affiliateRegistrationHistoryTable", {
                    searchable: true,
                    sortable: false
                });
            }

            if (document.getElementById("affiliateClickTable") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#affiliateClickTable", {
                    searchable: true,
                    sortable: false
                });
            }

            if (document.getElementById("affiliateProjectTable") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#affiliateProjectTable", {
                    searchable: true,
                    sortable: false
                });
            }

            if (document.getElementById("commissionTable") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#commissionTable", {
                    searchable: true,
                    sortable: false
                });
            }

            if (document.getElementById("withdrawalTable") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#withdrawalTable", {
                    searchable: true,
                    sortable: false
                });
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const confirmButtons = document.querySelectorAll('.swalWithdrawalConfirm');
    
                confirmButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
    
                    Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to approve the withdrawal?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#8b5cf6",
                    cancelButtonColor: "#ec4899",
                    confirmButtonText: "Yes, approved!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                    });
                });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const rejectButtons = document.querySelectorAll('.swalWithdrawalReject');

                rejectButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); 

                    Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to approve the withdrawal?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#8b5cf6",
                    cancelButtonColor: "#ec4899",
                    confirmButtonText: "Yes, reject it!",
                    cancelButtonText: "Cancel"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                    });
                });
                });
            });
        </script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmButtons = document.querySelectorAll('.swalDefaultConfirm');

            confirmButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                title: "Are you sure?",
                text: "Do you want to activate this affiliate?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#8b5cf6",
                cancelButtonColor: "#ec4899",
                confirmButtonText: "Yes, activate it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
                });
            });
            });
        });
        </script>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmButtons = document.querySelectorAll('.swalDefaultDeactivate');

            confirmButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                title: "Are you sure?",
                text: "Do you want to deactivate this affiliate?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#8b5cf6",
                cancelButtonColor: "#ec4899",
                confirmButtonText: "Yes, deactivate it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
                });
            });
            });
        });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const rejectButtons = document.querySelectorAll('.swalDefaultReject');

                rejectButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); // Mencegah submit form langsung

                    Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to reject this affiliate?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#8b5cf6",  // Warna ungu (Tailwind: purple-500)
                    cancelButtonColor: "#ec4899",   // Warna pink (Tailwind: pink-500)
                    confirmButtonText: "Yes, reject it!",
                    cancelButtonText: "Cancel"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                    });
                });
                });
            });
        </script>
        <script>
            function copyToClipboard() {
            var copyText = document.getElementById("affiliateLink");
            copyText.select();
            document.execCommand("copy");

            // Tampilkan notifikasi SweetAlert setelah menyalin link
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Link has been copied to clipboard!',
                showConfirmButton: false,
                timer: 1500
            });
        }
        </script>
    </body>
</html>
