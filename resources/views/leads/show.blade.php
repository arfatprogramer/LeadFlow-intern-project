<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-blue-600">Lead Details</h1>
            <div class="space-x-2">
                <a href="{{ route('leads.edit', $lead->id) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow text-sm font-medium transition-colors">
                    Edit
                </a>
                <a href="{{ route('leads.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md shadow text-sm font-medium transition-colors">
                    Back
                </a>
            </div>
        </div>

        <!-- Basic Info -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Basic Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                <div>
                    <p class="font-medium">First Name</p>
                    <p class="text-gray-600">{{ $lead->first_name ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-medium">Last Name</p>
                    <p class="text-gray-600">{{ $lead->last_name ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-medium">Email</p>
                    <p class="text-gray-600">{{ $lead->email ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-medium">Phone</p>
                    <p class="text-gray-600">{{ $lead->phone ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-medium">Company</p>
                    <p class="text-gray-600">{{ $lead->company ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-medium">Designation</p>
                    <p class="text-gray-600">{{ $lead->designation ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-medium">Lead Source</p>
                    <p class="text-gray-600">{{ $lead->source ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-medium">Assigned To</p>
                    <p class="text-gray-600">
                        {{ $lead->users->name ?? 'Unassigned' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Follow-up Details -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Follow-up Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                <div>
                    <p class="font-medium">Follow-up Date</p>
                    <p class="text-gray-600">
                        {{ $lead->follow_up_date ? \Carbon\Carbon::parse($lead->follow_up_date)->format('d M Y') : '-' }}
                    </p>
                </div>
                <div>
                    <p class="font-medium">Reminder Time</p>
                    <p class="text-gray-600">
                        {{ $lead->reminder_time ? \Carbon\Carbon::parse($lead->reminder_time)->format('h:i A') : '-' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Notes</h2>
            <div class="text-gray-700 bg-gray-50 p-4 rounded-md border">
                @if ($lead->notes)
                    <p class="whitespace-pre-line">{{ $lead->notes }}</p>
                @else
                    <p class="text-gray-500 italic">No notes available.</p>
                @endif
            </div>
            <div class="flex justify-end mt-4">
                <button 
                    onclick="addNote($lead->id)"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow text-sm font-medium transition-colors">
                    Add
             </button>
            </div>
             
        </div>

        <!-- Footer -->
        <div class="text-sm text-gray-500 mt-8 border-t pt-4 text-center">
            LeadFlow CRM — Lead record last updated on 
            <span class="font-medium text-gray-600">{{ $lead->updated_at->format('d M Y, h:i A') }}</span>
        </div>
    </div>
</x-app-layout>
