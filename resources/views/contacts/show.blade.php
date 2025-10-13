<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md mt-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-indigo-600">Contact Details</h1>
                <p class="text-sm text-gray-500">View and manage contact information</p>
            </div>
            <div class="space-x-2">
                <a href="{{ route('contacts.edit', $contact->id) }}" 
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow text-sm font-medium transition">
                    Edit
                </a>
                <a href="{{ route('contacts.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md shadow text-sm font-medium transition">
                    Back
                </a>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 mb-8">
            <div>
                <x-input-label :value="'First Name'" />
                <p class="text-gray-600">{{ $contact->first_name ?? '-' }}</p>
            </div>

            <div>
                <x-input-label :value="'Last Name'" />
                <p class="text-gray-600">{{ $contact->last_name ?? '-' }}</p>
            </div>

            <div>
                <x-input-label :value="'Email Address'" />
                <p class="text-gray-600">
                    <a href="mailto:{{ $contact->email }}" class="hover:underline text-indigo-600">
                        {{ $contact->email ?? '-' }}
                    </a>
                </p>
            </div>

            <div>
                <x-input-label :value="'Phone Number'" />
                <p class="text-gray-600">
                    <a href="tel:{{ $contact->phone }}" class="hover:underline text-indigo-600">
                        {{ $contact->phone ?? '-' }}
                    </a>
                </p>
            </div>

            <div>
                <x-input-label :value="'Company'" />
                <p class="text-gray-600">{{ $contact->company ?? '-' }}</p>
            </div>

            <div>
                <x-input-label :value="'Job Title'" />
                <p class="text-gray-600">{{ $contact->job_title ?? '-' }}</p>
            </div>

            <div>
                <x-input-label :value="'Assigned To'" />
                <p class="text-gray-600">{{ $contact->user?->name ?? 'Unassigned' }}</p>
            </div>

            <div>
                <x-input-label :value="'Source'" />
                <p class="text-gray-600">{{ $contact->source ?? '-' }}</p>
            </div>
        </div>

        <!-- Linked Lead -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-3">Linked Lead</h2>
            @if($contact->lead)
                <a href="{{ route('leads.show', $contact->lead->id) }}" 
                   class="block bg-gray-50 hover:bg-gray-100 border rounded-md p-4 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">{{ $contact->lead->first_name }} {{ $contact->lead->last_name }}</p>
                            <p class="text-sm text-gray-500">{{ $contact->lead->status ?? 'N/A' }}</p>
                        </div>
                        {{-- <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5 text-indigo-500" /> --}}
                    </div>
                </a>
            @else
                <p class="text-gray-500 italic">No linked lead found.</p>
            @endif
        </div>


        <!-- Notes -->
        <div>
            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-3">Notes</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $contact->notes ?: 'No notes added yet.' }}
            </p>
        </div>
    </div>
</x-app-layout>
