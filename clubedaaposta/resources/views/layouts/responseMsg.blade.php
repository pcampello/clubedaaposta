@if (count($errors) > 0)
  <div class="alert alert-danger">
  	<strong>Oops! Algo deu errado, verifique os erros abaixo:</strong>
      <ul> 
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
@if (!empty($message))
  <div class="alert alert-success">
    {!! $message !!}
  </div>
@endif





