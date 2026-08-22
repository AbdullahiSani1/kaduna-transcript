<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KadPoly Transcript System</title>
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
<body class="bg-white text-gray-800">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center gap-2 min-w-0">
                <img src="/images/KADPOLY_LOGO.jpg" alt="Kaduna Polytechnic Logo" class="w-10 h-10 object-contain shrink-0">
                <span class="font-bold text-lg sm:text-xl text-primary-700 whitespace-nowrap">KadPoly Transcript</span>
            </div>

            {{-- Desktop links --}}
            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-600 font-medium transition">Login</a>
                <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition">Register</a>
            </div>

            {{-- Mobile hamburger button --}}
            <button onclick="document.getElementById('mobile-nav-menu').classList.toggle('hidden')" class="md:hidden p-2 text-gray-600 hover:text-primary-600" aria-label="Toggle menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile dropdown menu --}}
        <div id="mobile-nav-menu" class="hidden md:hidden border-t border-gray-100 px-4 py-3 space-y-2">
            <a href="{{ route('login') }}" class="block text-gray-600 hover:text-primary-600 font-medium py-2">Login</a>
            <a href="{{ route('register') }}" class="block bg-primary-600 hover:bg-primary-700 text-white px-4 py-2.5 rounded-lg font-medium text-center transition">Register</a>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="bg-gradient-to-br from-primary-700 to-primary-900 text-white py-24 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl sm:text-5xl font-bold leading-tight mb-6">
                Official Transcript Application System
            </h1>
            <p class="text-primary-100 text-lg sm:text-xl mb-10 max-w-2xl mx-auto">
                Apply for your academic transcript online - faster, paperless, and verifiable.
                No more queues. No more delays.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-primary-700 hover:bg-primary-50 font-semibold px-8 py-3 rounded-lg text-lg transition">
                    Apply Now
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-primary-600 font-semibold px-8 py-3 rounded-lg text-lg transition">
                    Login to Dashboard
                </a>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="py-20 px-4 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-gray-800">Why Use This System?</h2>
                <p class="text-gray-500 mt-3 text-lg">Everything you need to request and receive your official transcript</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Online Application</h3>
                    <p class="text-gray-500 text-sm">Apply for your transcript from anywhere at any time without visiting the school.</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">REMITA Payment</h3>
                    <p class="text-gray-500 text-sm">Pay your transcript fee securely using your REMITA Retrieval Reference (RRR).</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Auto CGPA Calculation</h3>
                    <p class="text-gray-500 text-sm">Your CGPA is automatically computed from uploaded results following NBTE guidelines.</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">PDF Download</h3>
                    <p class="text-gray-500 text-sm">Download your official transcript as a professionally formatted PDF document.</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 000-2H5a1 1 0 000 2zm0 0v.01"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">QR Code Verification</h3>
                    <p class="text-gray-500 text-sm">Every transcript includes a QR code that employers and institutions can scan to verify authenticity.</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Real-time Status Updates</h3>
                    <p class="text-gray-500 text-sm">Track your request from submission to completion and get notified at every stage.</p>
                </div>

            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section class="py-20 px-4 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-gray-800">How It Works</h2>
                <p class="text-gray-500 mt-3 text-lg">Get your transcript in four simple steps</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                    <h3 class="font-semibold text-lg mb-2">Create Account</h3>
                    <p class="text-gray-500 text-sm">Register with your student details and complete your profile with your matric number and program.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                    <h3 class="font-semibold text-lg mb-2">Submit Request</h3>
                    <p class="text-gray-500 text-sm">Fill the transcript application form, state your purpose, and submit your request online.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                    <h3 class="font-semibold text-lg mb-2">Make Payment</h3>
                    <p class="text-gray-500 text-sm">Pay the ₦5,000 processing fee via REMITA using the generated Retrieval Reference Number.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">4</div>
                    <h3 class="font-semibold text-lg mb-2">Download Transcript</h3>
                    <p class="text-gray-500 text-sm">Once processed, download your official PDF transcript with a QR code for verification.</p>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-10 py-3 rounded-lg text-lg transition inline-block">
                    Get Started Now
                </a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-primary-900 text-primary-100 py-10 px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold text-white text-lg mb-3">KadPoly Transcript</h4>
                <p class="text-sm text-primary-300">An enhanced transcript application system for Kaduna Polytechnic - College of Science and Technology.</p>
            </div>
            <div>
                <h4 class="font-bold text-white text-lg mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Student Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Register</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white text-lg mb-3">Contact</h4>
                <p class="text-sm text-primary-300">Kaduna Polytechnic<br>Kaduna, Nigeria</p>
            </div>
        </div>
        <div class="text-center text-primary-400 text-sm mt-8 border-t border-primary-700 pt-6">
            © {{ date('Y') }} Kaduna Polytechnic Transcript System. All rights reserved.
            <p class="mt-2 text-primary-500">Designed by <span class="text-white font-small">Abdullahi Sani - 09169244485</span></p>
        </div>
    </footer>

</body>
</html>