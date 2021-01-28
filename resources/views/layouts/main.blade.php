<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('layouts.partials.headcss')
       @include('layouts.partials.js')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
        @include('layouts.partials.nav')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-4">
                <div class="col-sm-12">
                  <main class="py-4">
                      @yield('content')
                  </main>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
      </div>

    </body>
</html>
