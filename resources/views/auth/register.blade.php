<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6">
            
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800">Create an Account</h1>
                <p class="text-gray-500 mt-2 text-sm">Join us and manage your leads efficiently</p>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="font-medium text-gray-700"/>
                    <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Phone -->
                <div>
                    <x-input-label for="phone" :value="__('Phone')" class="font-medium text-gray-700"/>
                    <x-text-input id="phone" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  type="text" name="phone" :value="old('phone')" autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-700"/>
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="font-medium text-gray-700"/>
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-medium text-gray-700"/>
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Submit / Already Registered -->
                <div class="flex items-center justify-between mt-4">
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 underline" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4  py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white transition">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Optional Footer -->
            <div class="text-center mt-4 text-sm text-gray-500">
                By registering, you agree to our 
                <a href="#" class="text-indigo-600 hover:text-indigo-800 underline">Terms & Conditions</a>.
            </div>
        </div>
    </div>
</x-guest-layout>
