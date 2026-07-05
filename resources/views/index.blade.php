<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Login | PortalX</title>

    <!-- Bootstrap 4.6 CSS CDN -->
    <link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}">
    <!-- Font Awesome for Premium Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Style for Dynamic Dark & Light Theme -->
    <style>
        :root {
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --input-bg: #0f172a;
            --input-border: #334155;
            --label-color: #f1f5f9;
        }

        [data-theme="light"] {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --input-bg: #f1f5f9;
            --input-border: #cbd5e1;
            --label-color: #334155;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('resources/css/index.css') }}">

    <!-- CRITICAL SCRIPT: Refresh-e theme lock rakhar jonno top layer script -->
    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>
</head>

<body>

    <!-- Container Form Box -->
    <div class="card login-card m-3">

        <!-- Theme Toggler -->
        <button type="button" class="theme-toggler" onclick="toggleTheme()" id="themeBtn">
            <i class="fa-solid fa-sun" id="theme-icon"></i>
            <span id="theme-text" class="small font-weight-bold">Light</span>
        </button>

        <!-- Brand Icon / Mini Header -->
        <div class="d-flex align-items-center mb-4 text-cyan font-weight-bold" style="gap: 8px; font-size: 1.35rem;">
            <i class="fa-solid fa-cubes-stacked"></i>
            <span>HR PAYRoll <span class="text-main-color">X</span></span>
        </div>

        <!-- Form Titles -->
        <div class="mb-4">
            <h3 class="text-main-color font-weight-bold mb-1">Account Sign In</h3>
            <p class="text-gray-muted small">Enter your credentials to access your dashboard.</p>
        </div>

        <!-- Laravel Session Error Alert -->
        @if ($errors->any())
            <div class="alert alert-danger border-0 text-danger small rounded-lg p-3 mb-4 d-flex align-items-center"
                style="background-color: rgba(239, 68, 68, 0.1);">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <span class="d-block">{{ $error }}</span>
                    @endforeach
                </div>
            </div>
        @endif
        @if ($errors->has('access_denied'))
            <div class="alert alert-danger border-0 text-danger small rounded-lg p-3 mb-4 d-flex align-items-center"
                style="background-color: rgba(239, 68, 68, 0.15);">
                <i class="fa-solid fa-user-shield mr-2"></i>
                <div>
                    <strong>{{ $errors->first('access_denied') }}</strong>
                </div>
            </div>
        @endif

        <!-- Form Start -->
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Input -->
            <div class="form-group mb-4">
                <label for="email" class="small text-uppercase font-weight-bold label-custom tracking-wider">Email
                    Address</label>
                <div class="position-relative">
                    <i class="fa-regular fa-envelope input-group-icon"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control" placeholder="username@company.com">
                </div>
            </div>

            <!-- Password Input -->
            <div class="form-group mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password"
                        class="small text-uppercase font-weight-bold label-custom tracking-wider mb-0">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="small font-weight-bold text-cyan text-decoration-none">Forgot?</a>
                    @endif
                </div>
                <div class="position-relative">
                    <i class="fa-solid fa-lock input-group-icon"></i>
                    <input type="password" id="password" name="password" required class="form-control"
                        placeholder="••••••••••••">
                    <button type="button" onclick="togglePassword()" class="pass-toggle">
                        <i id="eye-icon" class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="custom-control custom-checkbox mb-4">
                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                <label class="custom-control-label small text-gray-muted cursor-pointer" for="remember_me"
                    style="user-select: none;">Keep me logged in</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-premium btn-block mt-2">
                Sign In to Dashboard
            </button>
        </form>
        <!-- Form End -->

    </div>

    <!-- Theme Logic & UI Sync JavaScript -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const themeIcon = document.getElementById('theme-icon');
            const themeText = document.getElementById('theme-text');

            if (currentTheme === 'light') {
                document.documentElement.setAttribute('data-theme', 'dark');
                themeIcon.classList.replace('fa-moon', 'fa-sun');
                themeText.innerText = "Light";
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                themeIcon.classList.replace('fa-sun', 'fa-moon');
                themeText.innerText = "Dark";
                localStorage.setItem('theme', 'light');
            }
        }

        // Script to run immediately after DOM parses to align layout switches
        document.addEventListener("DOMContentLoaded", function () {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const themeIcon = document.getElementById('theme-icon');
            const themeText = document.getElementById('theme-text');
            if (currentTheme === 'light') {
                themeIcon.classList.replace('fa-sun', 'fa-moon');
                themeText.innerText = "Dark";
            }
        });
    </script>
</body>

</html>