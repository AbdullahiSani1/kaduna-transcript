<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - KadPoly Transcript System</title>
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
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-10 px-3">

    <div class="w-full max-w-5xl mx-4 bg-white rounded-2xl shadow-lg overflow-hidden flex">

        {{-- LEFT PANEL --}}
        <div class="hidden md:flex flex-col justify-between bg-primary-700 text-white w-1/2 p-8 lg:p-10">
            <div>
                <a href="/" class="flex items-center gap-3 mb-10">
                    <img src="/images/KADPOLY_LOGO.jpg" alt="KadPoly Logo" class="w-14 h-14 object-contain rounded-full bg-white p-1">
                    <span class="font-bold text-xl">KadPoly Transcript</span>
                </a>
                <h2 class="text-3xl font-bold leading-snug mb-4">
                    Create Your Account
                </h2>
                <p class="text-primary-200 text-base">
                    Register to apply for your official academic transcript from Kaduna Polytechnic.
                </p>
            </div>

            <div class="space-y-4 mt-10">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-primary-100 text-sm">Free to register</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-primary-100 text-sm">Secure and paperless process</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-primary-100 text-sm">QR-verified official transcript</span>
                </div>
            </div>

            <p class="text-primary-400 text-xs mt-10">© {{ date('Y') }} Kaduna Polytechnic</p>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="w-full md:w-1/2 p-6 sm:p-10 flex flex-col justify-center">

            <div class="mb-8 text-center md:text-left">
                <h1 class="text-2xl font-bold text-gray-800">Create an account</h1>
                <p class="text-gray-500 text-sm mt-1">Fill in your details to get started</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
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

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <button type="submit" style="background-color: #16a34a;" class="w-full text-white font-semibold py-2.5 rounded-lg hover:opacity-90 transition text-sm">
                    Create Account
                </button>

                <p class="text-center text-sm text-gray-500">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary-600 font-medium hover:underline">Log in here</a>
                </p>
            </form>
        </div>
    </div>
    @include('layouts.loading')

</body>
</html>