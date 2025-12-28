<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inventory Master | SCD Project</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row shadow-xl rounded-lg overflow-hidden">
                <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] border border-gray-100 dark:border-[#3E3E3A]">
                    <h1 class="mb-2 text-2xl font-bold text-blue-600">Inventory Management</h1>
                    <p class="mb-6 text-[#706f6c] dark:text-[#A1A09A]">A modern solution to track your stock, manage product categories, and monitor health levels in real-time.</p>
                    
                    <ul class="flex flex-col mb-8">
                        <li class="flex items-center gap-4 py-3 relative">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">1</span>
                            <div>
                                <h3 class="font-semibold text-sm">Product Tracking</h3>
                                <p class="text-xs text-gray-500">Manage SKUs, pricing, and stock levels effortlessly.</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 py-3">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-green-100 text-green-600 font-bold">2</span>
                            <div>
                                <h3 class="font-semibold text-sm">Category Organization</h3>
                                <p class="text-xs text-gray-500">Group your products into logical categories for better reporting.</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 py-3">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-red-100 text-red-600 font-bold">3</span>
                            <div>
                                <h3 class="font-semibold text-sm">Low Stock Alerts</h3>
                                <p class="text-xs text-gray-500">Automated visual indicators when stock falls below safety levels.</p>
                            </div>
                        </li>
                    </ul>

                    <div class="flex gap-3">
                        @auth
                            <a href="{{ route('products.index') }}" class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition shadow-lg text-center font-medium">Manage Stock Now</a>
                        @else
                            <a href="{{ route('register') }}" class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition shadow-lg text-center font-medium">Get Started</a>
                        @endauth
                    </div>
                </div>

                <div class="relative flex-1 bg-[#f9f9fb] dark:bg-[#0a0a0a] flex items-center justify-center p-8 border-t lg:border-t-0 lg:border-l border-gray-100 dark:border-[#3E3E3A]">
                    <svg class="w-32 h-32 text-blue-500 opacity-20 absolute" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                    </svg>
                    <div class="z-10 text-center">
                        <div class="text-4xl font-black text-gray-200 dark:text-gray-800 uppercase tracking-widest">Dashboard</div>
                        <div class="mt-2 text-gray-400 text-xs">SCD PROJECT v1.0</div>
                    </div>
                </div>
            </main>
        </div>

        <footer class="mt-12 text-center text-[11px] text-[#706f6c] dark:text-[#A1A09A]">
            Built with Laravel {{ app()->version() }} &bull; PHP {{ phpversion() }}
        </footer>
    </body>
</html>