<!DOCTYPE html>
<html lang="en">

@include('view::parts.head')

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('view::parts.sidebar-left')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('view::parts.nav.nav')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    @yield('subtitle')
                </div>


                <!-- Main content in rows -->
                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('view::parts.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ Module::asset("view:vendor/jquery/jquery.min.js") }}"></script>
<script src="{{ Module::asset("view:vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ Module::asset("view:vendor/jquery-easing/jquery.easing.min.js") }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ Module::asset("view:js/sb-admin-2.min.js") }}"></script>

<!-- Page level plugins -->
<script src="{{ Module::asset("view:vendor/chart.js/Chart.min.js") }}"></script>

<!-- Page level custom scripts -->
<script src="{{ Module::asset("view:js/demo/chart-area-demo.js") }}"></script>
<script src="{{ Module::asset("view:js/demo/chart-pie-demo.js") }}"></script>

</body>

</html>
