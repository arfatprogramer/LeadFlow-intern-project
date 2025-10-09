<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeadFlow | @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Left side -->
                <div class="flex items-center space-x-4">
                    <a href="{{ url('dashboard') }}" class="text-xl font-bold tracking-wide hover:text-gray-200">
                        LeadFlow
                    </a>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <a href="{{ url('notifications.index') }}" class="relative hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="h-6 w-6" fill="none" viewBox="0 0 24 24" 
                             stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round" 
                                   d="M15 17h5l-1.405-1.405M19 13V8a7 7 0 10-14 0v5l-1.405 1.595A1 1 0 005 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold px-1.5 py-0.5 rounded-full">
                            {{-- {{ auth()->user()->unreadNotifications->count() ?? 0 }} --}}
                            4
                        </span>
                    </a>

                    <!-- User Menu -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                 class="w-8 h-8 rounded-full border-2 border-white" alt="Profile">
                            <span class="hidden sm:inline font-medium">{{ auth()->user()->name }}</span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white text-gray-700 rounded-lg shadow-lg hidden group-hover:block z-50">
                            <a href="{{ url('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ url('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area (flex grows to fill remaining height) -->
    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:flex flex-col">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold text-indigo-700">search</h2>
            </div>
            <nav class="mt-2 flex-1 overflow-y-auto space-y-1">
                <a href="{{ url('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 font-medium">🏠 Dashboard</a>
                <a href="{{ url('leads.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 font-medium">📋 Leads</a>
                <a href="{{ url('opportunities.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 font-medium">💼 Opportunities</a>
                <a href="{{ url('notifications.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 font-medium">🔔 Notifications</a>
                @can('manage-users')
                    <a href="{{ url('users.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 font-medium">👥 Users</a>
                @endcan
                <a href="{{ url('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 font-medium">⚙️ Profile</a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- Footer (sticky at bottom) -->
    <footer class="bg-white border-t  text-center text-gray-600 text-sm">
        © {{ date('Y') }} LeadFlow — Built with ❤️ using Laravel & TailwindCSS
    </footer>

</body>
</html>
