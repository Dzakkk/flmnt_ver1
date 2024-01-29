<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - Falmont</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('template/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('template/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    {{-- <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"> --}}
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                {{-- <img src="assets/img/logo.png" alt=""> --}}
                <span class="d-none d-lg-block">Falmnot</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        {{-- <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="GET" action="/petugas/search">
                <input type="search" name="search" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar --> --}}

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('images/falmont.png') }}" alt="Profile">
                        {{-- <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nama }}</span> --}}
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            {{-- <h6>{{ Auth::user()->nama }}</h6>
                            <span>{{ Auth::user()->role }}</span> --}}
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link" href="/petugas/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#pegawai-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i>
                    <span>Pegawai</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pegawai-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/petugas/dashboard/pegawai">
                            <i class="bi bi-circle"></i><span>user Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="/petugas/storeUser">
                            <i class="bi bi-circle"></i><span>Tambah user</span>
                        </a>
                    </li>
                </ul>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#Biodata-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>Biodata</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Biodata-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/petugas/dashboard/biodata">
                            <i class="bi bi-circle"></i><span>Biodata Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="/petugas/storeBiodata">
                            <i class="bi bi-circle"></i><span>Tambah Biodata</span>
                        </a>
                    </li>
                </ul>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#Pendidikan-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-book"></i><span>Pendidikan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Pendidikan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/petugas/dashboard/pendidikan">
                            <i class="bi bi-circle"></i><span>Pendidikan Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="/petugas/storePendidikan">
                            <i class="bi bi-circle"></i><span>Tambah Pendidikan</span>
                        </a>
                    </li>
                </ul> --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#barang-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box-seam"></i><span>Barang</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="barang-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/barang">
                            <i class="bi bi-circle"></i><span>Data Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="/barangMasuk">
                            <i class="bi bi-circle"></i><span>Barang Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="/barangKeluar">
                            <i class="bi bi-circle"></i><span>Barang Keluar</span>
                        </a>
                    </li>
                </ul>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#stock-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box-seam"></i><span>Persediaan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="stock-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/stock/barang">
                            <i class="bi bi-circle"></i><span>Stock Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="/stock/product">
                            <i class="bi bi-circle"></i><span>Stock Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="/stock/lot">
                            <i class="bi bi-circle"></i><span>Stock/LOT</span>
                        </a>
                    </li>
                </ul>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#product-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bx bxs-flask"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="product-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="/product">
                            <i class="bi bi-circle"></i><span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="/formula">
                            <i class="bi bi-circle"></i><span>Formula</span>
                        </a>
                    </li>
                </ul>


            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/gudang">
                    <i class="bi bi-people-fill"></i>
                    <span>Gudang</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="/supplier ">
                    <i class="bi bi-truck"></i>
                    <span>Supplier</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/customer ">
                    <i class="bi bi-people-fill"></i>
                    <span>Customer</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/manufacturer ">
                    <i class="bi bi-people-fill"></i>
                    <span>Manufacturer</span>
                </a>
            </li>


            <!-- End F.A.Q Page Nav -->

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="/petugas/dashboard/pelatihan">
                    <i class="bi bi-easel"></i>
                    <span>Pelatihan</span>
                </a>
            </li><!-- End Contact Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="/petugas/dashboard/cuti">
                    <i class="bi bi-envelope-open"></i>
                    <span>Cuti</span>
                </a>
            </li><!-- End Register Page Nav --> --}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="/histori">
                    <i class="bi bi-archive"></i>
                    <span>History</span>
                </a>
            </li><!-- End Login Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">

            @yield('gudang')
            @yield('barang')
            @yield('newBarang')
            @yield('data_supplier')
            @yield('barangMasuk')
            @yield('barangKeluar')
            @yield('customer')
            @yield('data_product')
            @yield('product_form')
            @yield('formula')
            @yield('data_lot')
            @yield('stock')
            @yield('script')
            @yield('manufacturer')
            @yield('stock_product')
            @yield('updateProduct')



        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Flmnt</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Created by <a href="https://github.com/Dzakkk">Dzakkk</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('template/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('template/assets/js/main.js') }}"></script>

</body>

</html>
