<div class="row justify-content-center">
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">{{ __('Filter') }}</div>
            <div class="card-body">
                <h6><strong>By Product</strong></h6>
                
                @foreach($product_names as $product_name)
                
                <div class="form-check">
                    <input class="form-check-input" wire:model="product_filter.{{$loop->index}}" type="checkbox" value="{{$product_name->common_name}}" id="flexCheckDefault.{{$loop->index}}" name="product_filter[]">
                    <label class="form-check-label" for="flexCheckDefault.{{$loop->index}}">
                        {{$product_name->common_name}}({{$product_name->hits}})
                    </label>
                </div>
                @endforeach
                
                <h6><strong>By Location</strong></h6>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Tacloban, Leyte
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Palo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Borongan, Eastern Samar
                    </label>
                </div>
                <div>
                    <button type="submit" wire:click="reset_filter" class="btn btn-primary"> Reset</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="row g-3 align-items-center">
            <div class="col-2 form-floating">
            <label class="visually-hidden" for="search_field">Search Field</label>
            <select wire:model="search_field" id="search_field" class="form-select" aria-label="Default select example">
                <option value="player_name">Player Name</option>
                <option value="product_name">Product Name</option>
                <option value="address">Location</option>
            </select>
            <label for="floatingSelect">Search by</label>
            </div>
            <div class="col-8 form-floating">
            <label class="visually-hidden" for="searchField">Search Key</label>
            <input wire:model="search_key" class="form-control form-control-lg" type="text" id="searchField" placeholder="Search for a product" aria-label="Search field">
            <label for="floatingSelect">Type your search phrase</label>
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-lg">Search</button>
            </div>
        </div>
        <div class="row">
            <ul class="search-results">
            @foreach ($players as $player)
                <li>
                    <div class="search-item">
                        <div class="player-name">
                            <a href="{{route('players.show', $player->id)}}">{{$player->name}}</a> from <strong>{{$player->address}}</strong> 
                        </div>
                        <div class="player-segment {{$player->vc_segment}}">
                            {{$player->vc_segment}}
                        </div>
                        <div class="player-products">
                            <p>
                                @if($player->products()->count() == 0)
                                    <span>No registered products!</span>
                                @endif
                                @foreach($player->products()->get() as $product)
                                    @if(!$loop->last)
                                        {{$product->common_name}},
                                    @else
                                        {{$product->common_name}}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <hr>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
