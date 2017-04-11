@extends('layouts.app')

@section('pre-script')
  @extends('plugins.bootstrapTable')   
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Escolha o Campeonato que deseja ver a classificação</div>

                <div class="panel-body">
                    @if (isset($championships))

                        <table class="table table-hover table-condensed" data-toggle="table" data-sort-name="name" data-sort-order="asc" data-checkbox-header="false" data-locale="pt_BR">

                            <thead>

                                <tr>
                                    <th data-field="name" data-sortable="true">Nome</th>            
                                    <th data-field="options" data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($championships as $championship)                                
                                  <tr>
                                    <td>{{ $championship->name }}</td>
                                    <td>
                                        <a href="{{ route('standings.index', [$championship->id]) }}"><i class="fa fa-plus" style="color: blue;"></i></a>
                                    
                                    
                                        
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
