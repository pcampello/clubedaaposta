@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Cadastrar Jogos</h3></div>
                

                <div class="panel-body">

                    @include('layouts.responseMsg')

                    <form class="form" role="form" method="POST" action="{{ route('games.store') }}">


                        <div class="row col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Campeonato</label>

                            <div class="col-md-8">

                                <select class="form-control" id="championshipId" name="championshipId">
                                    @foreach($championships as $championship)

                                        <option value={{ $championship->id }}>{{ $championship->name }}</option>

                                    @endforeach
                                    
                                </select> 

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group col-md-12"> 

                            <div class="form-group col-md-3">  
                                <label for="home_team_id" class="control-label">Time da Casa</label>

                                <select class="form-control" id="home_team_id" name="home_team_id">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach                                    
                                </select>                                

                                

                            </div>          
                            <div class="form-group col-md-2"> 
                                <label for="home_goals" class="">&nbsp;</label>
                                <input id="home_goals" type="text" class="form-control" name="home_goals" title="Gols" 
                                value="{{ isset($home_goals) ? $home_goals : old('home_goals') }}"> 
                            </div>

                            <div class="col-md-2" style="text-align: center;">
                                <label class="">&nbsp;</label>
                                <label class="" style="width: 100%;">X</label>
                                
                                
                            </div>

                            <div class="form-group col-md-2"> 
                                <label for="away_goals" class="">&nbsp;</label>
                                <input id="away_goals" type="text" class="form-control" name="away_goals" title="Gols" 
                                value="{{ isset($away_goals) ? $away_goals : old('away_goals') }}"> 
                            </div>




                            <div class="form-group col-md-3">  
                                <label for="away_team_id" class="control-label">Time Visitante</label>
                                <select class="form-control" id="away_team_id" name="away_team_id">
                                    @foreach($teams as $team)
                                        <option value={{ $team->id }}>{{ $team->name }}</option>
                                    @endforeach                                    
                                </select> 
                            </div>
                            

                            
            


                        </div> 

                        

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-5">
                                {{-- {{ csrf_field() }} --}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>


                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
