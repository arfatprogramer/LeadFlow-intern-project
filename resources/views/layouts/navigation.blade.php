<nav x-data="{ open: false }" class="bg-blue-700 text-gray-900 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
            </div>

             <div class="hidden sm:flex sm:items-center sm:ms-6 ">
                <!-- Notifications -->
                <a href="{{ url('notifications.index') }}" class="relative hover:text-gray-200 mx-4 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                            class="h-7 w-7" fill="none" viewBox="0 0 24 24" 
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M15 17h5l-1.405-1.405M19 13V8a7 7 0 10-14 0v5l-1.405 1.595A1 1 0 005 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold px-1.5 py-0.5 rounded-full">
                        {{-- {{ auth()->user()->unreadNotifications->count() ?? 0 }} --}}
                        4
                    </span>
                </a>

                <!-- Settings Dropdown -->
           
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <div class="flex items-center gap-4">
                           
                            <div class="flex items-center gap-2">
                                <img src="https://i.pravatar.cc/40" alt="User" class="w-8 h-8 rounded-full">
                               <button class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                            </div>
                        </div>
                        
                        {{-- <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button> --}}
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>


{{-- @php
    $notifications = auth()->user()->unreadNotifications;
@endphp

<div class="relative">
    <x-icon name="bell" class="w-6 h-6 text-gray-600" />
    @if($notifications->count())
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">
            {{ $notifications->count() }}
        </span>
    @endif
</div>

<!-- Dropdown -->
<div class="absolute bg-white shadow rounded w-64">
    @forelse($notifications as $note)
        <a href="{{ route('leads.show', $note->data['lead_id']) }}" class="block px-4 py-2 hover:bg-gray-100">
            {{ $note->data['message'] }}
        </a>
    @empty
        <p class="px-4 py-2 text-gray-500">No notifications</p>
    @endforelse
</div> --}}

