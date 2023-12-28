<!-- Sidebar -->
<nav class="col-md-3 col-lg-2 d-md-block sidebar side" id="mySidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <img src="/img/logo.png" style="width: 50%; margin-top:6px;" alt="logo">
    <!-- Sidebar content -->
    @php
    $userDetail = config('user.userDetail')();
    @endphp
    <h5 class="sidebar-title">{{ $userDetail->nama }}</h5>
    <div class="col-lg-4 p-1 role">
        @php
        $role = config('user.role')();
        @endphp
        <h6>{{ $role }}</h6>
    </div>
    <hr style="background-color: #936151;">
    <ul class="nav flex-column" style="text-align: left;">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile') }}">Halaman Utama</a>
        </li>
        @foreach(config('sidebar.'.$role) as $modul)
        <li class="nav-item">
            <a class="nav-link" href="{{ route($modul['route']) }}">{{ $modul['label'] }}</a>
        </li>
    @endforeach
    </ul>
    <hr style="background-color: #936151;">
    <ul class="nav flex-column" style="text-align: left;">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">Keluar</a>
        </li>
    </ul>
</nav>
