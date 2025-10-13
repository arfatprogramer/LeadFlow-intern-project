 @props(['data','href'])
 <div class="mb-8">
    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Follow-up Details</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-700">
        <div>
            <p class="font-medium">Follow-up Date</p>
            <p class="text-gray-600">
                {{ $data->follow_up_date ? \Carbon\Carbon::parse($data->follow_up_date)->format('d M Y') : '-' }}
            </p>
        </div>
        <div>
            <p class="font-medium">Reminder Time</p>
            <p class="text-gray-600">
                {{ $data->reminder_time ? \Carbon\Carbon::parse($data->reminder_time)->format('h:i A') : '-' }}
            </p>
        </div>
        <div>
            <p class="font-medium">Status</p>
            <p class="text-gray-600">{{ $data->status ?? '-' }}</p>
        </div>
    </div>
    <div class="flex justify-center sm:justify-end mt-6">
        <a href="{{ $href }}"
            title="Update follow-up date and status"
            aria-label="Edit follow-up and status for {{ $data->first_name }} {{ $data->last_name }}"
            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400">
            Update follow-up & status
        </a>
    </div>
</div>