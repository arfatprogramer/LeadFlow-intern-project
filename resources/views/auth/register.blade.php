<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-gray-100 p-6">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 space-y-6">
        
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Register New User</h1>
            <p class="text-gray-500 text-sm">Create a new team member and assign one or more roles</p>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Full Name')" class="font-semibold text-gray-700"/>
                <x-text-input id="name"
                              class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                              type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="phone" :value="__('Phone Number')" class="font-semibold text-gray-700"/>
                <x-text-input id="phone"
                              class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                              type="text" name="phone" :value="old('phone')" autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" class="font-semibold text-gray-700"/>
                <x-text-input id="email"
                              class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                              type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Role Selection -->
            <div>
                <x-input-label for="roles" :value="__('Assign Role(s)')" class="font-semibold text-gray-700"/>
                <select id="roles" name="roles[]" multiple
                        class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                    <option disabled>Select Role(s)</option>
                    @foreach(\App\Models\Role::where('role_name', '!=', 'Super_Admin')->get() as $role)
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or ⌘ (Mac) to select multiple roles</p>
                <x-input-error :messages="$errors->get('roles')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <x-primary-button class="w-full py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition duration-200">
                    {{ __('Register User') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
