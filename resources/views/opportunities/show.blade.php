<x-app-layout>
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md mt-8">
    <div class="sm:flex justify-between items-center mb-3">
        <h1 class="text-2xl font-bold text-indigo-600 mb-6">Opportunity Details</h1>
        <div class=" flex gap-2">
            <a href="{{ route('opportunities.log',$opportunity->id) }}" 
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md shadow text-sm font-medium transition">
                        Log
            </a>
            <a href="{{ route('opportunities.edit', $opportunity->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">Edit</a>
            <form action="{{ route('opportunities.destroy', $opportunity->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">Delete</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <div>
            <h3 class="font-semibold text-gray-700">Title</h3>
            <p class="text-gray-800">{{ $opportunity->title }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-700">Lead</h3>
            @if($opportunity->lead)
                <a href="{{ route('leads.show', $opportunity->lead->id) }}" class="text-indigo-600 hover:underline">
                    {{ $opportunity->lead->first_name }} {{ $opportunity->lead->last_name }}
                </a>
            @else
                <p class="text-gray-500 italic">N/A</p>
            @endif
        </div>

        <div>
           
            <h3 class="font-semibold text-gray-700">Assigned To</h3>
            <p>{{ $opportunity->user?->name ?? 'Unassigned' }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-700">Stage</h3>
            <span class="px-2 py-1 text-xs rounded-full
                {{ $opportunity->stage == 'Interested' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $opportunity->stage == 'Qualified' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $opportunity->stage == 'Won' ? 'bg-green-100 text-green-700' : '' }}
                {{ $opportunity->stage == 'Lost' ? 'bg-red-100 text-red-700' : '' }}">
                {{ $opportunity->stage }}
            </span>
        </div>

        <div>
            <h3 class="font-semibold text-gray-700">Value</h3>
            <p>₹{{ number_format($opportunity->value, 2) }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-700">Expected Close Date</h3>
            <p>{{ \Carbon\Carbon::parse($opportunity->expected_close_date)->format('d M, Y') }}</p>
        </div>

    </div>

    <div>
        <h3 class="font-semibold text-gray-700 mb-2">Description</h3>
        <p class="text-gray-800">{{ $opportunity->description ?? 'No description provided.' }}</p>
    </div>

    
</div>
</x-app-layout>
