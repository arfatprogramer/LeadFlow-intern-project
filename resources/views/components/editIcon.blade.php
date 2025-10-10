@props(['href' => '#'])
<a href="{{ $href }}" class="text-gray-500 hover:text-blue-500 transition-colors rounded p-1" title="Edit">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M3 21v-3.75L14.06 6.19a2 2 0 0 1 2.83 0l1.92 1.92a2 2 0 0 1 0 2.83L7.75 21H3z"></path>
        <path d="M18.37 6.63l-1.5-1.5"></path>
    </svg>
    <span class="sr-only">{{$slot}}</span>
</a>