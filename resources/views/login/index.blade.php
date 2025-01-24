<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS Web App - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-left {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            text-align: center;
            color: black;
        }

        .login-right img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .header h3 {
            font-weight: bold;
        }

        .header p {
            font-size: 1.2rem;
        }

        .form-floating input {
            color: black !important;
        }

        .form-floating label {
            color: black !important;
        }

        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-primary:hover {
            background-color: #a71d2a;
            border-color: #a71d2a;
        }
    </style>
</head>
<body>
    <section class="login">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Section -->
                <div class="col-lg-6 col-md-7 login-left">
                    <div class="container">
                        <div class="header mb-4">
                            <h3>SIMS Web App</h3>
                            <p>Masuk atau buat akun untuk memulai</p>
                        </div>
                        <div class="login-form">
                            <form action="{{route('login.proses')}}" method="POST">
                                @csrf
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" value="{{ @old('email') }}">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" value="{{ @old('password') }}">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                    </div>
                                    <a href="#">Forgot Password</a>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Masuk</button>
                                <p class="text-center mb-0">Don't have an Account? <a href="{{ route('register') }}">Sign Up</a></p>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="col-lg-6 col-md-5 login-right">
                    <img src="{{ asset('assets/CMSAssets/Frame98699.png') }}" alt="Background Image">
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
