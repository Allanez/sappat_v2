<div>
    <table class="table">
        <thead>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Agency
            </th>
            <th>
                Designation
            </th>
            <th>
                Status (Active?)
            </th>
            <th>
                Action
            </th>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    {{$user->agency}}
                </td>
                <td>
                    {{$user->designation}}
                </td>
                <td>
                    <livewire:components.toggle-button :model="$user" field="active" :wire:key="$user->id" />
                </td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#UserRoleModal" class="btn btn-primary btn-sm">Permissions</button>
                    <button wire:click="showDeleteUserModal({{$user->id}})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <x-jet-confirmation-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            Delete Account
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this account? Once this account is deleted, all of its resources and data will be permanently deleted.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete()" wire:loading.attr="disabled">
                Delete Account
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>