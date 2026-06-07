<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Roles / Create') }}
            </h2>
            <a href="{{ route('roles.index') }}" class="inline-flex items-center px-3 py-2 bg-slate-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-700 focus:outline-none focus:border-slate-800 focus:ring focus:ring-slate-200 disabled:opacity-25 transition">Back to Roles</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                placeholder="Enter role name"
                                value="{{ old('name') }}" 
                                @class([
                                    'mt-1 block rounded-md shadow-sm w-1/2 focus:ring',
                                    'border-red-500 focus:border-red-500 focus:ring-red-200' => $errors->has('name'),
                                    'border-gray-300 focus:border-blue-300 focus:ring-blue-200' => !$errors->has('name'),
                                ])
                                required 
                                autofocus 
                            />
                            
                            <!-- Inline Error Message -->
                            @error('name')
                                <span class="text-red-600 text-sm block mt-1">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-4">
                            @if ($permissions->isEmpty())
                                <p class="text-gray-500 text-sm">No permissions available. Please create permissions first.</p>
                            @else
                                @foreach ($permissions as $permission)
                                    <div class="flex items-center">
                                        <input 
                                            type="checkbox" 
                                            name="permissions[]" 
                                            id="permission_{{ $permission->id }}" value="{{ $permission->id }}" class="mr-2 rounded-sm border-gray-300 focus:ring focus:border-blue-300 focus:ring-blue-200" 
                                        />
                                        <label 
                                            for="permission_{{ $permission->id }}" 
                                            class="text-sm text-gray-700"
                                        >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach

                                <!-- Inline Error Message -->
                                @error('permissions')
                                    <span class="text-red-600 text-sm block mt-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            @endif
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">Create Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
