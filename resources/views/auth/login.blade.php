<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tenda Ponstra</title>
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('template') }}/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('template') }}/compiled/css/app-dark.css">
    <link rel="stylesheet" href="{{ asset('template') }}/compiled/css/auth.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">

        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow-lg border-0 rounded-4" style="max-width: 420px; width: 100%;">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <a href="#">
                            <img src="{{ asset('image/logo.png') }}" alt="Logo" width="80">
                        </a>
                    </div>

                    <form action="{{ route('login.action') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="email" class="form-control form-control-lg"
                                placeholder="Email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-lg"
                                placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-lg w-100 shadow-sm" type="submit">Log in</button>
                        {{-- login with google --}}
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <p class="text-muted text-center mt-2 fw-bold">or sign in with</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-2">
                            <a href="{{ route('auth.google') }}" class="btn btn-light btn-lg w-100 shadow-sm">
                                <i class="bi bi-google me-2"></i> Google
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
