<x-app-layout>
    <div class="py-4">
        <div class="p-6 bg-white rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Leads List</h2>
                <!-- Action Button -->
                <a href={{ route('leads.create') }}> 
                    <button class="btn-primary mb-4">+ Add New Lead</button>
                </a>
            </div>


            <div class="overflow-x-auto">
                <table id="leadsTable" class="dataTable min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="p-3  text-left">
                                <input type="checkbox" id="selectAll" class="w-4 h-4">
                            </th>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Phone</th>
                            <th class="p-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($leads as $lead)
                            <tr class="border-b hover:bg-gray-50 group transition">
                                <td class="p-3 pr-10 relative ">
                                    <input type="checkbox" name="lead_id[]" value="{{ $lead->id }}" class="lead-checkbox w-4 h-4">
                                    <div class="flex items-center justify-center absolute top-2 left-8 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <x-editIcon :href="route('leads.edit', $lead->id)">edit</x-editIcon>
                                        <x-softDeleteIcon :action="route('leads.destroy', $lead->id)">delete</x-softDeleteIcon>
                                    </div>
                                </td>
                                
                                <td class="p-3"> <a href="leads/{{ $lead->id }}" class="text-blue-700 hover:underline">{{ ucWords($lead->first_name )}} {{ucWords($lead->last_name)}}</a>
                                </td>
                                <td class="p-3">{{ $lead->email }}</td>
                                <td class="p-3">{{ $lead->phone }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $lead->status == 'New' ? 'bg-blue-100 text-blue-700' : 
                                           ($lead->status == 'Contacted' ? 'bg-yellow-100 text-yellow-700' : 
                                           'bg-green-100 text-green-700') }}">
                                        {{ $lead->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>            
</x-app-layout>
