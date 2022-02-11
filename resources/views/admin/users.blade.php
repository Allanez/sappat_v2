<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Users and Organizations') }}
        </h2>
    </x-slot>
    
    <livewire:admin.manage-users />
    <livewire:admin.manage-organizations />
</x-app-layout>