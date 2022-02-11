
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Player Details') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div>
                <h5>
                    <a href="{{ route('dashboard')}}">Go Back to Search Results</a> 
                </h5>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-4">
                            <h4>{{ __('Player Profile') }} </h4>
                        </div>

                        @can('update', $player)
                        <div class="col-md-2">
                            <a href="{{route('players.edit', $player->id)}}" class="btn btn-success">
                                {{ __('Edit Player') }}
                            </a>
                        </div>
                        @endcan
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>{{$player->name}}</h4> <span class="player-segment producer">Producer</span>
                        </div>    
                    </div>
                    <div class="row player-details">
                        <div><label> <strong>Location:</strong> </label> {{$player->address()}}</div>
                        <div><label> <strong>Products:</strong> </label> 
                            @if($player->products()->count()==0)
                                <span>No registered products!</span>
                            @endif
                            @foreach($player->products()->get() as $product)
                                @if(!$loop->last)
                                    {{$product->common_name}},
                                @else
                                    {{$product->common_name}}
                                @endif
                            @endforeach
                        </div>
                        <div><label> <strong>Equipment/Technology:</strong> </label> 
                            @if($player->equipments()->count()==0)
                                <span>No registered equipments!</span>
                            @endif
                            @foreach($player->equipments()->get() as $equipment)
                                @if(!$loop->last)
                                    {{$equipment->common_name}},
                                @else
                                    {{$equipment->common_name}}
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <label><strong>Other Details:</strong></label>
                            <p>
                                {{$player->description}}
                            </p>
                        </div>
                        <div><label><strong>Data Sources:</strong> </label>{{$player->data_source}}</div>
                    </div>
                    <div class="row business-relationships mt-5">
                        <h5>Business Relationships</h5>
                        <hr>
                        <div class="business-partner">
                            <a href=""><h6>Business Name (Dummy Data)</a></h6>
                            <p><span class="player-segment input">Input</span> Small fry, fingerlings, feeds</p>
                        </div>
                        <div class="business-partner">
                            <a href=""><h6>Business Name (Dummy Data)</a></h6>
                            <p><span class="player-segment processor">Processor</span> Small fry, fingerlings, feeds</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>