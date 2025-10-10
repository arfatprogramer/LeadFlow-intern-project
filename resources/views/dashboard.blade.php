<x-app-layout>

   <!-- Header -->
  {{-- <header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-blue-600">LeadFlow Dashboard</h1>
    <div class="flex items-center gap-4">
      <button class="relative">
        <span class="absolute top-0 right-0 block h-2 w-2 bg-red-500 rounded-full"></span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-5-5.917V4a1 1 0 00-2 0v1.083A6.002 6.002 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
      </button>
      <div class="flex items-center gap-2">
        <img src="https://i.pravatar.cc/40" alt="User" class="w-8 h-8 rounded-full">
        <span class="text-gray-700 font-medium">Arfat</span>
      </div>
    </div>
  </header> --}}

 

  {{-- <!-- 3 Column Grid -->
  <div class="py-6 px-4 lg:px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Pending -->
      <div class="bg-white shadow-md rounded-2xl p-5 flex flex-col h-full">
        <h2 class="text-xl font-semibold text-blue-600 mb-4 flex items-center gap-2">
          <span class="w-3 h-3 bg-blue-500 rounded-full"></span> Pending Leads
        </h2>
        <div class="flex-1 space-y-3 overflow-y-auto">
          <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl hover:bg-blue-100 transition">
            <p class="font-semibold">John Doe</p>
            <p class="text-sm text-gray-500">Follow up required</p>
          </div>
          <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl hover:bg-blue-100 transition">
            <p class="font-semibold">Jane Smith</p>
            <p class="text-sm text-gray-500">Requested callback</p>
          </div>
        </div>
      </div>

      <!-- Today -->
      <div class="bg-white shadow-md rounded-2xl p-5 flex flex-col h-full">
        <h2 class="text-xl font-semibold text-green-600 mb-4 flex items-center gap-2">
          <span class="w-3 h-3 bg-green-500 rounded-full"></span> Today’s Tasks
        </h2>
        <div class="flex-1 space-y-3 overflow-y-auto">
          <div class="p-4 bg-green-50 border border-green-100 rounded-xl hover:bg-green-100 transition">
            <p class="font-semibold">Call with Google Client</p>
            <p class="text-sm text-gray-500">10:00 AM - Meeting Room 1</p>
          </div>
          <div class="p-4 bg-green-50 border border-green-100 rounded-xl hover:bg-green-100 transition">
            <p class="font-semibold">Send Proposal to XYZ Ltd</p>
            <p class="text-sm text-gray-500">Due by 2:00 PM</p>
          </div>
          <div class="p-4 bg-green-50 border border-green-100 rounded-xl hover:bg-green-100 transition">
            <p class="font-semibold">Lead Review with Team</p>
            <p class="text-sm text-gray-500">4:00 PM</p>
          </div>
        </div>
      </div>

      <!-- Upcoming -->
      <div class="bg-white shadow-md rounded-2xl p-5 flex flex-col h-full">
        <h2 class="text-xl font-semibold text-purple-600 mb-4 flex items-center gap-2">
          <span class="w-3 h-3 bg-purple-500 rounded-full"></span> Upcoming
        </h2>
        <div class="flex-1 space-y-3 overflow-y-auto">
          <div class="p-4 bg-purple-50 border border-purple-100 rounded-xl hover:bg-purple-100 transition">
            <p class="font-semibold">Follow-up with ABC Corp</p>
            <p class="text-sm text-gray-500">Tomorrow, 11:00 AM</p>
          </div>
          <div class="p-4 bg-purple-50 border border-purple-100 rounded-xl hover:bg-purple-100 transition">
            <p class="font-semibold">Prepare Monthly Report</p>
            <p class="text-sm text-gray-500">Oct 12</p>
          </div>
        </div>
      </div>

    </div>
  </div>

   <!-- Chart Section -->
  <section class="max-w-7xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-2xl p-6">
      <h2 class="text-lg font-semibold text-gray-700 mb-4">Leads Overview</h2>
      <canvas id="leadsChart" height="120"></canvas>
    </div>
  </section>

  <!-- Chart.js Script -->
  <script>
    const ctx = document.getElementById('leadsChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [
          {
            label: 'New Leads',
            data: [12, 19, 8, 15, 10, 6, 9],
            backgroundColor: 'rgba(59, 130, 246, 0.6)', // blue
            borderRadius: 6,
          },
          {
            label: 'Converted',
            data: [5, 9, 6, 8, 5, 3, 4],
            type: 'line',
            borderColor: 'rgba(34,197,94,0.9)', // green
            borderWidth: 3,
            tension: 0.4,
            fill: false,
            pointBackgroundColor: 'white',
            pointBorderColor: 'rgba(34,197,94,0.9)'
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          },
          title: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 5 }
          }
        }
      }
    });
  </script> --}}

  <div class="p-6 max-w-7xl mx-auto">
  <!-- Page Title -->
  <h1 class="text-2xl font-bold text-[var(--leadflow-primary)] mb-6">LeadFlow Dashboard</h1>



  <!-- Cards Row -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="card">
      <h2 class="font-semibold text-[var(--leadflow-primary)] mb-3">Pending Leads</h2>
      <div class="space-y-2">
        <p>John Doe <span class="badge badge-new">New</span></p>
        <p>Jane Smith <span class="badge badge-contacted">Contacted</span></p>
      </div>
    </div>

    <div class="card">
      <h2 class="font-semibold text-[var(--leadflow-accent)] mb-3">Today’s Tasks</h2>
      <ul class="list-disc pl-5 text-gray-700">
        <li>Call with ABC Corp</li>
        <li>Send Proposal</li>
      </ul>
    </div>

    <div class="card">
      <h2 class="font-semibold text-purple-600 mb-3">Upcoming</h2>
      <p>Follow-up with XYZ Ltd — <span class="badge badge-warning">Tomorrow</span></p>
    </div>
  </div>
</div>


</x-app-layout>
