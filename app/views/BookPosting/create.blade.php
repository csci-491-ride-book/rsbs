@extends('layout')

@section('content')

<h1>Create a Book Posting</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'BookPostings')) }}

  <div class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('author', 'Author') }}
    {{ Form::text('author', Input::old('author'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('ISBN', 'ISBN') }}
    {{ Form::text('ISBN', Input::old('ISBN'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('condition', 'Condition') }}
    {{ Form::text('condition', Input::old('condition'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('edition', 'Edition') }}
    {{ Form::text('edition', Input::old('edition'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('class', 'Class') }}
    {{ Form::text('class', Input::old('class'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('major', 'Major') }}
    {{ Form::text('major', Input::old('major'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
    {{ Form::label('price', 'Price') }}
    {{ Form::text('price', Input::old('price'), array('class' => 'form-control')) }}
  </div>

  {{ Form::submit('Post Book!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@stop