<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded-xl shadow">

        <!-- Header -->
        <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center gap-2">
            🛡️ Manage Roles for {{ $user->name }}
        </h2>

        <!-- Role Management Form -->
        <form method="POST" action="{{ route('employes.updateRoles', $user->id) }}">
            @csrf
        
            <div class="space-y-4">
                @foreach($roles as $role)
                    <label class="flex items-center space-x-3">
                        <input 
                            type="checkbox" 
                            name="roles[]" 
                            value="{{ $role->role_name }}"
                            {{ in_array($role->role_name, $user->role_names) ? 'checked' : '' }}
                            class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="text-gray-800 font-medium">{{ ucfirst($role->role_name) }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('employes.show', $user->id) }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md shadow">
                    ⬅️ Back
                </a>

                <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow">
                    💾 Update Roles
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
