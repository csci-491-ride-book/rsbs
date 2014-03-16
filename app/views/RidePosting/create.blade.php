@extends('layout')

@section('content')

<h1>Create a Ride</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'RidePostings')) }}

  <div class="form-group">
    {{ Form::label('to', 'To') }}
    {{ Form::text('to', Input::old('to'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('from', 'From') }}
    {{ Form::text('from', Input::old('from'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    <label for="date">Date and Time of Departure</label>
    <input class="form-control" type="datetime-local" name="date"/> 
  </div>

  <div class="form-group">
    {{ Form::label('seats', 'Seats Available') }}
    {{ Form::text('seats', Input::old('seats'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('price', 'How much will you charge?') }}
    {{ Form::text('price', Input::old('price'), array('class' => 'form-control')) }}
  </div>

  {{ Form::submit('Create the Ride!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@stop