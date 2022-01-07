<x-app-layout>
<x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('List of Players') }}
        </h2>
    </x-slot>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h5>List of Players</h5>
            <table class="table">
                <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        Location
                    </th>
                    <th>
                        Segment
                    </th>
                    <th>
                        Products/Services
                    </th>
                </thead>
                <tbody>
                    @foreach ($players as $player)
                        <tr>
                            <td>
                                <a href="{{ route('players.show', $player->id)}}">{{ $player->name}}</a>
                            </td>
                            <td>
                                {{ $player->address}}
                            </td>
                            <td>
                                {{ __('Segment') }}
                            </td>
                            <td>
                                Products and Services
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
</div>
</x-app-layout>
