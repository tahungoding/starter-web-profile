<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') / Jokiin Aja</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo/favicon-16x16.png')}}">
  <link rel="manifest" href="{{ asset('logo/site.webmanifest')}}">
  <!-- CSS Libraries -->
  {{-- <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css"> --}}

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  @if(count($web))
  @foreach ($web as $webs)
      @php 
          $primary_color = $webs->primary_color 
      @endphp
  @endforeach
  @else
    @php 
        $primary_color = "#6777ef";
    @endphp
  @endif
  <style>
    a {
        color: {{$primary_color}};
    }
    .section .section-title::before {
        background-color: {{$primary_color}};
    }

    .card .card-header h4 {
        color: {{$primary_color}};
    }

    #searchResultMenu {
      display: none;
    }
  </style>
  @yield('css')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg" style="background-color: @if(isset($primary_color)) {{$primary_color}} @else #6777ef @endif"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
           
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ Storage::url(Auth::user()->photo)}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->username }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">TAHUNGODING</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">TH</a>
          </div>
          <ul class="sidebar-menu">
              <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
              <li class="{{ request()->routeIs('profile-web.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('profile-web.index') }}"><i class="fas fa-id-card"></i> <span>Profile Web</span></a></li>
              <li class="{{ request()->routeIs('jasa.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('jasa.index') }}"><i class="fas fa-box"></i> <span>Jasa</span></a></li>
              <li class="{{ request()->routeIs('testimonies.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('testimonies.index') }}"><i class="fas fa-box"></i> <span>Testimony</span></a></li>
              <li class="{{ request()->routeIs('teams.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('teams.index') }}"><i class="fas fa-users"></i> <span>Team</span></a></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Hak Akses</span></a>
                <ul class="dropdown-menu">
                  <li class="{{ request()->routeIs('roles.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('roles.index') }}">Role</a></li>
                  <li class="{{ request()->routeIs('permissions.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('permissions.index') }}">Permission</a></li>
                </ul>
              </li>
            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
          @yield('container')
          @yield('modal')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2021 <div class="bullet"></div> <a href="https://tahungoding.com/" @if(isset($primary_color)) style="color: {{$primary_color}}" @else style="color: #6777ef;" @endif>TAHUNGODING</a>
        </div>
      </footer>
    </div>
  </div>
  @include('sweetalert::alert')
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
 
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

 

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  @yield('js')
</body>
</html>
