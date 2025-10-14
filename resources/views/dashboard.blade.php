<x-app-layout>

  
  <!-- 3 Column Grid -->
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

</x-app-layout>
