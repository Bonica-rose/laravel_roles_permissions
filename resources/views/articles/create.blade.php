<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Articles / Create') }}
            </h2>
            <a href="{{ route('articles.index') }}" class="inline-flex items-center px-3 py-2 bg-slate-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-700 focus:outline-none focus:border-slate-800 focus:ring focus:ring-slate-200 disabled:opacity-25 transition">Back to Articles</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('articles.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title Field -->
                            <div>
                                
                                <label for="title" class="block font-medium text-md text-gray-700">Title</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    placeholder="Enter article title"
                                    value="{{ old('title') }}" 
                                    @class([
                                        'mt-1 block rounded-md shadow-sm w-full focus:ring', 
                                        'border-red-500 focus:border-red-500 focus:ring-red-200' => $errors->has('title'),
                                        'border-gray-300 focus:border-blue-300 focus:ring-blue-200' => !$errors->has('title'),
                                    ])
                                    required 
                                    autofocus 
                                />
                                
                                <!-- Inline Error Message -->
                                @error('title')
                                    <span class="text-red-600 text-sm block mt-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>                            

                            <!-- Author Field -->
                            <div>
                                <label for="author" class="block font-medium text-md text-gray-700">Author</label>
                                <input 
                                    type="text" 
                                    name="author" 
                                    id="author" 
                                    placeholder="Enter article author"
                                    value="{{ old('author') }}" 
                                    @class([
                                        'mt-1 block rounded-md shadow-sm w-full focus:ring', 
                                        'border-red-500 focus:border-red-500 focus:ring-red-200' => $errors->has('author'),
                                        'border-gray-300 focus:border-blue-300 focus:ring-blue-200' => !$errors->has('author'),
                                    ])
                                    required 
                                    autofocus 
                                />
                                
                                <!-- Inline Error Message -->
                                @error('author')
                                    <span class="text-red-600 text-sm block mt-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Content Field -->
                            <div>
                                <label for="content" class="block font-medium text-md text-gray-700">Content</label>
                                <textarea
                                    name="content"
                                    id="content"
                                    placeholder="Enter article content"
                                    @class([
                                        'mt-1 block rounded-md shadow-sm w-full focus:ring', 
                                        'border-red-500 focus:border-red-500 focus:ring-red-200' => $errors->has('content'),
                                        'border-gray-300 focus:border-blue-300 focus:ring-blue-200' => !$errors->has('content'),
                                    ])
                                    required
                                >{{ old('content') }}</textarea>

                                <!-- Inline Error Message -->
                                @error('content')
                                    <span class="text-red-600 text-sm block mt-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                Create Article
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
