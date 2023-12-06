<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/bootstrap4.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" type="image/x-icon" href="{{ 'img/logo.ico' }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #EBCDC3; padding: 15px;">
        <a class="navbar-brand" style="font-size: 30px; font-style: italic; font-weight: 600;" href="/">SMART</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <img src="/img/logo.png" style="width: 50px;" alt="logo">
            </li>
            <!-- Tambahkan menu lain di sini -->
        </ul>
    </nav>

    <!-- Card menggunakan Bootstrap -->
    <div class="card custom-card">
        <div class="card-body">
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <h5 class="card-title title" style="color: #EBCDC3;">Log In</h5>
            <form action="{{ route('login') }}" method="post">         
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control login" id="nip" name="nip" placeholder="NIP" value="{{ old('nip') }}" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control login" id="password" name="password" placeholder="PASSWORD" required>
                </div>

                <button type="submit" class="btn submit">Login</button>
            </form>
        </div>
    </div>

    <!-- Script Bootstrap (JQuery, Popper.js, Bootstrap JS) -->
    <script src="img/img/https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="img/img/https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="img/img/https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
