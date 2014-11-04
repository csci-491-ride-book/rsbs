@extends('layout')

@section('resources')
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src=http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript">

function showAdvanced() {
    if (document.getElementById('advanced').value == 'Yes') {
        document.getElementById('AdvancedField1').style.display = 'block';
		document.getElementById('AdvancedField2').style.display = 'block';
		document.getElementById('AdvancedField3').style.display = 'block';
    } else {
        document.getElementById('AdvancedField1').style.display = 'none';
		document.getElementById('AdvancedField2').style.display = 'none';
		document.getElementById('AdvancedField3').style.display = 'none';
    }
}

function initialize() {
    var mapProp = {
        center: new google.maps.LatLng(48.5, -122.4750),
        zoom: 8,
        mapTypeId: 'roadmap'
    };
    var map = new google.maps.Map(document.getElementById("map-div"), mapProp);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
@stop



@section('content')

<!-- will be used to show any messages -->
<h1 id="page-title">Find a Ride</h1>
<div id="map-div"></div>
<div id="rides-list">
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class='rides-list-tab'>
        <input type='radio' id='tab-1' name='tab-group-1' checked>
        <label for='tab-1'><strong>Search Rides</strong></h1></label>

        <div class='rides-list-content'>
            <div id="rides-search-div">
                {{ HTML::ul($errors->all()) }}

                {{ Form::open(array('action' => 'RidePostingsController@search')) }}

                <div class="form-group">
                    {{ Form::label('to', 'To') }}
                    {{ Form::text('to', Input::old('to'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('from', 'From') }}
                    {{ Form::text('from', Input::old('from'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ form::label('advanced', 'Advanced')}}
                    {{ form::checkbox('Advanced Search', 'Yes', false, array('id' => 'advanced', 'onclick' => 'showAdvanced()'))}}
                </div>

				<div class="form-group" id="AdvancedField1" style="display: none">
					<label for="date">Date and Time of Departure</label>
					<input class="form-control" type="datetime-local" name="date"/> 
				</div>
				
				<div class="form-group" id="AdvancedField2" style="display: none">
					{{ Form::label('seats', 'Seats Available') }}
					{{ Form::text('seats', Input::old('seats'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group" id="AdvancedField3" style="display: none">
					{{ Form::label('price', 'Seat Price') }}
					{{ Form::text('price', Input::old('price'), array('class' => 'form-control')) }}
				</div>

                {{ Form::submit('Submit Search', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>

        </div>
    </div>

    <div class='rides-list-tab'>
        <input type='radio' id='tab-2' name='tab-group-1'>
        <label for='tab-2'><strong>Offer a Ride</strong></label>

        <div class='rides-list-content'>
            {{ HTML::ul($errors->all()) }}

            {{ Form::open(array('url' => 'RidePostings')) }}
            {{ Form::hidden('user_id', Input::old($current_user->id), array('class' => 'form-control')) }}
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

            {{ Form::hidden('user_id', $current_user->id, Input::old('user_id'), array('class' => 'form-control')) }}

            {{ Form::submit('Create the Ride!', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>
</div>
<div id="rides-result-div">
    <h2>Available Rides</h2>
    @foreach($rides as $key => $value)
    <div id="ride-list-item">
        <div id ="ride-list-item-date">
            <h5><?php
                $date = new DateTime($value->date);
                echo $date->format('m/d')
                ?></h5>
        </div>
        <div id="ride-list-item-to-from">
            <h4>To: {{ $value->to }}</h4>
            <h4>From: {{ $value->from }}</h4>
        </div>

        <!-- we will also add show, edit, and delete buttons -->
        <!-- <td>
                <a class="btn btn-small btn-success" href="{{ URL::to('Rides/' . $value->id) }}">Show this Ride</a>
                <a class="btn btn-small btn-info" href="{{ URL::to('Rides/' . $value->id . '/edit') }}">Edit this Ride</a>
        </td> -->
    </div>
    @endforeach
</div>
@stop