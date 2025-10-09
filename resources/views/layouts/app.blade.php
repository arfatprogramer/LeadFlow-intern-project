<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen flex  font-sans antialiased h-screen">
        <div class="grid w-full grid-rows-10 h-screen">

            @include('layouts.navigation')
            <div class="row-span-11 flex flex-1 bg-gray-200">
                <aside  :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full' "
                  class=" w-48  border-r bg-slate-100 border-white transform  md:translate-x-0 transition-transform duration-200 ease-in-out">
                    <nav class="p-4 space-y-2 border-t border-white">
                        <x-nav-link :href="route('dashboard')"  :active="request()->routeIs('dashboard')">  🏠 Dashboard</x-nav-link>
                        <x-nav-link :href="route('leads.index')" :active="request()->routeIs('leads.index')">🧾 Leads</x-nav-link>
                        <x-nav-link :href="route('contacts.index')" :active="request()->routeIs('contacts.index')">👥 Clients</x-nav-link>
                        <x-nav-link :href="url('reminder.index')" :active="request()->routeIs('reminders.index')">⏰ Reminders</x-nav-link>
                    </nav>
                </aside>
                <!-- Page Content -->
                 <main class="flex-1 p-6 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
            <!-- Footer (sticky at bottom) -->
            <footer class="bg-white border-t  text-center text-gray-600 text-sm ">
                © {{ date('Y') }} LeadFlow — Built with ❤️ using Laravel & TailwindCSS
            </footer>

      </div>
    </body>
</html>
