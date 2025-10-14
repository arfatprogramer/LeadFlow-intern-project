<x-app-layout>
    <div class="py-6 px-4 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <a href="{{ route('leads.index') }}">
                    <div class="bg-white text-blue-600 rounded-2xl shadow-lg p-5 flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold">{{ $leadsCount ?? 0 }}</p>
                            <p class="text-sm">Leads</p>
                        </div>
                        <div class="bg-blue-600 bg-opacity-20 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0H5" />
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="{{ route('contacts.index') }}">
                    <div class="bg-white text-green-500 rounded-2xl shadow-lg p-5 flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold">{{ $contactsCount ?? 0 }}</p>
                            <p class="text-sm">Contacts</p>
                        </div>
                        <div class="bg-green-500 bg-opacity-20 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.878 6.197M12 12v.01" />
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="{{ route('opportunities.index') }}">
                    <div class="bg-white text-purple-400 rounded-2xl shadow-lg p-5 flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold">{{ $opportunitiesCount ?? 0 }}</p>
                            <p class="text-sm">Opportunities</p>
                        </div>
                        <div class="bg-purple-400 bg-opacity-20 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h2a2 2 0 012 2v6a2 2 0 01-2 2H3v-8zm16-2v8a2 2 0 01-2 2h-2V10h4zM7 7V5a2 2 0 012-2h6a2 2 0 012 2v2H7z" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recent Items Sections -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Recent Leads -->
                <div class="bg-white shadow-md rounded-2xl p-5">
                    <h2 class="text-xl font-semibold text-blue-600 mb-4">Recent Leads</h2>
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($recentLeads as $lead)
                        <a href="{{ route('leads.show',$lead->id) }}">
                            <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl hover:bg-blue-100 transition">
                            <p class="font-semibold">{{ $lead->first_name }} {{ $lead->last_name }}</p>
                            <p class="text-sm text-gray-500">Assigned to: {{ $lead->assignedUser->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">Next Follow-up: {{ $lead->next_followup ?? 'N/A' }}</p>
                        </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Contacts -->
                <div class="bg-white shadow-md rounded-2xl p-5">
                    <h2 class="text-xl font-semibold text-green-600 mb-4">Recent Contacts</h2>
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($recentContacts as $contact)
                       <a href="{{ route('contacts.show',$contact->id) }}">
                            <div class="p-4 bg-green-50 border border-green-100 rounded-xl hover:bg-green-100 transition">
                            <p class="font-semibold">{{ $contact->first_name }} {{ $contact->last_name }}</p>
                            <p class="text-sm text-gray-500">{{ $contact->email ?? $contact->phone ?? 'N/A' }}</p>
                        </div>
                       </a>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Opportunities -->
                <div class="bg-white shadow-md rounded-2xl p-5">
                    <h2 class="text-xl font-semibold text-purple-600 mb-4">Recent Opportunities</h2>
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($recentOpportunities as $opportunity)
                        <a href="{{ route('opportunities.show',$opportunity->id) }}">
                            <div class="p-4 bg-purple-50 border border-purple-100 rounded-xl hover:bg-purple-100 transition">
                            <p class="font-semibold">{{ $opportunity->title }}</p>
                            <p class="text-sm text-gray-500">Status: {{ $opportunity->stage ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">Value: {{ $opportunity->value ?? 'N/A' }}</p>
                        </div>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
