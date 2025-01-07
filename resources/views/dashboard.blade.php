<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if (auth()->user()->role === 'admin')
                {{ __('Project Lists') }}
            @else
                {{ __('Tasks Lists') }}
            @endif
        </h2>
    </x-slot>

    @if (auth()->user()->role === 'admin')
        <livewire:project-crud>
        @else
            <livewire:task-crud>
    @endif

</x-app-layout>
