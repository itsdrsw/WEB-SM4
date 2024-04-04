<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- Datatables css -->
    <link href="{{ asset('administrator/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('administrator/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('administrator/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('administrator/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('administrator/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('administrator/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />


    <!-- App favicon -->
        <link rel="icon" type="image/png" href="{{ asset('administrator/assets/images/logo-sm.png') }}">

    <!-- Plugin css -->
    <link href="{{ asset('administrator/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{ asset('administrator/assets/js/hyper-config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('administrator/assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('administrator/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">
                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="." class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('administrator/assets/images/logo.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('administrator/assets/images/logo.png') }}" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="." class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ asset('administrator/img/logo komersial sip transparant.png') }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('administrator/assets/images/logo-dark-sm.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="ri-apps-2-line"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                    <!-- Topbar Search Form -->
                    <!-- <div class="app-search dropdown d-none d-lg-block">
                            <form>
                                <div class="input-group">
                                    <input type="search" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button class="input-group-text btn btn-success" type="submit">Search</button>
                                </div>
                            </form>
                        </div> -->
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-search-line font-22"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="search" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>

                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Theme Mode">
                            <i class="ri-moon-line font-22"></i>
                        </div>
                    </li>


                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="#" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line font-22"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="assets/images/users/user-1.jpg" alt="user-image" width="32"
                                    class="rounded-circle">
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0"></h5>
                                <h6 class="my-0 fw-normal"></h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <a href=".?hal=close" class="dropdown-item">
                                <i class="ri-logout-circle-line"></i>
                                <span> Keluar</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- Brand Logo Light -->
            <a href="." class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('administrator/assets/images/chef_light.png') }}" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('administrator/assets/img/LogoPerson.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Brand Logo Dark -->
            <a href="." class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('administrator/assets/images/chef_light.png') }}" alt="dark logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('administrator/assets/img/LogoPerson.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!-- Leftbar User -->
                <div class="leftbar-user">
                    <a href="pages-profile.html">
                        <img src="{{ asset('administrator/assets/images/users/avatar-10.jpg') }}" alt="user-image" height="42"
                            class="rounded-circle shadow-sm">
                        <span class="leftbar-user-name mt-2"></span>
                    </a>
                </div>
                <!--- Sidemenu -->
                <ul class="side-nav">
                    <li class="side-nav-title">Menu</li>
                    <li class="side-nav-item">
                        <a href=".?hal=home" class="side-nav-link">
                            <i class="ri-home-smile-fill"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <li class="side-nav-item" aria-expanded="false">
                        <a href=".?hal=datauser" class="side-nav-link">
                            <i class="mdi mdi-book-open-variant"></i>
                            <span> Progam Kerja </span>
                        </a>
                        <!-- </li>
                        <li class="side-nav-item" aria-expanded="false">
                            <a href=".?hal=datauser" class="side-nav-link">
                                <i class=" ri-user-3-fill"></i>
                                <span> Data Pelanggan </span>
                            </a>
                        </li> -->
                    {{-- <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="true"
                            aria-controls="sidebarDashboards" class="side-nav-link">
                            <i class=" ri-cake-3-fill"></i>
                            <span>  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarDashboards">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href=".?hal=kuehajatan">Kue Hajatan</a>
                                </li>
                                <li>
                                    <a href=".?hal=kuekering">Kue Kering</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                    <li class="side-nav-item" aria-expanded="false">
                        <a href=".?hal=permintaan" class="side-nav-link">
                            <i class="mdi mdi-calendar-month"></i>
                            <span> Kegiatan </span>
                        </a>
                    </li>
                    <li class="side-nav-item" aria-expanded="false">
                        <a href=".?hal=pesanan-approve" class="side-nav-link">
                            <i class="mdi mdi-currency-usd"></i>
                            <span> Pendanaan </span>
                        </a>
                    </li>
                    <li class="side-nav-item" aria-expanded="false">
                        <a href=".?hal=pesanan-approve" class="side-nav-link">
                            <i class="mdi mdi-file-multiple"></i>
                            <span> LPJ </span>
                        </a>
                    </li>
                    <li class="side-nav-item" aria-expanded="false">
                        <a href=".?hal=pesanan-approve" class="side-nav-link">
                            <i class="mdi mdi-account-wrench"></i>
                            <span> Atur Akun </span>
                        </a>
                    </li>
                    <!-- <li class="side-nav-item" aria-expanded="false">
                            <a href=".?hal=pesanan" class="side-nav-link">
                                <i class="ri-shopping-cart-fill"></i>
                                <span> Pesanan </span>
                            </a>
                        </li> -->
                </ul>
                <!--- End Sidemenu -->
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Allright. reserved
                        </div>
                        <!-- <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div> -->
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- make menu item acrive -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mengambil semua elemen side-nav-item
            var sideNavItems = document.querySelectorAll(".side-nav-item");

            // Menambahkan event listener untuk setiap elemen side-nav-item
            sideNavItems.forEach(function(item) {
                item.addEventListener("click", function() {
                    // Menghapus kelas menuitem-active dari semua elemen
                    sideNavItems.forEach(function(item) {
                        item.classList.remove("menuitem-active");
                    });

                    // Menambahkan kelas menuitem-active ke elemen yang diklik
                    this.classList.add("menuitem-active");
                });
            });
        });
    </script>
    <!-- end make menu item active -->

    <!-- Vendor js -->
    <script src="{{ asset('administrator/assets/js/vendor.min.js') }}"></script>

    <!-- Bootstrap Datepicker js -->
    <script src="{{ asset('administrator/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- Chart js -->
    <script src="{{ asset('administrator/assets/vendor/chart.js/chart.min.js') }}"></script>

    <!-- Projects Analytics Dashboard App js -->
    <script src="{{ asset('administrator/assets/js/pages/demo.dashboard-projects.js') }}"></script>

    <!-- Datatables js -->
    <script src="{{ asset('administrator/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="{{ asset('administrator/assets/js/pages/demo.datatable-init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('administrator/assets/js/app.min.js') }}"></script>

</body>

</html>
