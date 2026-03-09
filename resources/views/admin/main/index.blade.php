<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Monev Dashboard</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="Monev Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('css/adminlte.css') }}" />

    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    {{-- leaft cdn --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="icon" href="{{ asset('image/monev.png') }}">

    <style>
        /* maps */
        #map {
            height: 400px;
            /* WAJIB ada height agar muncul */
            width: 100%;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            display: block !important;
            opacity: 1 !important;
            cursor: pointer !important;
            /* Opsional: memastikan ikon tidak tertutup */
            position: absolute;
            right: 15px;
        }

        /* Memastikan input memiliki ruang untuk absolute position */
        input[type="date"] {
            position: relative;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        @include('admin.partial.sidebar')
        <!--end::Sidebar-->

        <!--begin::App Main-->
        @yield('content')
        <!--end::App Main-->

        <!--begin::Footer-->
        <footer class="app-footer">

            <strong>
                Monev &copy; 2026 &nbsp;
                <!-- <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>. -->
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/adminlte.js') }}" crossorigin="anonymous"></script>

    <!-- piechart -->
    @if (Request::is('dashboard'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>

            const ctx = document.getElementById('piechart');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Sudah Lapor LKPM', 'Belum Lapor'],
                    datasets: [
                        {
                            data: ['55', '45'],
                            backgroundColor: ['#0d6efd', '#dc3545'],
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            psoition: 'right'
                        }
                    }
                }
            })
            console.log(ctx);
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebarWrapper = document.querySelector(".sidebar-wrapper");
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined") {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: "os-theme-light",
                        autoHide: "leave",
                        clickScroll: true,
                    },
                });
            }
        });

        // row per pages
        document.getElementById('rowPerPage').addEventListener('change', function () {
            const rowPerPage = this.value;
            const url = new URL(window.location.href);

            // Update atau tambah parameter row_per_page
            url.searchParams.set('row_per_page', rowPerPage);

            // Reset ke halaman 1 setiap kali jumlah baris berubah agar tidak error
            url.searchParams.set('page', 1);

            // Pindah ke URL baru
            window.location.href = url.href;
        });
    </script>
    <!--end::Script-->

    {{-- delete cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data " + name + " akan dihapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user klik 'Ya', submit form-nya
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

    </script>
    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                timer: 4000, // Hilang otomatis dalam 3 detik
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- leaft cdn --}}
    @if (Request::is('monev*'))
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // // 1. Koordinat Awal (Jakarta)
                // var initialLat = -6.200000;
                // var initialLng = 106.816666;
                // var initialRadius = document.getElementById('radius').value;

                // 1. Ambil data dari database (Blade) atau gunakan default jika kosong
                var initialLat = {{ $monev->latitude ?? -6.200000 }};
                var initialLng = {{ $monev->longitude ?? 106.816666 }};
                var initialRadius = document.getElementById('radius').value;

                // 2. Inisialisasi Peta
                var map = L.map('map').setView([initialLat, initialLng], 14);

                // 3. Tambahkan Gambar Peta (OSM)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);

                // 4. Tambahkan Marker (Bisa Digeser)
                var marker = L.marker([initialLat, initialLng], {
                    draggable: true
                }).addTo(map);

                // 5. Tambahkan Lingkaran Radius (Warna Biru Transparan)
                var circle = L.circle([initialLat, initialLng], {
                    color: '#3388ff',
                    fillColor: '#3388ff',
                    fillOpacity: 0.2,
                    radius: initialRadius // Mengambil nilai dari input radius
                }).addTo(map);

                // Fungsi Sinkronisasi Peta ke Form
                function updateForm(lat, lng) {
                    document.getElementById('latitude').value = lat.toFixed(8);
                    document.getElementById('longitude').value = lng.toFixed(8);
                }

                // Jalankan saat pertama load
                updateForm(initialLat, initialLng);

                // A. Jika Marker Digeser
                marker.on('dragend', function (e) {
                    var position = marker.getLatLng();
                    circle.setLatLng(position); // Lingkaran ikut pindah
                    updateForm(position.lat, position.lng);
                });

                // B. Jika Peta Diklik
                map.on('click', function (e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;
                    marker.setLatLng([lat, lng]); // Marker loncat ke titik klik
                    circle.setLatLng([lat, lng]); // Lingkaran ikut loncat
                    updateForm(lat, lng);
                });

                // C. JIKA INPUT RADIUS DIUBAH (Ini yang Anda cari)
                document.getElementById('radius').addEventListener('input', function (e) {
                    var newRadius = e.target.value;
                    if (newRadius >= 0) {
                        circle.setRadius(newRadius); // Update ukuran lingkaran secara REAL-TIME
                    }
                });

                // Fix tampilan peta yang kadang suka abu-abu/terpotong
                setTimeout(() => {
                    map.invalidateSize();
                }, 500);
            });
        </script>
    @endif

    <!-- update status -->
    <script>
        document.querySelectorAll('.status-container').forEach(container => {
            container.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                console.log('id pembinaan realisasi = ' + id);
                const currentStatus = this.getAttribute('data-status');
                const newStatus = currentStatus == 0 ? 1 : 0; // Toggle status 0 <-> 1
                const target = this;

                fetch(`/pembinaan/realisasi/status/${id}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                })

                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Ambil status terbaru dari database (hasil return controller)
                            const updatedStatus = data.data.hasilPembinaan;

                            target.setAttribute('data-status', updatedStatus);

                            if (parseInt(updatedStatus) === 1) {
                                target.innerHTML = `<p class="text-success border border-primary px-2 py-1 mb-0 status-text">✔ Sudah Lapor Pembuatan LKPM</p>`;
                            } else {
                                target.innerHTML = `<p class="text-danger border border-primary px-2 py-1 mb-0 status-text"><span class="fw-bold fs-5">x</span> Belum Lapor Pembuatan LKPM</p>`;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal mengubah status');
                    });
            });
        });
    </script>

    <!-- izin lapor update -->
    <script>
        document.querySelectorAll('.btn-update-lkpm').forEach(button => {
            button.addEventListener('click', function () {
                const idBap = this.getAttribute('data-id');
                const iconContainer = document.getElementById(`status-icon-${idBap}`);

                // Beri efek loading sederhana (opsional)
                this.innerText = 'Loading...';
                this.disabled = true;

                fetch(`/realisasi/update-lkpm/${idBap}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                  
                    .then(data => {
                          console.log(data)
                        // Bagian dalam fetch .then(data => { ... })
                        if (data.success) {
                            // Ambil status terbaru dari hasil update di database
                            const updatedStatus = data.data.statusLapor;
                            const iconContainer = document.getElementById(`status-icon-${idBap}`);

                            if (parseInt(updatedStatus) === 1) {
                                iconContainer.innerHTML = '<p class="text-center fw-bold">✅</p>';
                            } else {
                                iconContainer.innerHTML = '<p class="text-center fw-bold">❌</p>';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat update status.');
                    })
                    .finally(() => {
                        // Kembalikan teks tombol
                        this.innerText = 'Ganti Status';
                        this.disabled = false;
                    });
            });
        });
    </script>
    <!-- izin lapor update -->

    <!-- update pkkpr -->
    <script>
        document.querySelectorAll('.btn-update-pkkpr').forEach(button => {
            button.addEventListener('click', function () {
                const idBap = this.getAttribute('data-id');
                const iconContainerPkkpr = document.getElementById(`status-icon-pkkpr-${idBap}`);
                console.log(iconContainerPkkpr);

                // Beri efek loading sederhana (opsional)
                this.innerText = 'Loading...';
                this.disabled = true;

                fetch(`/realisasi/update-pkkpr/${idBap}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                  
                    .then(data => {
                          console.log(data)
                        // Bagian dalam fetch .then(data => { ... })
                        if (data.success) {
                            // Ambil status terbaru dari hasil update di database
                            const updatedStatusKppr = data.data.pkkpr;
                            console.log(updatedStatusKppr)
                            const iconContainerPkkpr = document.getElementById(`status-icon-pkkpr-${idBap}`);

                            if (parseInt(updatedStatusKppr) === 1) {
                                iconContainerPkkpr.innerHTML = '<p class="text-center fw-bold">✅</p>';
                            } else {
                                iconContainerPkkpr.innerHTML = '<p class="text-center fw-bold">❌</p>';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat update status.');
                    })
                    .finally(() => {
                        // Kembalikan teks tombol
                        this.innerText = 'Ganti Status';
                        this.disabled = false;
                    });
            });
        });
    </script>
    <!-- update pkkpr -->

</body>
<!--end::Body-->

</html>