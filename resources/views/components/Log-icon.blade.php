@props(['href' => '#'])
<a href="{{ $href }}" 
   class="text-blue-500 hover:text-blue-700 transition-colors rounded p-1"
   title="View Logs">
   <!-- Clipboard list / activity icon -->
   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75h6m-6 3H15m-9-9h9.75M9 3.75h6a2.25 2.25 0 012.25 2.25v13.5A2.25 2.25 0 0115 21.75H9A2.25 2.25 0 016.75 19.5V6A2.25 2.25 0 019 3.75z" />
   </svg>
</a>
