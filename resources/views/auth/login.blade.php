<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KadPoly Transcript System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl mx-4 bg-white rounded-2xl shadow-lg overflow-hidden flex">

        {{-- LEFT PANEL --}}
        <div class="hidden md:flex flex-col justify-between bg-primary-700 text-white w-1/2 p-10">
            <div>
                <a href="/" class="flex items-center gap-3 mb-10">
                    <img src="/images/KADPOLY_LOGO.jpg" alt="KadPoly Logo" class="w-14 h-14 object-contain rounded-full bg-white p-1">
                    <span class="font-bold text-xl">KadPoly Transcript</span>
                </a>
                <h2 class="text-3xl font-bold leading-snug mb-4">
                    Welcome Back!
                </h2>
                <p class="text-primary-200 text-base">
                    Log in to access your transcript application dashboard and track your requests.
                </p>
            </div>

            <div class="space-y-4 mt-10">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-primary-100 text-sm">Apply for transcripts online</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-primary-100 text-sm">Track your request in real-time</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-primary-100 text-sm">Download verified PDF transcript</span>
                </div>
            </div>

            <p class="text-primary-400 text-xs mt-10">© {{ date('Y') }} Kaduna Polytechnic</p>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">

            <div class="mb-8 text-center md:text-left">
                <h1 class="text-2xl font-bold text-gray-800">Sign in to your account</h1>
                <p class="text-gray-500 text-sm mt-1">Enter your credentials to continue</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary-600">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:underline">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" style="background-color: #16a34a;" class="w-full text-white font-semibold py-2.5 rounded-lg hover:opacity-90 transition text-sm">
                    Log In
                </button>

                <p class="text-center text-sm text-gray-500">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-primary-600 font-medium hover:underline">Register here</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>