<div>
    <div class="row mb-3">
        <label for="region" class="col-md-4 col-form-label text-md-end">{{ __('Region') }}</label>

        <div class="col-md-6">
            <select id="region" wire:model="region" type="text" name="region" class="form-select" aria-label="Region Label">
                <option selected>Select Region</option>
                @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->region_name}}</option>
                @endforeach
            </select>


            @error('region')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="province" class="col-md-4 col-form-label text-md-end">{{ __('Province') }}</label>

        <div class="col-md-6">
            <select id="province" wire:model="province" name="province" class="form-select" type="text" aria-label="Province Label">
                <option selected>Select Province</option>
                @foreach($provinces as $province)
                    <option value="{{$province->id}}">{{$province->name}}</option>
                @endforeach
            </select>


            @error('province')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="municipality" class="col-md-4 col-form-label text-md-end">{{ __('Municipality') }}</label>

        <div class="col-md-6">
            <select id="municipality" wire:model="municipality" name="municipality" class="form-select" type="text" aria-label="Province Label">
                <option selected>Select Municipality</option>
                @foreach($municipalities as $municipality)
                    <option value="{{$municipality->id}}">{{$municipality->name}}</option>
                @endforeach
            </select>


            @error('municipality')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="barangay" class="col-md-4 col-form-label text-md-end">{{ __('Barangay') }}</label>

        <div class="col-md-6">
            <select wire:model="barangay_id" type="text" class="form-select" name="barangay_id" aria-label="Barangay Label">
                <option selected>Select Barangay</option>
                @foreach($barangays as $barangay)
                    <option value="{{$barangay->id}}">{{$barangay->name}}</option>
                @endforeach
            </select>


            @error('barangay')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
