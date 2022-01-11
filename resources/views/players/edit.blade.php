<x-app-layout>
<x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Update Player Details') }}
        </h2>
    </x-slot>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('Update Player\'s Profile')}} - {{$player->name }}</h4></div>

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Basic Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Products & Services</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Business Relationships</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row mt-3">
                                <form method="POST" action="{{ route('players.update', $player->id) }}">
                                    @method('PATCH')
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $player->name }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                                        <div class="col-md-6">
                                            <select id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type">
                                                <option value="Individual" @if($player->type == 'individual') selected @endif>Individual</option>
                                                <option value="Organization" @if($player->type == 'organization') selected @endif>Organization</option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="vc_segment" class="col-md-4 col-form-label text-md-end">{{ __('Value Chain Segment') }}</label>

                                        <div class="col-md-6">
                                            <select id="vc_segment" type="text" class="form-control @error('vc_segment') is-invalid @enderror" name="vc_segment" value="{{ old('vc_segment') }}" required autocomplete="vc_segment">
                                                <option value="input" @if($player->vc_segment == 'input') selected @endif>Input</option>
                                                <option value="producer" @if(@$player->vc_segment == 'producer') selected @endif>Producer</option>
                                                <option value="processor" @if(@$player->vc_segment == 'processor') selected @endif)>Processor</option>
                                                <option value="trader" @if(@$player->vc_segment == 'trader') selected @endif>Trader</option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-text offset-md-4">
                                            Select the value chain segment this player belongs to. 
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" rows="3" disabled>{{ $player->address}}</textarea>

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @livewire('address-input', ['player'=> $player])

                                    <div class="row mb-3">
                                        <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" rows="3">{{ $player->description}}</textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row mt-3 justify-content-end">
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Add Product
                                    </button>
                                </div>
                                
                            </div>
                            @livewire('product-form', ['player'=> $player])
                            @livewire('show-player-products', ['player' => $player])
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
