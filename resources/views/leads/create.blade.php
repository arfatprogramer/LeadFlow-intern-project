<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
        <h1 class="text-2xl font-bold text-blue-600 mb-6">Create New Lead</h1>

        <form action="{{ route('leads.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- First Name -->
                <div>
                    <x-input-label for="first_name">First Name </x-input-label>
                    <x-text-input 
                        id="first_name" 
                        name="first_name" 
                        type="text"
                        value="{{ old('first_name') }}" 
                        class="mt-1 block w-full"
                    />
                    <x-errors :name="'first_name'"/>
                </div>

                <!-- Last Name -->
                <div>
                    <x-input-label for="last_name">Last Name <span class="text-red-500">*</span></x-input-label>
                    <x-text-input 
                        id="last_name" 
                        name="last_name" 
                        type="text"
                        value="{{ old('last_name') }}" 
                        class="mt-1 block w-full"
                    />
                    <x-errors :name="'last_name'"/>
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email">Email <span class="text-red-500">*</span></x-input-label>
                    <x-text-input 
                        id="email" 
                        name="email" 
                        type="text"
                        value="{{ old('email') }}" 
                        class="mt-1 block w-full"
                    />
                    <x-errors :name="'email'"/>
                </div>

                <!-- Phone -->
                <div>
                    <x-input-label for="phone">Phone</x-input-label>
                    <x-text-input 
                        id="phone" 
                        name="phone" 
                        type="text"
                        value="{{ old('phone') }}" 
                        class="mt-1 block w-full"
                    />
                    <x-errors :name="'phone'"/>
                </div>

                <!-- Company -->
                <div>
                    <x-input-label for="company">Company</x-input-label>
                    <x-text-input 
                        id="company" 
                        name="company" 
                        type="text"
                        value="{{ old('company') }}" 
                        class="mt-1 block w-full"
                    />
                    <x-errors :name="'company'"/>
                </div>

                <!-- Designation -->
                <div>
                    <x-input-label for="designation">Designation</x-input-label>
                    <x-text-input 
                        id="designation" 
                        name="designation" 
                        type="text"
                        value="{{ old('designation') }}" 
                        class="mt-1 block w-full"
                    />
                    <x-errors :name="'designation'"/>
                </div>

                <!-- Lead Source -->
                <div>
                    <x-input-label for="source">Lead Source <span class="text-red-500">*</span></x-input-label>
                    <select 
                        name="source" 
                        id="source" 
                        class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    >
                        
                        @foreach (['ByUser','Website', 'LinkedIn', 'Referral', 'Email Campaign'] as $source)
                            <option value="{{ $source }}" {{ old('source') == $source ? 'selected' : '' }}>
                                {{ $source }}
                            </option>
                        @endforeach
                    </select>
                    <x-errors :name="'source'"/>
                </div>

                <!-- Assigned To -->
                <div>
                    <x-input-label for="assigned_to">Assigned To <span class="text-red-500">*</span></x-input-label>
                    <select 
                        name="assigned_to" 
                        id="assigned_to"
                        class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    >
                        @can('is-manager')
                            <option value="">Select User</option>
                            @foreach (App\Models\User::all() as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>    
                        @endcan
                    </select>
                    <x-errors :name="'assigned_to'"/>
                </div>
            </div>

            <!-- Follow-up -->
            @php
                $today = date('Y-m-d');
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Follow-up Date -->
                <div>
                    <x-input-label for="follow_up_date">Follow-up Date-Time</x-input-label>
                    <input 
                        class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        type="datetime-local" 
                        id="follow_up_date" 
                        name="follow_up_date" 
                        value="{{ old('follow_up_date',$today)}}"
                    >
                </div>
            </div>

            <!-- Notes -->
            <div>
                <x-input-label for="notes">Notes</x-input-label>
                <textarea 
                    id="notes" 
                    name="notes" 
                    rows="4" 
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Enter any additional notes..."
                >{{ old('notes') }}</textarea>
                <x-errors :name="'notes'"/>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition-colors"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
