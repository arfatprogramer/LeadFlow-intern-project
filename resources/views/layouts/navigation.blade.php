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

            

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Notifications -->
                @php
                    $notifications = auth()->user()->unreadNotifications;
                @endphp

                <div class="relative group">
                    <!-- Notification Icon with Badge -->
                    <button class="relative text-white hover:text-gray-200 focus:outline-none mx-4">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405M19 13V8a7 7 0 10-14 0v5l-1.405 1.595A1 1 0 005 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if($notifications->count() > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold px-1.5 py-0.5 rounded-full">
                                {{ $notifications->count() }}
                            </span>
                        @endif
                    </button>

                    <!-- Notification Dropdown -->
                    <div class="absolute right-0  w-72 bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100 hidden group-hover:block z-50">
                        <div class="p-3 border-b bg-gray-50 text-gray-700 font-semibold">
                            Notifications
                        </div>

                        <div class="max-h-64 overflow-y-auto">
                            @forelse($notifications as $note)
                                <a href="{{ route('markasread',  ['id' => $note->id, 'lead_id' => $note->data['lead_id']]) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-50">
                                     {{ $note->data['message'] ?? 'Notification' }}
                                     <span class="text-xs text-gray-400 block mt-0.5">
                                          {{ $note->created_at->diffForHumans() }}
                                     </span>
                                </a>
                            @empty
                                <p class="px-4 py-3 text-gray-500 text-sm text-center">No new notifications</p>
                            @endforelse
                        </div>

                        @if($notifications->count() > 0)
                            <div class="p-2 text-center bg-gray-50">
                                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-sm text-blue-600 hover:underline font-medium">
                                        Mark all as read
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 👤 User Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 focus:outline-none">
                            <img src="https://i.pravatar.cc/40" alt="User Avatar" class="w-8 h-8 rounded-full">
                            <span class="text-white text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="fill-current text-white h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
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

