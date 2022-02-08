<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Users') }}
        </h2>
    </x-slot>
    
    <livewire:admin.manage-users />
</x-app-layout>