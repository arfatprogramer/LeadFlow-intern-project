<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8 bg-white shadow rounded-xl p-6">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                    👤 User Profile
                </h1>
                <p class="text-sm text-gray-500"> profile & roles Details</p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('profile.edit') }}" 
                   class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow transition">
                    ✏️ Edit Profile
                </a>
            </div>
        </div>

        <div class="space-y-6 text-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label :value="'Full Name'" />
                    <p class="mt-1 text-gray-800 font-medium">{{ auth()->user()->name }}</p>
                </div>

                <div>
                    <x-input-label :value="'Email Address'" />
                    <p class="mt-1 text-indigo-600 font-medium">{{ auth()->user()->email }}</p>
                </div>

                <div>
                    <x-input-label :value="'Phone Number'" />
                    <p class="mt-1 text-gray-800 font-medium">{{ auth()->user()->phone ?? 'Not added yet' }}</p>
                </div>

                <div>
                    <x-input-label :value="'Roles'" />
                    <div class="mt-1 flex flex-wrap gap-2">
                        @forelse(auth()->user()->roles as $role)
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-medium rounded-full">
                                {{ $role->role_name }}
                            </span>
                        @empty
                            <span class="text-gray-400 italic">No roles assigned</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
