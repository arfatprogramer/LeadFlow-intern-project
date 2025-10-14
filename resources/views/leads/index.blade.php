<x-app-layout>
    <div class="">
        <div class="p-4 bg-white rounded-xl shadow-md">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Leads List</h2>
                <a href="{{ route('leads.create') }}">
                    <button class="btn-primary mb-4">+ Add New Lead</button>
                </a>
            </div>

            <div class="overflow-x-auto relative">
                <!-- Bulk Action Buttons -->
                <div class=" absolute top-6 left-52 hidden gap-3 mb-4 mx-5 " id="bulkButtons">
                    <button id="bulkDeleteBtn" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-md text-sm">
                        Delete
                    </button>
                    <button id="bulkUpdateBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded-md text-sm">
                        Update
                    </button>
                </div>

                <table id="leadsTable" class="min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="p-3 text-left">
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
                            <tr class="border-b hover:bg-blue-100 group transition">
                                <td class="p-3 flex items-center gap-2">
                                    <input type="checkbox" name="lead_id[]" value="{{ $lead->id }}" class="lead-checkbox w-4 h-4">
                                    <div class="flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <x-log-icon :href="route('leads.log', $lead->id)" />
                                        <x-editIcon :href="route('leads.edit', $lead->id)" />
                                        <x-softDeleteIcon :action="route('leads.destroy', $lead->id)" />
                                    </div>
                                </td>
                                <td class="p-3">
                                    <a href="{{ route('leads.show', $lead->id) }}" class="text-blue-700 hover:underline">
                                        {{ ucwords($lead->first_name) }} {{ ucwords($lead->last_name) }}
                                    </a>
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

    <!-- ✅ Simple JS for show/hide bulk buttons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.lead-checkbox');
            const bulkButtons = document.getElementById('bulkButtons');

            // Show/Hide Bulk Buttons
            function toggleBulkButtons() {
                const anyChecked = document.querySelectorAll('.lead-checkbox:checked').length > 0;
                bulkButtons.classList.toggle('hidden', !anyChecked);
                bulkButtons.classList.toggle('flex', !anyChecked);
            }

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                toggleBulkButtons();
            });

            checkboxes.forEach(cb => cb.addEventListener('change', toggleBulkButtons));
        });
    </script>
</x-app-layout>
