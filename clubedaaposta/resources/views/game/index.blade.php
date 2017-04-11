@extends('layouts.app')

@section('pre-script')
  @extends('plugins.bootstrapTable')   
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Jogos</h3>
                    <a class="btn btn-primary" role=button" href="{{ route('games.create') }}">Incluir</a>
                </div>

                <div class="panel-body">
                    @if (isset($games))

                        <table class="table table-hover table-condensed" data-toggle="table" data-sort-name="championship_name" data-sort-order="asc" data-checkbox-header="false" data-locale="pt_BR">

                            <thead>

                                <tr>
                                    <th data-field="championship_name" data-sortable="true">Campeonato</th>            
                                    <th data-field="home_team_name" data-sortable="true">Time da Casa</th>            
                                    <th data-field="home_goals" data-sortable="true">&nbsp;</th>            
                                    <th data-field="x" data-sortable="false">X</th>            
                                    <th data-field="away_goals" data-sortable="true">&nbsp;</th> 
                                    <th data-field="away_team_name" data-sortable="true">Time Visitante</th>            
                                    <th data-field="options" data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($games as $game)                                
                                  <tr>
                                    <td>{{ $game->championship->name }}</td>
                                    <td>{{ $game->homeTeam->name }}</td>
                                    <td>{{ $game->home_goals }}</td>
                                    <td></td>
                                    <td>{{ $game->away_goals }}</td>
                                    <td>{{ $game->awayTeam->name }}</td>
                                    
                                    <td>
                                        <a href="{{ route('games.destroy', [$game->id]) }}"><i class="fa fa-trash-o" style="color: red;"></i></a>
                                    
                                    
                                        <a href="{{ route('games.edit', [$game->id]) }}"><i class="fa fa-edit" style="color: blue;"></i></a>
                                    </td>
                                  </tr>                            
                                @endforeach
                            </tbody>          
                        </table>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
