<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables CSS -->
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> --}}

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f9fafb; /* Light background */
                color: #111827; /* Neutral dark text */
            }

            /* --- Theme Colors --- */
            :root {
                --leadflow-primary: #2563eb; /* Blue */
                --leadflow-accent: #22c55e;  /* Green */
                --leadflow-warning: #facc15; /* Yellow */
                --leadflow-danger: #ef4444;  /* Red */
                --leadflow-bg: #f9fafb;
                --leadflow-card: #ffffff;
            }

            /* --- Common UI Elements --- */
            .btn-primary {
                background-color: var(--leadflow-primary);
                color: white;
                font-weight: 600;
                border-radius: 8px;
                padding: 0.5rem 1rem;
                transition: background 0.3s;
            }
            .btn-primary:hover {
                background-color: #1d4ed8; /* darker blue */
            }

            .card {
                background: var(--leadflow-card);
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                padding: 1.25rem;
            }

            .badge {
                font-size: 0.75rem;
                font-weight: 600;
                border-radius: 9999px;
                padding: 0.25rem 0.75rem;
            }
            .badge-new { background: var(--leadflow-warning); color: #111827; }
            .badge-contacted { background: var(--leadflow-primary); color: white; }
            .badge-converted { background: var(--leadflow-accent); color: white; }
            .badge-lost { background: var(--leadflow-danger); color: white; }
        </style>

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
                        <x-nav-link :href="route('contacts.index')" :active="request()->routeIs('contacts.index')">👥 contacts</x-nav-link>
                        <x-nav-link :href="route('opportunities.index')" :active="request()->routeIs('opportunities.index')">👥 opportunities</x-nav-link>
                        <x-nav-link :href="url('reminder.index')" :active="request()->routeIs('reminders.index')">⏰ Reminders</x-nav-link>
                        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"> Profile</x-nav-link>
                    @if (in_array('admin', Auth::user()->role_names)) 
                            <x-nav-link :href="url('profile.edit')" :active="request()->routeIs('profile.edit')">Uers Permissin</x-nav-link>
                    @endif
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
