
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
                    <a href="{{ route('welcome')}}">Go Back to Search Results</a> 
                </h5>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-4">
                            <h4>{{ __('Player Profile') }} </h4>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('players.edit', $player->id)}}" class="btn btn-success">
                                {{ __('Edit Player') }}
                            </a>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>{{$player->name}}</h4> <span class="player-segment producer">Producer</span>
                        </div>    
                    </div>
                    <div class="row player-details">
                        <div><label> <strong>Location:</strong> </label> {{$player->address}}</div>
                        <div><label> <strong>Products:</strong> </label> 
                            @foreach($player->products()->get() as $product)
                                @if(!$loop->last)
                                    {{$product->common_name}},
                                @else
                                    {{$product->common_name}}
                                @endif
                            @endforeach
                        </div>
                        <p>
                            {{$player->description}}
                        </p>
                    </div>
                    <div class="row business-relationships">
                        <h5>Business Relationships</h5>
                        <hr>
                        <div class="business-partner">
                            <a href=""><h6>Business Name</a></h6>
                            <p><span class="player-segment input">Input</span> Small fry, fingerlings, feeds</p>
                        </div>
                        <div class="business-partner">
                            <a href=""><h6>Business Name</a></h6>
                            <p><span class="player-segment processor">Processor</span> Small fry, fingerlings, feeds</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>