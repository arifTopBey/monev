    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">

            <ul class="navbar-nav">

                <li>
                    <p class="fs-5">Admin Monev</p>
                </li>

            </ul>
            <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
    </nav>
    <!--end::Header-->

    <!--begin::Sidebar-->
    <aside style="background-image: linear-gradient(135deg, #0f299d, #18388f, #3385e4, #3491e9)" class="app-sidebar shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <!--begin::Brand Image-->
                <img src="{{ asset('image/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow" />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light fs-7">Database Monev</span>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">

            <div class="sidebar-brand">
                <a href="./index.html" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="{{ asset('image/user6-128x128.jpg') }}" alt="AdminLTE Logo"
                        class="brand-image rounded-circle opacity-75 shadow" />

                    <span class="brand-text fw-light fs-7">Admin</span>
                </a>
            </div>
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                    aria-label="Main navigation" data-accordion="false" id="navigation">
                    <li class="nav-item {{ Request::is('dashboard') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('dashboard') ? 'active bg-black' : '' }}">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Dashboard
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Dashboard Monev</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::is('pembinaan*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('pembinaan*') ? 'active bg-black' : '' }}">
                            <i class="nav-icon bi bi-geo-fill"></i>
                            <p>
                                Pembinaan
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('pembinaan') }}" class="nav-link {{ Request::is('pembinaan') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Database Pembinaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('realisasi.pembinaan.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data Realisasi Pembinaan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::is('monev*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('monev*') ? 'active bg-black' : '' }}">
                            <i class="nav-icon bi bi-geo-fill"></i>
                            <p>
                                Monev
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('monev') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Database Monev</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  {{ Request::is('realisasi') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('realisasi') ? 'active bg-black' : '' }}"">
                            <i class="nav-icon bi  bi-file-earmark"></i>
                            <p class="fs-8">
                                Data & Realisasi Monev
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('realisasi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="fs-6">Data & Realisasi Monev</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{ Request::is('profile*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('profile*') ? 'active bg-black' : '' }}">
                            <i class="bi bi-person-circle"></i>
                            <p>
                                Profile
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.auth.profile', auth()->user()->id) }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Akun</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-box-arrow-right"></i>
                            <p class="fs-8">
                                Logout
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                 <form action="{{ route('admin.logout') }}" method="post">
                                    @csrf
                                    {{-- <i class="nav-icon bi bi-box-arrow-in-right"></i> --}}

                                    <button class="ms-3 nav-link"  type="submit">Logout</button>
                                    {{-- <i class="nav-arrow bi bi-chevron-right"></i> --}}

                                 </form>
                            </li>
                        </ul>
                    </li>


                    <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->
