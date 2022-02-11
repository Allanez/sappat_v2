<div>
    <h1>Organizations</h1>
    <div>
        <button wire:click="showingNewOrgModal()"class="btn btn-primary">Add Organization</button>
    </div>
    <table class="table">
        <thead>
            <th>
                Name
            </th>
            <th>
                Contact Info
            </th>
            <th>
                Level
            </th>
            <th>
                Area of Jurisdiction
            </th>
            <th>
                Action
            </th>
        </thead>
        <tbody>
            @foreach($organizations as $org)
            <tr>
                <td>
                    {{$org->name}}
                </td>
                <td>
                    {{$org->email}}
                </td>
                <td>
                    {{ucfirst($org->political_level)}}
                </td>
                <td>
                    @if($org->political_level == "national")
                        Republic of the Philippines
                    @else
                        {{$org->geographic->full_name()}}
                    @endif
                </td>
                <td>
                    <button wire:click="showingUpdateOrgModal({{$org->id}})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="showingDeleteOrgModal({{$org->id}})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <x-jet-dialog-modal wire:model="addingNewOrg">
        <x-slot name="title">
            Add New Organization
        </x-slot>

        <x-slot name="content">
            <div class="mb-3">
                <x-jet-label value="{{ __('Name') }}" />

                <x-jet-input wire:model="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Email') }}" />

                <x-jet-input wire:model="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                :value="old('email')" required />
                <x-jet-input-error for="email"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Level') }}" />

                <select id="level" wire:model="political_level" type="text" class="form-select form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required autocomplete="level">
                    <option value="national">National</option>
                    <option value="regional">Regional</option>
                    <option value="provincial">Provincial</option>
                    <option value="municipal">Municipal</option>
                </select>
                
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Jurisdiction') }}" />
                @livewire('address-input', ['political_level' => $political_level])
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('addingNewOrg')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
                Save Organization
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="confirmingOrgDeletion">
        <x-slot name="title">
            Delete Organization
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this organization? Once this organization is deleted, all users who were assigned to this organization will lose access to the data in the database.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingOrgDeletion')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete()" wire:loading.attr="disabled">
                Delete Organization
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <x-jet-dialog-modal wire:model="updatingOrg">
        <x-slot name="title">
            Updating Organization
        </x-slot>

        <x-slot name="content">
            <div class="mb-3">
                <x-jet-label value="{{ __('Name') }}" />

                <x-jet-input wire:model="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Email') }}" />

                <x-jet-input wire:model="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                :value="old('email')" required />
                <x-jet-input-error for="email"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Level') }}" />

                <select id="level" wire:model="political_level" type="text" class="form-select form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required autocomplete="level">
                    <option value="national">National</option>
                    <option value="regional">Regional</option>
                    <option value="provincial">Provincial</option>
                    <option value="municipal">Municipal</option>
                </select>
                
            </div>

            <div class="mb-3">
                <x-jet-label value="{{ __('Jurisdiction') }}" />
                @livewire('address-input', ['political_level' => $political_level])
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('updatingOrg')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="update()" wire:loading.attr="disabled">
                Save Organization
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>