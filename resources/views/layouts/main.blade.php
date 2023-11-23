<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>
</head>
<body>
   <!-- Header -->
<header>
    <nav class="navbar">
        <div class="container-fluid">
            <button class="openbtn" onclick="openNav()">☰</button>  

            <a style="font-size: 30px; font-style: italic; font-weight: 700; color: black;" href="#">SMART POS</a>

    </nav>

</header>

    <div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')
        <main role="main" id="main" class="col-md-9 pt-3 d-flex flex-column main-content">
            <div class="row p-2 pt-5 pb-3 d-flex align-items-right">
             @yield('content')
            </div>
        </main>
 
    </div>

    </div>

    <footer>
        <div class="container-fluid">
         <div class="row mt-5">
                <div class="col-12 p-5 mt-6 text-center">
                    copyright &copy SMART - 2023
                </div>
            </div>
            </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>
