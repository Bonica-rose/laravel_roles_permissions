<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Unauthorized Action') }}
        </h2>
    </x-slot>

    <x-forbidden-card />
</x-app-layout>