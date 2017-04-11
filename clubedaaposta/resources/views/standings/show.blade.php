@extends('layouts.app')

@section('pre-script')
  @extends('plugins.bootstrapTable')   
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Classificação</div>

                <div class="panel-body">
                    @if (isset($standings))

                        <table class="table table-hover table-condensed" data-toggle="table" data-sort-name="position" data-sort-order="asc" data-checkbox-header="false" data-locale="pt_BR">

                            <thead>

                                <tr>
                                    <th data-field="position" data-sortable="true">Posição</th>            
                                    <th data-field="team" data-sortable="true">Time</th>
                                    <th data-field="pts" data-sortable="true">Pontos</th>
                                    <th data-field="games" data-sortable="true">Jogos</th>
                                    <th data-field="wins" data-sortable="true">Vitórias</th>
                                    <th data-field="draw" data-sortable="true">Empates</th>
                                    <th data-field="loses" data-sortable="true">Derrotas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($standings as $standing)                                
                                  <tr>
                                    <td>{{ $standing->pos }}</td>
                                    <td>{{ $standing->team->name }}</td>
                                    <td>{{ $standing->pts }}</td>
                                    <td>{{ $standing->qty_games }}</td>
                                    <td>{{ $standing->qty_wins }}</td>
                                    <td>{{ $standing->qty_draw }}</td>
                                    <td>{{ $standing->qty_loses }}</td>
                                    
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
