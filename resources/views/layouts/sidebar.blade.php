<!-- Sidebar -->
<nav class="col-md-3 col-lg-2 d-md-block sidebar side" id="mySidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <!-- Sidebar content -->
    <br>
            <img src="img/Smart.png" alt="logo" style="width: 40%;">
    @php
    $nip = session('nip', '');
    @endphp
    <h5 class="sidebar-title">{{ $nip }}</h5>
    <div class="col-lg-4 p-1 role">
        @php
        $role = session('role', '');
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
