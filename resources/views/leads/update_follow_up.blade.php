@props(['data'])
<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-blue-600">Lead Details</h1>
            <div class="space-x-2">
                <a href="{{ route('leads.index') }}" 
                   class="bg-gray-200 max-sm:hidden hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md shadow text-sm font-medium transition-colors">
                    Back
                </a>
        </div>

        <!-- Lead Form -->
        <form action="{{ route('leads.updateFollowUp', $lead->id) }}" method="POST">
            @csrf
           
            <!-- Basic Info -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Basic Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                    <!-- Lead Name -->
                    <div>
                        <x-input-label :value="'Lead Name'" />
                        <p class="text-gray-600">{{ $lead->first_name ?? '-' }}</p>
                    </div>

                    <!-- Lead Status -->
                    <div>
                        <x-input-label :value="'Lead Status'" />
                        <select 
                            name="status" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            @php
                                $default = $lead->status ?? 'Select';
                            @endphp
                            <option value="">{{ $default }}</option>
                            @foreach (['New', 'Contacted', 'Qualified', 'Converted', 'Lost'] as $status)
                                <option value="{{ $status }}" {{ old('status', $lead->status) == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        <x-errors :name="'status'"/>
                    </div>

                    <!-- Follow-up Date -->
                    <div>
                        <x-input-label>Follow-up Date</x-input-label>
                        <input 
                            type="date" 
                            name="follow_up_date" 
                            value="{{ old('follow_up_date', $lead->follow_up_date ?? date('Y-m-d')) }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                        <x-errors :name="'follow_up_date'"/>
                    </div>

                    <!-- Reminder Time -->
                    <div>
                        <x-input-label>Reminder Time</x-input-label>
                        <input 
                            type="time" 
                            name="reminder_time" 
                            value="{{ old('reminder_time', $lead->reminder_time ?? date('H:i')) }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                        <x-errors :name="'reminder_time'"/>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-6">
                <x-input-label>Notes</x-input-label>
                <textarea 
                    name="notes" 
                    rows="4" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Enter any additional notes..."
                >{{ old('notes', $lead->notes) }}</textarea>
                <x-errors :name="'notes'"/>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow text-sm font-medium transition-colors"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
