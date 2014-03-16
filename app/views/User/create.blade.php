@extends('layout')

@section('content')

<h1>Create a User</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'Users')) }}

  <div class="form-group">
    {{ Form::label('user_name', 'Name') }}
    {{ Form::text('user_name', Input::old('user_name'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
  </div>

  {{ Form::submit('Create the User!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@stop