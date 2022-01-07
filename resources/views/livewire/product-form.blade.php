
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form wire:submit.prevent="save" class="row gx-3 gy-2 align-items-center">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-auto">
                <label for="common_name" class="col-form-label text-md-end">{{ __('Common Name') }}</label>
                <input id="common_name" wire:model="common_name" type="text" class="form-control @error('common_name') is-invalid @enderror" name="common_name" value="{{ old('common_name') }}" required autocomplete="common_name" autofocus>
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
