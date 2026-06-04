<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
</head>

<body>
    <div class="login-shell">
        <section class="brand-side">
            <div class="brand-top">
                <div class="brand-badge"><i class="bi bi-airplane-engines"></i></div>
                <p class="brand-kicker">NAAP Aviation TMS</p>
                <h1 class="brand-title">Centralized Aviation Training Monitoring and Compliance</h1>
                <p class="brand-sub">
                    Unified access for NAAP regulators, flying school administrators, flight instructors,
                    and student pilots.
                </p>
                <div class="brand-meta">
                    <div class="meta-pill"><i class="bi bi-shield-check"></i> Regulatory Oversight</div>
                    <div class="meta-pill"><i class="bi bi-clipboard-data"></i> Progress Monitoring</div>
                    <div class="meta-pill"><i class="bi bi-clock-history"></i> Real-time Flight Records</div>
                </div>
            </div>
            <div class="brand-bottom">
                National Aviation Academy of the Philippines | Student Progress Monitoring and Regulatory Compliance
            </div>
        </section>

        <section class="form-side">
            <div class="login-card">
                <div class="login-head mb-4">
                    <h2>Welcome</h2>
                    <p>Sign in to continue to your dashboard.</p>
                </div>

                <div id="alertContainer">
                    @if ($errors->any())
                        <div class="alert-custom">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <form id="loginForm" action="{{ route('auth.login.submit') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@naap.ph"
                                value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password"
                                required>
                            <button class="input-group-text" type="button" id="togglePassword"
                                aria-label="Show password">
                                <i class="bi bi-eye" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="helper-row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a class="helper-link" href="#">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-login">Sign In</button>
                </form>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const alertContainer = document.getElementById('alertContainer');
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');

            // Toggle password visibility
            if (togglePassword && passwordInput && togglePasswordIcon) {
                togglePassword.addEventListener('click', function() {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    togglePasswordIcon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
                });
            }

            // Client-side validation
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Clear previous states
                    alertContainer.innerHTML = '';
                    emailInput.classList.remove('is-invalid');
                    passwordInput.classList.remove('is-invalid');

                    const emailVal = emailInput.value.trim();
                    const passwordVal = passwordInput.value.trim();
                    const errors = [];

                    if (!emailVal) {
                        emailInput.classList.add('is-invalid');
                        errors.push('Please enter your email address.');
                    } else if (!validateEmail(emailVal)) {
                        emailInput.classList.add('is-invalid');
                        errors.push('Please enter a valid email address.');
                    }

                    if (!passwordVal) {
                        passwordInput.classList.add('is-invalid');
                        errors.push('Please enter your password.');
                    }

                    if (errors.length > 0) {
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert-custom';
                        alertDiv.innerHTML = `
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div>
                                ${errors.join('<br>')}
                            </div>
                        `;
                        alertContainer.appendChild(alertDiv);
                        return;
                    }

                    // Success: show loading spinner and submit
                    const submitBtn = loginForm.querySelector('.btn-login');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Signing in...';

                    loginForm.submit();
                });
            }

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        });
    </script>
    @if(session('swal_success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: 'success',
                title: "{{ session('swal_success') }}"
            });
        });
    </script>
    @endif
</body>

</html>
