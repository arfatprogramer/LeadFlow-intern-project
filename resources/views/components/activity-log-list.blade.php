@props(['logs','logName'])

<div class="bg-white shadow rounded-lg p-4 mt-4">
    <h3 class="text-lg font-semibold text-gray-700 mb-3">Activity Logs - {{ $logName }} </h3>

    @forelse ($logs as $log)
        <div class="border-l-4 border-blue-500 pl-3 mb-2">
            <div class="flex justify-between text-sm text-gray-500">
                <span>{{ $log->created_at->format('d M Y h:i A') }}</span>
                <span>{{ ucfirst(class_basename($log->loggable_type)) }}</span>
            </div>
            <div>
                <strong>{{ $log->user?->name ?? 'System' }}</strong> 
                <span class="text-gray-700">{{ $log->message }}</span>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No logs yet.</p>
    @endforelse
</div>