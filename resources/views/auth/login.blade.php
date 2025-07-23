<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Connexion - Auto Hall')</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --light-bg: #f8fafc;
            --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --input-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-wrapper {
            display: flex;
            min-height: 600px;
        }

        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .auth-left .content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .logo-container {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-container img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .auth-right {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container {
            max-width: 400px;
            width: 100%;
        }

        .form-title {
            color: #1f2937;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: var(--secondary-color);
            margin-bottom: 40px;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.875rem;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: var(--input-shadow);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--secondary-color);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 24px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            font-size: 0.875rem;
            color: #6b7280;
            cursor: pointer;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #dc2626;
            border-left: 4px solid var(--danger-color);
        }

        @media (max-width: 768px) {
            .auth-container {
                margin: 10px;
                border-radius: 16px;
            }

            .auth-wrapper {
                flex-direction: column;
                min-height: auto;
            }

            .auth-left {
                padding: 40px 30px;
                min-height: 300px;
            }

            .auth-right {
                padding: 40px 30px;
            }

            .form-title {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                margin: 5px;
            }

            .auth-left, .auth-right {
                padding: 30px 20px;
            }

            .form-title {
                font-size: 1.5rem;
            }
        }

        .btn-loading {
            position: relative;
            color: transparent;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>

<div class="auth-container">
    <div class="auth-wrapper">
        <div class="auth-left">
            <div class="content">
                <div class="logo-container">
                    <img src="{{ asset('images/image.png') }}" alt="Logo Auto Hall">
                </div>
                <h1 class="h2 mb-3 fw-bold">Bienvenue sur BonHub</h1>
                <p class="mb-0 opacity-90">Votre plateforme de gestion des bons de carburant. Connectez-vous pour accéder à votre espace sécurisé.</p>
            </div>
        </div>

            <div class="auth-right">
            <div class="form-container">
                <h2 class="form-title">Connexion</h2>
                <p class="form-subtitle">Accédez à votre compte en toute sécurité</p>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Adresse e-mail
                        </label>
                        <input id="email" 
                               type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               placeholder="votre@email.com">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Mot de passe
                        </label>
                        <div class="input-group">
                            <input id="password" 
                                   type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required
                                   placeholder="Votre mot de passe">
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <div class="text-end mt-2">
                            <a href="{{ route('password.request') }}" class="forgot-password">
                                <i class="fas fa-question-circle me-1"></i>Mot de passe oublié ?
                            </a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                <i class="fas fa-user-check me-2"></i>Se souvenir de moi
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" id="submitBtn">
                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>  



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
        function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;
        
        setTimeout(() => {
            submitBtn.classList.remove('btn-loading');
            submitBtn.disabled = false;
        }, 5000);
    });
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    emailInput.addEventListener('blur', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });
    
    passwordInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            this.classList.remove('is-invalid');
        }
    });

    window.addEventListener('load', function() {
        emailInput.focus();
    });

    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
</script>
</body>
</html>
