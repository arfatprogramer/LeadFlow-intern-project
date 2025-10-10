@props(['action' => '#'])

<form method="POST" action="{{ $action }}" class="inline">
    @csrf
    @method('DELETE')

    <button type="submit" 
        class="soft-delete-btn text-gray-500 hover:text-red-500 transition-colors rounded p-1" 
        title="Soft delete"
        onclick="return confirm('Are you sure you want to delete this record?')">
        
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-5 h-5" 
             viewBox="0 0 24 24" 
             fill="none" 
             stroke="currentColor" 
             stroke-width="1.5" 
             stroke-linecap="round" 
             stroke-linejoin="round">
            <path d="M3 6h18"></path>
            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
            <path d="M10 11v6M14 11v6"></path>
        </svg>

        <span class="sr-only">{{ $slot }}</span>
    </button>
</form>
