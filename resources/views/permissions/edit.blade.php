<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Permissions / Edit') }}
            </h2>
            <a href="{{ route('permissions.index') }}" class="inline-flex items-center px-3 py-2 bg-slate-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-700 focus:outline-none focus:border-slate-800 focus:ring focus:ring-slate-200 disabled:opacity-25 transition">Back to Permissions</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('permissions.update', $permission) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                placeholder="Enter permission name"
                                value="{{ old('name', $permission->name) }}" 
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
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">Update Permission</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
