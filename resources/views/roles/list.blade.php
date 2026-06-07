<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}" class="inline-flex items-center px-3 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">Create Role</a>
        </div> 
    </x-slot>

    <div class="py-9">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">            
            <x-message />
            <div class="w-full bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 table-auto">
                    <thead class="text-white bg-slate-900 text-sm uppercase">
                        <tr>
                            <th class="px-6 py-3 text-center tracking-wider">#</th>
                            <th class="px-6 py-3 text-left tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left tracking-wider">Permission/s</th>
                            <th class="px-6 py-3 text-left tracking-wider">Created On</th>
                            <th class="px-6 py-3 text-center tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->isEmpty())
                            <tr>
                                <td colspan="3" class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">No roles found.</td>
                            </tr>
                        @else
                            @foreach ($roles as $role)
                                <tr class="bg-white hover:bg-gray-50 border-b text-md text-gray-900">
                                    <!-- Math formula to calculate sequential rows across pagination pages -->
                                    <td class="px-6 py-2 whitespace-nowrap text-center" width="50">
                                        {{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-2 whitespace-nowrap">{{ $role->name }}</td>
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        {{ $role->permissions->pluck('name')->join(', ') }}
                                    </td>

                                    <td class="px-6 py-2 whitespace-nowrap" width="400">
                                        {{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-center" width="100">

                                        <a href="{{ route('roles.edit', $role->id) }}" class="bg-amber-500 rounded-md text-sm font-semibold text-white p-2 hover:bg-amber-400">Edit</a>

                                        <form 
                                            action="{{ route('roles.destroy', $role) }}" 
                                            method="POST" class="inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete the role &quot;{{ $role->name }}&quot;? This action cannot be undone.');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 font-semibold text-white text-sm rounded-md px-3 py-1.5 hover:bg-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach 
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links Wrapper -->
            <div class="mt-4">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
