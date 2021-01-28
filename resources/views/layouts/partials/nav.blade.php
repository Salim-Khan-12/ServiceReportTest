  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-info navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
            </li>
        @endif
        
        @if (Route::has('register'))
            <li class="nav-item">
                {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Reeegister') }}</a> --}}
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="font-size: 20px;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
  {{-- <ul class="navbar-nav ml-auto">
    
  </ul> --}}
</nav>
<!-- /.navbar -->
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                แดชบอร์ด
              </p>
            </a>
          </li>
          <li class="nav-header"><center>เมนู</center></li>
          <li class="nav-item">
            <a href="/user" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                จัดการสมาชิก
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/project" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                จัดการโครงการ
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="location" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                จัดการสถานที่และสถานี
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                จัดการประเภทงาน
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                จัดการอุปกรณ์
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                จัดการทีมรับผิดชอบปัญหา
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                จัดการช่องทางการแก้ปัญหา
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                เครื่องมือการตั้งค่าระบบ
              </p>
            </a>
          </li>
          <li class="nav-header"><center>บันทึกการแจ้งปัญหา</center></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                บันทึกการแจ้งปัญหาทั้งหมด
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                พิมพ์รายงาน
              </p>
            </a>
          </li>
          <br/><br/>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>