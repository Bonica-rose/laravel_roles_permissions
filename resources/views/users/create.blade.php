<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('User / Create') }}
            </h2>
            @can('create users')
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-3 py-2 bg-slate-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-700 focus:outline-none focus:border-slate-800 focus:ring focus:ring-slate-200 disabled:opacity-25 transition">Back to Users</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block font-medium text-md text-gray-700">Name</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    placeholder="Enter user name"
                                    value="{{ old('name') }}" 
                                    @class([
                                        'mt-1 block rounded-md shadow-sm w-full focus:ring',
                                        'border-red-500 focus:border-red-500 focus:ring-red-200' => $errors->has('name'),
                                        'border-gray-300 focus:border-blue-300 focus:ring-blue-200' => !$errors->has('name'),
                                    ])
                                    {{-- required  --}}
                                    autofocus 
                                />
                                
                                @error('name')
                                    <span class="text-red-600 text-sm block mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block font-medium text-md text-gray-700">Email</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    placeholder="Enter user email"
                                    value="{{ old('email') }}" 
                                    @class([
                                        'mt-1 block rounded-md shadow-sm w-full focus:ring',
                                        'border-red-500 focus:border-red-500 focus:ring-red-200' => $errors->has('email'),
                                        'border-gray-300 focus:border-blue-300 focus:ring-blue-200' => !$errors->has('email'),
                                    ])
                                    {{-- required  --}}
                                />
                                
                                @error('email')
                                    <span class="text-red-600 text-sm block mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block font-medium text-md text-gray-700">Password</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    placeholder="Enter user password"
                                    @class([
                                        'mt-1 block rounded-md shadow-sm w-full focus:ring',
                                        'border-red-500 focus:border-red-500 focus:ring-red-200' => $errors->has('password'),
                                        'border-gray-300 focus:border-blue-300 focus:ring-blue-200' => !$errors->has('password'),
                                    ])
                                    {{-- required  --}}
                                />
                                
                                @error('password')
                                    <span class="text-red-600 text-sm block mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <div>
                                <label for="password_confirmation" class="block font-medium text-md text-gray-700">Confirm Password</label>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation" 
                                    placeholder="Confirm password"
                                    @class([
                                        'mt-1 block rounded-md shadow-sm w-full focus:ring',
                                        'border-red-500 focus:border-red-500 focus:ring-red-200' => $errors->has('password_confirmation'),
                                        'border-gray-300 focus:border-blue-300 focus:ring-blue-200' => !$errors->has('password_confirmation'),
                                    ])
                                    {{-- required  --}}
                                />
                                
                                @error('password_confirmation')
                                    <span class="text-red-600 text-sm block mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Roles Field Group Wrapper -->
                        <div class="mt-6">
                            <!-- Main Label pulled completely outside the grid layout wrapper -->
                            <label class="block font-medium text-md text-gray-700 mb-2">Assign Role/s</label>

                            @if ($roles->isEmpty())
                                <p class="text-gray-500 text-sm">No roles available. Please create roles first.</p>
                            @else
                                <!-- Responsive Grid exclusively houses the checkbox items -->
                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                                    @if($roles->isNotEmpty())
                                        @foreach ($roles as $role)
                                            <div class="flex items-center">
                                                <input 
                                                    type="checkbox" 
                                                    name="roles[]" 
                                                    id="role_{{ $role->id }}" 
                                                    value="{{ $role->id }}" 
                                                    class="mr-2 rounded-sm border-gray-300 text-blue-600 focus:ring focus:border-blue-300 focus:ring-blue-200"
                                                />
                                                <label for="role_{{ $role->id }}" class="text-md text-gray-700 select-none">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                
                                @error('roles')
                                    <span class="text-red-600 text-sm block mt-1">{{ $message }}</span>
                                @enderror
                            @endif
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                Create User
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
