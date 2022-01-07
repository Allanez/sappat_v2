<div class="row">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Common Name</th>
        <th scope="col">Unit</th>
        <th scope="col">Est. Unit Cost</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
            <th scope="row">{{$loop->index}}</th>
            <td>{{$product->common_name}}</td>
            <td>Piece</td>
            <td>100</td>
            <td>
                <button data-bs-toggle="modal" data-bs-target="#updateProductModal" wire:click="edit({{ $product->id }})" class="btn btn-primary btn-sm">Edit</button>
                <button wire:click="delete({{ $product->id }})" class="btn btn-danger btn-sm">Delete</button>
            </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    <!-- Update Product Modal -->
<div wire:ignore.self class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form wire:submit.prevent="update" class="row gx-3 gy-2 align-items-center">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateProductModalLabel">Update Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-auto">
                <label for="common_name" class="col-form-label text-md-end">{{ __('Common Name') }}</label>
                <input id="common_name" wire:model="common_name" type="text" class="form-control @error('common_name') is-invalid @enderror" name="common_name" required autocomplete="common_name" autofocus>
                @error('name')
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




