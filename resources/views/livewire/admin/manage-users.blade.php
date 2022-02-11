<div>
    <h1>Users</h1>
    
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
                Super Admin?
            </th>
            <th>
                Permission
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
                    <livewire:components.toggle-button :model="$user" field="active" :wire:key="'active'.$user->id" />
                </td>
                <td>
                    <livewire:components.toggle-button :model="$user" field="super_admin" :wire:key="'super_admin'.$user->id" />
                </td>
                <td>
                    @if($user->organization)
                        {{ucfirst($user->role)}} of {{$user->organization->name}}
                    @else
                        None!
                    @endif
                </td>
                <td>
                    <button wire:click="showAssignPermissionModal({{$user->id}})" class="btn btn-primary btn-sm">Permissions</button>
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

    <x-jet-dialog-modal wire:model="assigningUserPermission">
        <x-slot name="title">
            Assign Organization and Role to User
        </x-slot>

        <x-slot name="content">
            <div class="row mb-3">
                <label for="organization" class="col-md-4 col-form-label text-md-end">{{ __('Organization') }}</label>

                <div class="col-md-6">
                    <select id="organization" wire:model="organization" type="text" class="form-control @error('organization') is-invalid @enderror" name="organization" value="{{ old('organization') }}" required autocomplete="organization">
                        @foreach($organizations as $org)
                            <option value="{{$org->id}}">{{$org->name}}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-text offset-md-4">
                    Select the organization this user belongs to. 
                </div>
            </div>
            <div class="row mb-3">
                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                <div class="col-md-6">
                    <select id="role" wire:model="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role">
                        <option value="administrator">Administrator</option>
                        <option value="manager">Manager</option>
                        <option value="contributor">Contributor</option>
                        <option value="viewer">Viewer</option>
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-text offset-md-4">
                    Select the role of the user in this organization. 
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('assigningUserPermission')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="save_permission()" wire:loading.attr="disabled">
                Save 
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>