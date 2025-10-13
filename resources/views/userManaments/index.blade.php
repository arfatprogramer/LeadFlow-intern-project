<x-app-layout>
    <div class="py-6">
        <div class="p-6 bg-white rounded-xl shadow-md">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Employes</h2>
                    <p class="text-sm text-gray-500">Track and manage your Employes efficiently.</p>
                </div>

                <a href="{{ route('register') }}">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg shadow-md transition">
                        + Create Employes
                    </button>
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table id="usersTable" class="min-w-full border border-gray-200 rounded-lg text-sm">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="p-3 pr-10 text-left w-12">
                                <input type="checkbox" id="selectAllUsers" class="w-4 h-4 text-indigo-600">
                            </th>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Number</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Roles</th>
                            <th class="p-3 text-left">Last Updated</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 group transition">
                                <td class="p-3 relative">
                                    <input type="checkbox" name="users_id[]" value="{{ $user->id }}" class=" user-checkbox w-4 h-4 text-indigo-600">
                                    
                                    <!-- Actions (edit/delete) -->
                                    <div class="flex gap-1 items-center absolute top-2 left-8 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <x-editIcon :href="route('profile.edit', $user->id)" />
                                        <x-softDeleteIcon :action="route('profile.destroy', $user->id)" />
                                    </div>
                                </td>

                                <!-- name -->
                                <td class="p-3">
                                    <a href="{{ route('employes.show', $user->id) }}" 
                                       class="text-indigo-600 font-medium hover:underline">
                                        {{ ucwords($user->name) }} 
                                    </a>
                                </td>

                            

                                <!-- Amount -->
                                <td class="p-3 font-medium text-gray-800">
                                    {{($user->phone) }}
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>


                                 <!-- Assigned User -->
                                <td class="p-3">
                                    @php
                                        $roles=$user->role_names;
                                    @endphp
                                    @if (!empty($roles))
                                        @foreach ($roles as $role)
                                            <span> {{ $role }}</span>
                                         @endforeach
                                    @else
                                        <span>-</span>
                                    @endif
                                    
                                </td>

                                <!-- Expected Close -->
                                <td class="p-3 text-gray-500">
                                    {{ \Carbon\Carbon::parse($user->updated_at)->format('d M, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($users->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        No opportunities found. 
                        {{-- <a href="{{ route('contact.create') }}" class="text-indigo-600 hover:underline">Create one now</a>. --}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
