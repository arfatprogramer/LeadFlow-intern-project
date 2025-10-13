<x-app-layout>
    <div class="py-6">
        <div class="p-6 bg-white rounded-xl shadow-md">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Opportunities</h2>
                    <p class="text-sm text-gray-500">Track and manage your sales opportunities efficiently.</p>
                </div>

                <a href="{{ route('contacts.create') }}">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg shadow-md transition">
                        + Create Contact
                    </button>
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table id="contactsTable" class="min-w-full border border-gray-200 rounded-lg text-sm">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="p-3 pr-10 text-left w-12">
                                <input type="checkbox" id="selectAllContacts" class="w-4 h-4 text-indigo-600">
                            </th>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Number</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Stage</th>
                            <th class="p-3 text-left">Source</th>
                            <th class="p-3 text-left">Assigned To</th>
                            <th class="p-3 text-left">Last Updated</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y">
                        @foreach($contacts as $contact)
                            <tr class="hover:bg-gray-50 group transition">
                                <td class="p-3 relative">
                                    <input type="checkbox" name="contact_id[]" value="{{ $contact->id }}" class=" contact-checkbox w-4 h-4 text-indigo-600">
                                    
                                    <!-- Actions (edit/delete) -->
                                    <div class="flex gap-1 items-center absolute top-2 left-8 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <x-editIcon :href="route('contacts.edit', $contact->id)" />
                                        <x-softDeleteIcon :action="route('contacts.destroy', $contact->id)" />
                                    </div>
                                </td>

                                <!-- Title -->
                                <td class="p-3">
                                    <a href="{{ route('contacts.show', $contact->id) }}" 
                                       class="text-indigo-600 font-medium hover:underline">
                                        {{ ucwords($contact->first_name) }} {{ ucwords($contact->last_name) }}
                                    </a>
                                </td>

                            

                                <!-- Amount -->
                                <td class="p-3 font-medium text-gray-800">
                                    {{($contact->phone) }}
                                </td>

                                <td>
                                    {{ $contact->email }}
                                </td>

                                <!-- Stage -->
                                <td class="p-3">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $contact->status == 'Interested' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $contact->status == 'Qualified' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $contact->status == 'Won' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $contact->status == 'Lost' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($contact->status) }}
                                    </span>
                                </td>

                                 <!-- Linked Lead -->
                                <td class="p-3">
                                    @if($contact->lead)
                                        <a href="{{ route('leads.show', $contact->lead->id) }}" 
                                           class="text-gray-700 hover:text-indigo-600">
                                            {{ ucwords($contact->source) }}
                                        </a>
                                    @else
                                        <span class="text-gray-400 italic">N/A</span>
                                    @endif
                                </td>

                                 <!-- Assigned User -->
                                <td class="p-3">
                                    @php
                                        
                                    @endphp
                                    {{ $contact->user?->name ?? 'Unassigned' }}
                                </td>


                                <!-- Expected Close -->
                                <td class="p-3 text-gray-500">
                                    {{ \Carbon\Carbon::parse($contact->updated_at)->format('d M, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($contacts->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        No opportunities found. 
                        {{-- <a href="{{ route('contact.create') }}" class="text-indigo-600 hover:underline">Create one now</a>. --}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
