<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="base-url" content="{{ url('/') }}">

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
                        <x-nav-link :href="route('opportunities.index')" :active="request()->routeIs('opportunities.index')">🎯 Opportunities</x-nav-link>
                        <x-nav-link :href="route('profile.show',auth()->id())" :active="request()->routeIs('profile.show')">🧑‍🤝‍🧑 Profile</x-nav-link>
                    @if (in_array('admin', Auth::user()->role_names)) 
                            <x-nav-link class="whitespace-nowrap" :href="route('employes.index')" :active="request()->routeIs('employes.index')"> ⚙️ Uers Permissin</x-nav-link>
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

      <!-- Bulk Update Modal -->
        <div id="bulkUpdateModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h3 class="text-lg font-semibold mb-4">Bulk Update Leads</h3>

                <div class="mb-4">
                    <label for="bulkStatus" class="block text-sm font-medium mb-1">Status</label>
                    <select id="bulkStatus" class="w-full border border-gray-300 rounded px-2 py-1">
                        <option value="">Select Status</option>
                        <option value="New">New</option>
                        <option value="Contacted">Contacted</option>
                        <option value="Qualified">Qualified</option>
                        <option value="Converted">Converted</option>
                        <option value="Lost">Lost</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2">
                    <button id="cancelBulkUpdate" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                    <button id="confirmBulkUpdate" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Update</button>
                </div>
            </div>
        </div>

        {{-- show Notification form Session --}}
      @if(session('success'))
            <div class="absolute bottom-3 right-10 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="absolute bottom-3 right-10 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

    </body>

</html>
