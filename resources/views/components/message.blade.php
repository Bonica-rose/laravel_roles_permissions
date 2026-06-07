@if (session('success'))
    <div class="mb-3 p-3 font-medium text-md text-green-700 rounded-md shadow-sm bg-green-100 border border-green-100">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-3 p-3 font-medium text-md text-red-700 rounded-md shadow-sm bg-red-100 border border-red-100">
        {{ session('error') }}
    </div>
@endif