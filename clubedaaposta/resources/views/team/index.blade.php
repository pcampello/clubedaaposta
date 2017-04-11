@extends('layouts.app')

@section('pre-script')
  @extends('plugins.bootstrapTable')   
  
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Times</h3><a class="btn btn-primary" role=button" href="{{ route('teams.create') }}">Incluir</a></div>

                <div class="panel-body">
                    @if (isset($teams))

                        <table id="team-table" class="table table-hover table-condensed" data-toggle="table" data-sort-name="name" data-sort-order="asc" data-checkbox-header="false" data-locale="pt-BR">

                            <thead>

                                <tr>
                                    <th data-field="name" data-sortable="true">Nome</th>            
                                    <th data-field="options" data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $team)                                
                                  <tr>
                                    <td>{{ $team->name }}</td>
                                    <td>
                                        <a href="{{ route('teams.destroy', [$team->id]) }}"><i class="fa fa-trash-o" style="color: red;"></i></a>
                                    
                                    
                                        <a href="{{ route('teams.edit', [$team->id]) }}"><i class="fa fa-edit" style="color: blue;"></i></a>
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
