<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/bootstrap4.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #EBCDC3; padding: 15px;">
        <a class="navbar-brand" style="font-size: 30px; font-style: italic; font-weight: 700; color: black;" href="#">SMART POS</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <img src="img/smart.png" style="width: 70px;" alt="logo">
            </li>
            <!-- Tambahkan menu lain di sini -->
        </ul>
    </nav>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 pt-4">
                    <h2><span style="color: #EBCDC3">BENGKEL</span> SMART</h2>
                    <div class="pt-4">
                        <h2>Memperkenalkan Moka Ultra & Ultra+. <br> Perangkat kasir paling mutakhir untuk kenyamanan dan kemudahan operasi bisnis.</h2>
                    </div>
                    <div class="pt-5">
                        <a href="{{ route('indexlogin') }}" class="btn btn-lg" style="border-radius: 30px; width: 372px; height: 100%; background-color: #EBCDC3; color: white;" role="button" aria-pressed="true">LOGIN</a>
                    </div>
                </div>
                <div class="col-md-6 pt-3 text-center">
                    <img src="img/mekanik.png" alt="mekanik" style="width: 65%;">
                </div>
            </div>
        </div>
        
    </main>
    

    <div class="row mt-5">
                <div class="col-12 p-5 border text-center">
                    copyright &copy SMART - 2023
                </div>
            </div>

    <!-- Script Bootstrap (JQuery, Popper.js, Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>