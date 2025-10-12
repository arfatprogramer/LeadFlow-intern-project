<x-app-layout>
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h1 class="text-2xl font-bold text-indigo-600 mb-6">Create Opportunity</h1>

    <form action="{{ route('opportunities.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Opportunity Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div>
                <x-input-label for="title">Title <span class="text-red-500">*</span></x-input-label>
                <x-text-input name="title" id="title" value="{{ old('title') }}" type="text" class="mt-1 block w-full"/>
                <x-errors :name="'title'"/>
            </div>

            <div>
                <x-input-label for="lead_id">Lead</x-input-label>
                <select name="lead_id" id="lead_id" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Lead</option>
                    @foreach($leads as $lead)
                        <option value="{{ $lead->id }}" {{ old('lead_id') == $lead->id ? 'selected' : '' }}>
                            {{ $lead->first_name }} {{ $lead->last_name }}
                        </option>
                    @endforeach
                </select>
                <x-errors :name="'lead_id'"/>
            </div>

            <div>
                <x-input-label for="user_id">Assigned To</x-input-label>
                <select name="user_id" id="user_id" class="w-full border-gray-300 rounded-md shadow-sm">
                   
                    @if (in_array('admin', Auth::user()->role_names))
                        <option value="">Select User</option>
                        @php
                        $users = \App\Models\User::all();
                        @endphp
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    @else
                        <option value="{{ Auth::id() }}" selected>{{ Auth::user()->name }}</option>
                    @endif
                </select>
            </div>

            <div>
                <x-input-label for="stage">Stage</x-input-label>
                <select name="stage" id="stage" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="Interested" {{ old('stage') == 'Interested' ? 'selected' : '' }}>Interested</option>
                    <option value="Qualified" {{ old('stage') == 'Qualified' ? 'selected' : '' }}>Qualified</option>
                    <option value="Won" {{ old('stage') == 'Won' ? 'selected' : '' }}>Won</option>
                    <option value="Lost" {{ old('stage') == 'Lost' ? 'selected' : '' }}>Lost</option>
                </select>
            </div>

            <div>
                <x-input-label for="value">Value</x-input-label>
                <x-text-input name="value" id="value" value="{{ old('value') }}" type="number" class="mt-1 block w-full"/>
            </div>

            <div>
                <x-input-label for="expected_close_date">Expected Close Date</x-input-label>
                <x-text-input name="expected_close_date" id="expected_close_date" value="{{ old('expected_close_date') }}" type="date" class="mt-1 block w-full"/>
            </div>

        </div>

        <div>
            <x-input-label for="details">details</x-input-label>
            <textarea name="details" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter details...">{{ old('details') }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                Save Opportunity
            </button>
        </div>
    </form>
</div>
</x-app-layout>
