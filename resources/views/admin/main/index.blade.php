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
        <footer class="app-footer text-center">

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

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // 1. Inisialisasi Peta (Center ke koordinat tengah wilayah Anda, misal Jakarta)
                // SetView([lat, lng], zoom_level)
                const map = L.map('mapPerusahaan').setView([-6.200000, 106.816666], 10);

                // 2. Tambahkan Layer Peta (OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // 3. Ambil data dari Laravel
                const locations = {!! json_encode($mapData) !!};

                // 4. Buat Marker untuk setiap perusahaan
                locations.forEach(function (place) {
                    if (place.latitude && place.longitude) {
                        L.marker([place.latitude, place.longitude])
                            .addTo(map)
                            .bindPopup(`<b>${place.nama_perusahaan}</b>`);
                    }
                });

                // Opsional: Jika ingin peta otomatis menyesuaikan zoom agar semua titik terlihat
                if (locations.length > 0) {
                    const group = new L.featureGroup(locations.map(p => L.marker([p.latitude, p.longitude])));
                    map.fitBounds(group.getBounds());
                }
            });
        </script>

       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <script>
        document.addEventListener('DOMContentLoaded', function () {
        // --- KONFIGURASI PIE CHART IZIN LKPM ---
        const ctxLKPM = document.getElementById('piechartIzinLKPM').getContext('2d');
        
        new Chart(ctxLKPM, {
            type: 'pie',
            plugins: [ChartDataLabels],
            data: {
                labels: ['Sudah Lapor', 'Belum Lapor'],
                datasets: [{
                    data: {!! json_encode($pieLKPM) !!},
                    backgroundColor: [
                        '#36b9cc', // Cyan/Biru Muda
                        '#e74a3b'  // Merah
                    ],
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    title: {
                        display: true,
                        text: 'Status Laporan LKPM',
                        font: { size: 14, weight: 'bold' }
                    },
                    datalabels: {
                        color: '#fff',
                        font: { weight: 'bold' },
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => sum += data);
                            if (sum === 0) return "0%";
                            return (value * 100 / sum).toFixed(1) + "%";
                        }
                    }
                }
            }
        });
    });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('chartHorizontal').getContext('2d');
        
        const labels = {!! json_encode($year) !!}; 
        const dataValues = {!! json_encode($total) !!};

        new Chart(ctx, {
            type: 'bar',
            plugins: [ChartDataLabels], // Aktifkan plugin angka di ujung
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Data',
                    data: dataValues,
                    backgroundColor: '#183a8f', // Warna ungu sesuai gambar
                    borderWidth: 0,
                    borderRadius: 4, // Membuat ujung bar sedikit membulat
                    barThickness: 25, // Ketebalan bar
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }, // Sembunyikan legend seperti gambar
                    datalabels: {
                        anchor: 'end',
                        align: 'right',
                        color: '#444',
                        font: { weight: 'bold' },
                        formatter: Math.round // Menampilkan angka bulat
                    }
                },
                scales: {
                    x: {
                        display: false, // Sembunyikan garis bawah (sumbu X) seperti gambar
                        grid: { display: false }
                    },
                    y: {
                        grid: { display: false }, // Sembunyikan garis grid belakang
                        ticks: {
                            color: '#000',
                            font: { weight: 'bold', size: 12 }
                        }
                    }
                },
                layout: {
                    padding: {
                        right: 50 // Beri ruang di kanan agar angka tidak terpotong
                    }
                }
            }
        });
    });
</script>

    <!-- piechart pkkpr -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctxPie = document.getElementById('piechartIzinLokasi').getContext('2d');
            
            const dataPie = {
                labels: {!! json_encode($pieLabels) !!},
                datasets: [{
                    data: {!! json_encode($pieData) !!},
                    backgroundColor: [
                        '#4e73df', // Biru untuk Sudah Lapor
                        '#e74a3b'  // Merah untuk Belum Lapor
                    ],
                    hoverOffset: 4
                }]
            };

            new Chart(ctxPie, {
                type: 'pie',
                data: dataPie,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Status Izin Lokasi (PKKPR)'
                        },
                        // Jika ingin memunculkan angka/persentase di dalam pie
                        datalabels: {
                            color: '#fff',
                            font: { weight: 'bold' },
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => { sum += data; });
                                let percentage = (value * 100 / sum).toFixed(1) + "%";
                                return percentage;
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Gunakan plugin datalabels agar lebih informatif
            });
        });
    </script>
    <!-- piechart pkkpr -->

    <!-- piechart izin lokasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- KONFIGURASI PIE CHART IZIN LINGKUNGAN ---
            const ctxLingkungan = document.getElementById('piechartIzinLingkungan').getContext('2d');
            
            new Chart(ctxLingkungan, {
                type: 'pie',
                plugins: [ChartDataLabels],
                data: {
                    labels: ['Sudah Lapor', 'Belum Lapor'],
                    datasets: [{
                        data: {!! json_encode($pieLingkungan) !!},
                        backgroundColor: [
                            '#1cc88a', // Hijau (Lingkungan biasanya identik dengan hijau)
                            '#e74a3b'  // Merah
                        ],
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' },
                        title: {
                            display: true,
                            text: 'Status Izin Lingkungan (IL)',
                            font: { size: 14, weight: 'bold' }
                        },
                        datalabels: {
                            color: '#fff',
                            font: { weight: 'bold' },
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => sum += data);
                                return (value * 100 / sum).toFixed(1) + "%";
                            }
                        }
                    }
                }
            });
        });
    </script>
    <!-- batas piechart izin lokasi -->

    <!-- piechart standar sertifikat -->
     <script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- KONFIGURASI PIE CHART SERTIFIKAT STANDAR ---
        const ctxSertifikat = document.getElementById('piechartIzinSertifikat').getContext('2d');
        
        new Chart(ctxSertifikat, {
            type: 'pie',
            plugins: [ChartDataLabels],
            data: {
                labels: ['Sudah Lapor', 'Belum Lapor'],
                datasets: [{
                    data: {!! json_encode($pieSertifikat) !!},
                    backgroundColor: [
                        '#f6c23e', // Kuning (Warna khas sertifikat/emas)
                        '#e74a3b'  // Merah
                    ],
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    title: {
                        display: true,
                        text: 'Status Sertifikat Standar',
                        font: { size: 14, weight: 'bold' }
                    },
                    datalabels: {
                        color: '#fff',
                        font: { weight: 'bold' },
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => sum += data);
                            if (sum === 0) return "0%"; 
                            return (value * 100 / sum).toFixed(1) + "%";
                        }
                    }
                }
            }
        });
    });
     </script>
    <!-- piechart standart sertifikat -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil data dari PHP
        const rawLabels = {!! json_encode($perusahaanNames) !!};
        const rawData = {!! json_encode($investasiValues) !!};

        // Pastikan data ada
        if (rawLabels.length === 0) {
            console.error("Data investasi kosong!");
            return;
        }

        const ctx = document.getElementById('chartHorizontalInvestasi').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            // Plugin datalabels harus dipanggil di sini jika menggunakan CDN plugin
            plugins: [typeof ChartDataLabels !== 'undefined' ? ChartDataLabels : {}], 
            data: {
                labels: rawLabels,
                datasets: [{
                    label: 'Nilai Investasi',
                    data: rawData,
                    backgroundColor: '#183a8f', 
                    borderRadius: 5,
                    barThickness: 30
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        anchor: 'end',
                        align: 'right',
                        formatter: (val) => new Intl.NumberFormat('id-ID').format(val),
                        color: '#000',
                        font: { weight: 'bold' }
                    }
                },
                scales: {
                    x: { 
                        beginAtZero: true, // WAJIB ada agar bar muncul dari titik nol
                        display: false 
                    },
                    y: {
                        grid: { display: false },
                        ticks: { color: '#000', font: { weight: 'bold' } }
                    }
                },
                layout: {
                    padding: { right: 100 }
                }
            }
        });
    });
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
                // const iconContainer = document.getElementById(`status-icon-${idBap}`);

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
                            const iconContainerPkkpr = document.getElementById(`status-icon-pkkpr-${idBap}`);
                            const pkkpParagraf = document.getElementById(`pkkpr-p-${idBap}`);

                            if (parseInt(updatedStatusKppr) == 1) {
                                iconContainerPkkpr.innerHTML = '<p class="text-center fw-bold">✅</p>';
                                pkkpParagraf.innerHTML = '<p class="text-center fw-bold">✅</p>';
                            } else {
                                iconContainerPkkpr.innerHTML = '<p class="text-center fw-bold">❌</p>';
                                pkkpParagraf.innerHTML = '<p class="text-center fw-bold">❌</p>';
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

    <!-- update lingkungan -->
    <script>
        document.querySelectorAll('.btn-update-lingkungan').forEach(button => {
            button.addEventListener('click', function () {
                const idBap = this.getAttribute('data-id');

                
                // Beri efek loading sederhana (opsional)
                this.innerText = 'Loading...';
                this.disabled = true;

                fetch(`/realisasi/update-izin-lingkungan/${idBap}`, {
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
                            const updateStatusLingkungan = data.data.il;
                            const iconContainerLingkungan = document.getElementById(`status-icon-lingkungan-${idBap}`);
                            const lingkunganParagraf = document.getElementById(`lingkungan-p-${idBap}`);

                            if (parseInt(updateStatusLingkungan) == 1) {
                                iconContainerLingkungan.innerHTML = '<p class="text-center fw-bold">✅</p>';
                                lingkunganParagraf.innerHTML = '<p class="text-center fw-bold">= ✅</p>';
                            } else {
                                iconContainerLingkungan.innerHTML = '<p class="text-center fw-bold">❌</p>';
                                lingkunganParagraf.innerHTML = '<p class="text-center fw-bold">= ❌</p>';
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
    <!-- update lingkungan -->
    <!-- update standart -->
    <script>
        document.querySelectorAll('.btn-update-sertifikat-standart').forEach(button => {
            button.addEventListener('click', function () {
                const idBap = this.getAttribute('data-id');
                

               
                this.innerText = 'Loading...';
                this.disabled = true;

                fetch(`/realisasi/update-sertifikat-standart/${idBap}`, {
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
                            const updateSertifkat = data.data.sertifikat_standar;
                            const iconContainerSertifikat = document.getElementById(`status-icon-sertifikat-standart-${idBap}`);
                            const sertifikatParagraf = document.getElementById(`sertifikat-p-${idBap}`);

                            if (parseInt(updateSertifkat) == 1) {
                                iconContainerSertifikat.innerHTML = '<p class="text-center fw-bold">✅</p>';
                                sertifikatParagraf.innerHTML = '<p class="text-center fw-bold"> = ✅</p>';
                            } else {
                                iconContainerSertifikat.innerHTML = '<p class="text-center fw-bold">❌</p>';
                                sertifikatParagraf.innerHTML = '<p class="text-center fw-bold"> = ❌</p>';
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
    <!-- update lingkungan -->

    @if (Request::is('profile/edit-password*'))
        <script>
            function togglePassword(inputId, el) {
                let input = document.getElementById(inputId);
                let icon = el.querySelector("i");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("bi-eye");
                    icon.classList.add("bi-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("bi-eye-slash");
                    icon.classList.add("bi-eye");
                }
            }
        </script>
    @endif

</body>
<!--end::Body-->

</html>