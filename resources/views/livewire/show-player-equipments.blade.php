<div class="row">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Common Name</th>
        <th scope="col">No. of Units</th>
        <th scope="col">Date Acquired</th>
        <th scope="col">Name of Provider</th>
        <th scope="col">Status</th>
        <th scope="col">Remarks</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
       @foreach($equipments as $equipment)
            <tr>
            <th scope="row">{{$loop->index}}</th>
            <td>{{$equipment->common_name}}</td>
            <td>{{$equipment->quantity}}</td>
            <td>{{$equipment->date_acquired}}</td>
            <td>{{$equipment->provider}}</td>
            <td>{{$equipment->status}}</td>
            <td>{{$equipment->remarks}}</td>
            <td>
                <button data-bs-toggle="modal" data-bs-target="#updateEquipmentModal" wire:click="edit({{ $equipment->id }})" class="btn btn-primary btn-sm">Edit</button>
                <button  wire:click="delete({{ $equipment->id }})" class="btn btn-danger btn-sm">Delete</button>
            </td>
            </tr>
        @endforeach
    </tbody>
    </table>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateEquipmentModal" tabindex="-1" aria-labelledby="NewEquipmentModal" aria-hidden="true">
  <div class="modal-dialog">
    <form wire:submit.prevent="update" class="row gx-3 gy-2 align-items-center">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="UpdateEquipmentLabel">Add Equipment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-auto">
                <label for="common_name" class="col-form-label text-md-end">{{ __('Common Name') }}</label>
                <input wire:model="common_name"  type="text" class="form-control @error('common_name') is-invalid @enderror" name="common_name" value="{{ old('common_name') }}" required autocomplete="common_name" autofocus>
                @error('common_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-auto">
                <label for="quantity" class="col-form-label text-md-end">{{ __('No. of Units') }}</label>
                <input wire:model="quantity"  type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity" autofocus>
                @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-auto">
                <label for="date_acquired2" class="col-form-label text-md-end">{{ __('Date Acquired') }}</label>
                <input id="date_acquired2" placeholder="YYYY-MM-DD" wire:model="date_acquired"  type="text" class="form-control @error('date_acquired') is-invalid @enderror" name="date_acquired" value="{{ old('date_acquired') }}" required autocomplete="date_acquired" autofocus>
                @error('date_acquired')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
            </div>
            <div class="col-auto">
                <label for="provider" class="col-form-label text-md-end">{{ __('Name of Provider') }}</label>
                <input wire:model="provider"  type="text" class="form-control @error('provider') is-invalid @enderror" name="provider" value="{{ old('provider') }}" required autocomplete="provider" autofocus>
                @error('provider')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-auto">
                <label for="status" class="col-form-label text-md-end">{{ __('Operational Status') }}</label>
                <select wire:model="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status">
                    <option value="operational">Operational</option>
                    <option value="non-operational">Not Operational</option>
                </select>
                @error('provider')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-auto">
                <label for="remarks" class="col-form-label text-md-end">{{ __('Remarks') }}</label>                
                    <textarea wire:model="remarks" type="text" class="form-control @error('description') is-invalid @enderror" name="remarks" required autocomplete="description" rows="3"></textarea>

                    @error('remarks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Product</button>
        </div>
        </div>
    </form>
  </div>
</div>

</div>




