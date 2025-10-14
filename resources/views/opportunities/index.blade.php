<x-app-layout>
    <div class="py-6">
        <div class="p-6 bg-white rounded-xl shadow-md">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Opportunities</h2>
                    <p class="text-sm text-gray-500">Track and manage your sales opportunities efficiently.</p>
                </div>

                <a href="{{ route('opportunities.create') }}">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg shadow-md transition">
                        + Create Opportunity
                    </button>
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table id="opportunitiesTable" class="min-w-full border border-gray-200 rounded-lg text-sm">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="p-3 pr-10 text-left w-12">
                                <input type="checkbox" id="selectAllOpportunities" class="w-4 h-4 text-indigo-600">
                            </th>
                            <th class="p-3 text-left">Title</th>
                            <th class="p-3 text-left">Lead</th>
                            <th class="p-3 text-left">Assigned To</th>
                            <th class="p-3 text-left">Amount</th>
                            <th class="p-3 text-left">Stage</th>
                            <th class="p-3 text-left">Expected Close</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y">
                        @foreach($opportunities as $opportunity)
                            <tr class="hover:bg-gray-50 group transition">
                                <td class="p-3 gap-2 flex items-center justify-start">
                                    <input type="checkbox" name="opportunity_id[]" value="{{ $opportunity->id }}" class=" opportunity-checkbox w-4 h-4 text-indigo-600">
                                    <!-- Actions (log/edit/delete) -->
                                    <div class="flex gap-1 items-center  opacity-0 group-hover:opacity-100 transition-opacity">
                                        <x-log-icon :href="route('opportunities.log', $opportunity->id)" />
                                        <x-editIcon :href="route('opportunities.edit', $opportunity->id)" />
                                        <x-softDeleteIcon :action="route('opportunities.destroy', $opportunity->id)" />
                                    </div>
                                </td>

                                <!-- Title -->
                                <td class="p-3">
                                    <a href="{{ route('opportunities.show', $opportunity->id) }}" 
                                       class="text-indigo-600 font-medium hover:underline">
                                        {{ ucwords($opportunity->title) }}
                                    </a>
                                </td>

                                <!-- Linked Lead -->
                                <td class="p-3">
                                    @if($opportunity->lead)
                                        <a href="{{ route('leads.show', $opportunity->lead->id) }}" 
                                           class="text-gray-700 hover:text-indigo-600">
                                            {{ ucwords($opportunity->lead->first_name) }} {{ ucwords($opportunity->lead->last_name) }}
                                        </a>
                                    @else
                                        <span class="text-gray-400 italic">N/A</span>
                                    @endif
                                </td>

                                <!-- Assigned User -->
                                <td class="p-3">
                                    {{ $opportunity->user?->name ?? 'Unassigned' }}
                                </td>

                                <!-- Amount -->
                                <td class="p-3 font-medium text-gray-800">
                                    ₹{{ number_format($opportunity->value, 2) }}
                                </td>

                                <!-- Stage -->
                                <td class="p-3">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $opportunity->stage == 'Interested' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $opportunity->stage == 'Qualified' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $opportunity->stage == 'Won' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $opportunity->stage == 'Lost' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($opportunity->stage) }}
                                    </span>
                                </td>

                                <!-- Expected Close -->
                                <td class="p-3 text-gray-500">
                                    {{ \Carbon\Carbon::parse($opportunity->expected_close_date)->format('d M, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($opportunities->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        No opportunities found. 
                        <a href="{{ route('opportunities.create') }}" class="text-indigo-600 hover:underline">Create one now</a>.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
