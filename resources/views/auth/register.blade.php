<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Register') }} - Join Us Today</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                        'bounce-gentle': 'bounce 3s infinite',
                        'gradient': 'gradient 15s ease infinite',
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                    },
                    backgroundSize: {
                        '400%': '400%',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(5deg); }
            66% { transform: translateY(-10px) rotate(-3deg); }
        }
        @keyframes shimmer {
            0% { background-position: -468px 0; }
            100% { background-position: 468px 0; }
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .gradient-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            position: relative;
        }
        .glass-morphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        }
        .input-glow:focus {
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
            transform: translateY(-2px);
        }
        .shimmer-effect {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 3s infinite;
        }
        .error-message {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .success-message {
            animation: slideIn 0.5s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4 overflow-hidden">
    
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Floating Orbs -->
        <div class="absolute -top-32 -right-32 w-64 h-64 bg-gradient-radial from-purple-400 to-transparent rounded-full opacity-70 animate-pulse-slow"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-gradient-radial from-pink-400 to-transparent rounded-full opacity-60 animate-pulse-slow" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/4 -right-16 w-48 h-48 bg-gradient-radial from-blue-400 to-transparent rounded-full opacity-50 animate-pulse-slow" style="animation-delay: 4s;"></div>
        
        <!-- Floating Geometric Shapes -->
        <div class="absolute top-20 left-20 w-8 h-8 bg-white bg-opacity-20 rounded-full animate-float"></div>
        <div class="absolute top-32 right-32 w-6 h-6 bg-gradient-to-r from-pink-400 to-purple-500 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-32 left-1/4 w-4 h-4 bg-yellow-400 bg-opacity-30 rounded-full animate-float" style="animation-delay: 3s;"></div>
        <div class="absolute bottom-20 right-20 w-10 h-10 bg-white bg-opacity-15 transform rotate-45 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-16 w-5 h-5 bg-gradient-to-r from-blue-400 to-purple-500 transform rotate-45 animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Main Container -->
    <div class="relative w-full max-w-md z-10">
        
        <!-- Register Card -->
        <div class="glass-morphism rounded-3xl p-10 transform transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl">
            
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="relative mx-auto w-24 h-24 mb-6">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 rounded-full animate-pulse-slow"></div>
                    <div class="relative w-full h-full bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 rounded-full flex items-center justify-center shadow-xl">
                        <i class="fas fa-user-plus text-3xl text-white"></i>
                    </div>
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 rounded-full opacity-30 blur-lg"></div>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3">
                    {{ __('Join Us Today') }}
                </h1>
                <p class="text-gray-600 text-lg font-medium">
                    {{ __('Create your account and get started') }}
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 rounded-lg success-message">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-400 mr-3"></i>
                    <span class="text-green-700 font-medium">{{ session('status') }}</span>
                </div>
            </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg error-message">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-triangle text-red-400 mr-3"></i>
                    <span class="text-red-700 font-medium">{{ __('Whoops! Something went wrong.') }}</span>
                </div>
                <ul class="text-red-700 text-sm list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6" id="register-form">
                @csrf

                <!-- Name Field -->
                <div class="relative group">
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-3 transition-all duration-300 group-focus-within:text-indigo-600">
                        <i class="fas fa-user mr-2 text-indigo-500"></i>{{ __('Name') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <i class="fas fa-user text-gray-400 group-focus-within:text-indigo-500 transition-all duration-300"></i>
                        </div>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            required 
                            autofocus 
                            autocomplete="name"
                            class="input-glow w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400 font-medium @error('name') border-red-300 focus:border-red-500 @enderror"
                            placeholder="{{ __('Enter your full name') }}"
                        >
                        <!-- Shimmer Effect on Focus -->
                        <div class="absolute inset-0 shimmer-effect rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    </div>
                    @error('name')
                    <div class="text-red-500 text-sm mt-2 flex items-center error-message">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="relative group">
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-3 transition-all duration-300 group-focus-within:text-indigo-600">
                        <i class="fas fa-envelope mr-2 text-indigo-500"></i>{{ __('Email') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <i class="fas fa-envelope text-gray-400 group-focus-within:text-indigo-500 transition-all duration-300"></i>
                        </div>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required 
                            autocomplete="username"
                            class="input-glow w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400 font-medium @error('email') border-red-300 focus:border-red-500 @enderror"
                            placeholder="{{ __('Enter your email') }}"
                        >
                        <!-- Shimmer Effect on Focus -->
                        <div class="absolute inset-0 shimmer-effect rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    </div>
                    @error('email')
                    <div class="text-red-500 text-sm mt-2 flex items-center error-message">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="relative group">
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-3 transition-all duration-300 group-focus-within:text-indigo-600">
                        <i class="fas fa-lock mr-2 text-indigo-500"></i>{{ __('Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <i class="fas fa-lock text-gray-400 group-focus-within:text-indigo-500 transition-all duration-300"></i>
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="input-glow w-full pl-12 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400 font-medium @error('password') border-red-300 focus:border-red-500 @enderror"
                            placeholder="{{ __('Create a strong password') }}"
                        >
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center z-10" onclick="togglePassword('password', 'password-eye')">
                            <i id="password-eye" class="fas fa-eye text-gray-400 hover:text-indigo-500 transition-all duration-300 transform hover:scale-110"></i>
                        </button>
                        <!-- Shimmer Effect on Focus -->
                        <div class="absolute inset-0 shimmer-effect rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    </div>
                    @error('password')
                    <div class="text-red-500 text-sm mt-2 flex items-center error-message">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="relative group">
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-3 transition-all duration-300 group-focus-within:text-indigo-600">
                        <i class="fas fa-check-circle mr-2 text-indigo-500"></i>{{ __('Confirm Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <i class="fas fa-check-circle text-gray-400 group-focus-within:text-indigo-500 transition-all duration-300"></i>
                        </div>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            class="input-glow w-full pl-12 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400 font-medium @error('password_confirmation') border-red-300 focus:border-red-500 @enderror"
                            placeholder="{{ __('Confirm your password') }}"
                        >
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center z-10" onclick="togglePassword('password_confirmation', 'password-confirmation-eye')">
                            <i id="password-confirmation-eye" class="fas fa-eye text-gray-400 hover:text-indigo-500 transition-all duration-300 transform hover:scale-110"></i>
                        </button>
                        <!-- Shimmer Effect on Focus -->
                        <div class="absolute inset-0 shimmer-effect rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    </div>
                    @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-2 flex items-center error-message">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Register Button -->
                <button 
                    type="submit"
                    class="group relative w-full bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 text-white font-bold py-4 px-6 rounded-xl hover:from-indigo-600 hover:via-purple-700 hover:to-pink-600 focus:outline-none focus:ring-4 focus:ring-indigo-200 transform transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] shadow-xl hover:shadow-2xl overflow-hidden"
                    id="submit-btn"
                >
                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-all duration-700"></div>
                    <div class="relative flex items-center justify-center">
                        <i class="fas fa-user-plus mr-3 text-lg" id="submit-icon"></i>
                        <span class="text-lg" id="submit-text">{{ __('Create Account') }}</span>
                    </div>
                </button>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 font-semibold">{{ __('or sign up with') }}</span>
                    </div>
                </div>

                <!-- Social Register Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="group flex items-center justify-center px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-300 transform hover:scale-105">
                        <i class="fab fa-google text-red-500 mr-2 text-lg group-hover:scale-110 transition-transform duration-200"></i>
                        Google
                    </button>
                    <button type="button" class="group flex items-center justify-center px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105">
                        <i class="fab fa-facebook text-blue-600 mr-2 text-lg group-hover:scale-110 transition-transform duration-200"></i>
                        Facebook
                    </button>
                </div>

                <!-- Login Link -->
                @if (Route::has('login'))
                <div class="text-center pt-6 border-t border-gray-200">
                    <p class="text-gray-600 font-medium">
                        {{ __("Already have an account?") }} 
                        <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-all duration-200 hover:underline transform hover:scale-105 inline-block">
                            {{ __('Sign in here') }}
                        </a>
                    </p>
                </div>
                @endif
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-white text-opacity-90 text-sm font-medium">
                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. {{ __('All rights reserved.') }}
            </p>
        </div>
    </div>

    <!-- JavaScript for Interactivity -->
    <script>
        function togglePassword(fieldId, eyeId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(eyeId);
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Enhanced form validation with visual feedback
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[required]');
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');
            
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    const isValid = this.checkValidity();
                    
                    if (isValid && this.value.length > 0) {
                        this.classList.remove('border-red-300', 'focus:border-red-500');
                        this.classList.add('border-green-300', 'focus:border-green-500');
                    } else if (!isValid && this.value.length > 0) {
                        this.classList.remove('border-green-300', 'focus:border-green-500');
                        this.classList.add('border-red-300', 'focus:border-red-500');
                    } else {
                        this.classList.remove('border-red-300', 'border-green-300', 'focus:border-red-500', 'focus:border-green-500');
                    }
                });

                // Add floating label effect
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });

            // Password confirmation validation
            function validatePasswordMatch() {
                if (confirmPasswordField.value && passwordField.value) {
                    if (passwordField.value === confirmPasswordField.value) {
                        confirmPasswordField.classList.remove('border-red-300', 'focus:border-red-500');
                        confirmPasswordField.classList.add('border-green-300', 'focus:border-green-500');
                    } else {
                        confirmPasswordField.classList.remove('border-green-300', 'focus:border-green-500');
                        confirmPasswordField.classList.add('border-red-300', 'focus:border-red-500');
                    }
                }
            }

            passwordField.addEventListener('input', validatePasswordMatch);
            confirmPasswordField.addEventListener('input', validatePasswordMatch);

            // Add loading state to form submission
            const form = document.getElementById('register-form');
            const submitBtn = document.getElementById('submit-btn');
            const submitIcon = document.getElementById('submit-icon');
            const submitText = document.getElementById('submit-text');
            
            form.addEventListener('submit', function(e) {
                // Show loading state
                submitIcon.className = 'fas fa-spinner fa-spin mr-3 text-lg';
                submitText.textContent = '{{ __("Creating Account...") }}';
                submitBtn.disabled = true;
                
                // Add visual feedback
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.success-message, .error-message');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 300);
                }, 5000);
            });

            // Add particle effect on button hover
            submitBtn.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 20px 40px rgba(102, 126, 234, 0.4)';
            });

            submitBtn.addEventListener('mouseleave', function() {
                this.style.boxShadow = '0 25px 45px rgba(0, 0, 0, 0.1)';
            });

            // Keyboard navigation enhancement
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.tagName !== 'BUTTON') {
                    const form = document.getElementById('register-form');
                    const firstError = form.querySelector('.border-red-300');
                    
                    if (firstError) {
                        firstError.focus();
                    } else {
                        submitBtn.click();
                    }
                }
            });
        });

        // Add smooth scroll and focus effects
        window.addEventListener('load', function() {
            const card = document.querySelector('.glass-morphism');
            card.style.transform = 'translateY(20px)';
            card.style.opacity = '0';
            
            setTimeout(() => {
                card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.transform = 'translateY(0)';
                card.style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>