<x-app-layout>
    <div class="p-6 space-y-6">
        <h1 class="text-2xl font-bold text-gray-700">Dashboard</h1>

        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-4 bg-white rounded-xl shadow-md">
                <h2 class="text-gray-500">Total Leads</h2>
                <p class="text-2xl font-semibold">{{ $totalLeads }}</p>
            </div>
            @foreach($leadsByStatus as $status => $count)
            <div class="p-4 bg-white rounded-xl shadow-md">
                <h2 class="text-gray-500">{{ ucfirst($status) }} Leads</h2>
                <p class="text-2xl font-semibold">{{ $count }}</p>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
    <div class="p-4 bg-white rounded-xl shadow-md">
        <h2 class="text-gray-500">Total Leads</h2>
        <p class="text-2xl font-semibold">{{ $totalLeads }}</p>
    </div>

    @foreach($leadsByStatus as $status => $count)
    <div class="p-4 bg-white rounded-xl shadow-md">
        <h2 class="text-gray-500">{{ ucfirst($status) }} Leads</h2>
        <p class="text-2xl font-semibold">{{ $count }}</p>
    </div>
    @endforeach

    <div class="p-4 bg-white rounded-xl shadow-md">
        <h2 class="text-gray-500">Upcoming Follow-ups</h2>
        <p class="text-2xl font-semibold">{{ $upcomingFollowUps }}</p>
    </div>

    <div class="p-4 bg-white rounded-xl shadow-md">
        <h2 class="text-gray-500">Pending Follow-ups</h2>
        <p class="text-2xl font-semibold">{{ $pendingFollowUps }}</p>
    </div>
</div>


        <!-- Recent Leads -->
        <div class="mt-6 bg-white p-4 rounded-xl shadow-md">
            <h2 class="text-gray-700 font-semibold mb-4">Recent Leads</h2>
            <table class="w-full table-auto text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border-b px-4 py-2">Name</th>
                        <th class="border-b px-4 py-2">Email</th>
                        <th class="border-b px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentLeads as $lead)
                    <tr>
                        <td class="border-b px-4 py-2">{{ $lead->name }}</td>
                        <td class="border-b px-4 py-2">{{ $lead->email }}</td>
                        <td class="border-b px-4 py-2">{{ ucfirst($lead->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      
    </div>
</x-app-layout>
