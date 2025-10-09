@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    {{-- Stats Row --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <x-stat-card title="Total Leads" :value="$data['totalLeads']" icon="users"/>
        <x-stat-card title="Converted" :value="$data['convertedLeads']" icon="check-circle"/>
        <x-stat-card title="Opportunities" :value="$data['totalOpportunities']" icon="briefcase"/>
        <x-stat-card title="Conversion Rate" :value="$data['conversionRate'].'%'" icon="trending-up"/>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-chart-card title="Leads by Status" chart-id="leadsByStatusChart"/>
        <x-chart-card title="Opportunities by Stage" chart-id="oppStageChart"/>
    </div>

    {{-- Reminders & Activities --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-table-card title="Upcoming Reminders">
            @foreach($data['reminders'] as $reminder)
                <tr>
                    <td>{{ $reminder->lead->title }}</td>
                    <td>{{ $reminder->remind_at->format('d M, H:i') }}</td>
                    <td>{{ $reminder->message }}</td>
                </tr>
            @endforeach
        </x-table-card>

        <x-table-card title="Recent Lead Activities">
            <tr><td>John Doe converted “Acme Ltd.”</td><td>2 hrs ago</td></tr>
            <tr><td>Agent Sara followed up “XYZ Pvt.”</td><td>5 hrs ago</td></tr>
        </x-table-card>
    </div>

</div>
@endsection
