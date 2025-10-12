<x-app-layout>
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h1 class="text-2xl font-bold text-blue-600 mb-6">Update Lead</h1>

    <form action="{{ route('leads.update', $lead->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <input type="hidden" name="status" value="{{ $lead->status }}">

        <!-- Basic Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="first_name">First Name<span class="text-red-500">*</span></x-input-label>
                <x-text-input 
                    name="first_name"  
                    id="first_name"
                    value="{{ old('first_name', $lead->first_name) }}"    
                    type="text" 
                    class="mt-1 block w-full" 
                />
                <x-errors :name="'first_name'"/>
            </div>

            <div>
                <x-input-label for="last_name">Last Name</x-input-label>
                <x-text-input 
                    name="last_name"  
                    id="last_name" 
                    value="{{ old('last_name', $lead->last_name) }}"  
                    type="text" 
                    class="mt-1 block w-full" 
                />
                <x-errors :name="'last_name'"/>
            </div>

            <div>
                <x-input-label for="email" :value="'Email'" />
                <x-text-input 
                    name="email" 
                    id="email"  
                    value="{{ old('email', $lead->email) }}" 
                    type="email" 
                    class="mt-1 block w-full" 
                />
                <x-errors :name="'email'"/>
            </div>

            <div>
                <x-input-label for="phone" :value="'Phone'" />
                <x-text-input 
                    name="phone"  
                    id="phone" 
                    value="{{ old('phone', $lead->phone) }}" 
                    type="text" 
                    class="mt-1 block w-full" 
                />
                <x-errors :name="'phone'"/>
            </div>
    
            <div>
                <x-input-label for="company" :value="'Company'" />
                <x-text-input 
                    name="company"  
                    id="company" 
                    value="{{ old('company', $lead->company) }}" 
                    type="text" 
                    class="mt-1 block w-full" 
                />
                <x-errors :name="'company'"/>
            </div>

            <div>
                <x-input-label for="designation" :value="'Designation'" />
                <x-text-input 
                    name="designation"  
                    id="designation" 
                    value="{{ old('designation', $lead->designation) }}" 
                    type="text" 
                    class="mt-1 block w-full" 
                />
                <x-errors :name="'designation'"/>
            </div>
            
            <div>
                <x-input-label :value="'Lead Source'" />
                <select 
                    name="source" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">Select Source</option>
                    @foreach (['Website', 'LinkedIn', 'Referral', 'Email Campaign'] as $source)
                        <option value="{{ $source }}" {{ old('source', $lead->source) == $source ? 'selected' : '' }}>
                            {{ $source }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-input-label :value="'Assigned To'" />
                <select 
                    name="assigned_to" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
                   @if (in_array('admin', Auth::user()->role_names) || in_array('manager', Auth::user()->role_names)))
                        <option value="">Select User</option>
                        @foreach (App\Models\User::all() as $user)
                            <option value="{{ $user->id }}" {{ old('assigned_to', $lead->assigned_to) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    @else
                        <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>    
                    @endif
                </select>
            </div>
        </div>

        <!-- Follow-up -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label>Follow-up Date</x-input-label>
                <input 
                    type="date" 
                    name="follow_up_date" 
                    value="{{ old('follow_up_date', $lead->follow_up_date ?? date('Y-m-d')) }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <div>
                <x-input-label>Reminder Time</x-input-label>
                <input 
                    type="time" 
                    name="reminder_time" 
                    value="{{ old('reminder_time', $lead->reminder_time ?? date('H:i')) }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
        </div>

        <!-- Notes -->
        <div>
            <x-input-label>Notes</x-input-label>
            <textarea 
                name="notes" 
                rows="4" 
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                placeholder="Enter any additional notes..."
            >{{ old('notes', $lead->notes) }}</textarea>
        </div>

        <!-- Submit -->
        <div class="text-right">
            <button 
                type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow"
            >
                Update Lead
            </button>
        </div>
    </form>
</div>
</x-app-layout>
