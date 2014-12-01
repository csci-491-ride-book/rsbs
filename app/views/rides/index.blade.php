@extends('layout')

@section('resources')
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src=http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false&libraries=places"></script>
<script type="text/javascript">

function showAdvanced() {
    if (document.getElementById('advanced').checked) {
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
    map = new google.maps.Map(document.getElementById("map-div"), mapProp);
    directionsDisplay = new google.maps.DirectionsRenderer();
    geocoder = new google.maps.Geocoder();

    google.maps.event.addListener(map, 'click', function(e) {
        fillSearch(e.latLng.lat(), e.latLng.lng())
    });
	
	var input = document.getElementById('searchTextField');
	var options = {componentRestrictions: {country: 'us'}};
    
	//var places = new google.maps.places.Autocomplete(input, options);
}

function showRoute(routeDiv, to, from){

    var request = {
        origin: from,
        destination: to,
        travelMode: google.maps.TravelMode.DRIVING
    };

    directionsDisplay.setMap(map);
    directionService = new google.maps.DirectionsService();
    directionService.route(request, function(response, status){
        if(status == google.maps.DirectionsStatus.OK){
            //caching the response with a closure.
            routeDiv.onmouseover = function(){
                directionsDisplay.setDirections(response);
            }
            directionsDisplay.setDirections(response);
        }
    });
}

function hideRoute(){
    directionsDisplay.set('directions', null);
}

function placeMarker(position, map) {
    
    var marker = new google.maps.Marker({
        map: map,
        position: position,
    });

}

function fillSearch(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                //find country name
                for (var i=0; i<results[0].address_components.length; i++) {
                    for (var b=0;b<results[0].address_components[i].types.length;b++) {

                        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                        if (results[0].address_components[i].types[b] == "locality") {
                            //this is the object you are looking for
                            city = results[0].address_components[i];
                            break;
                        }
                    }
                }

                var to = document.getElementById('searchTextField');
                var from = document.getElementById('from');
                if(from.getAttribute("value") === null){
                    from.setAttribute("value", city.long_name);
                    
                }
                else{
                    to.setAttribute("value", city.long_name);
                }
                

            } else {
              alert("No results found");
            }
        } else {
            alert("Geocoder failed due to: " + status);
        }
    });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
@stop

@section('content')

<h1 id="page-title">Find a Ride</h1>
<div id="map-div"></div>
<div id="rides-list">
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="rides-list-tab">
        <input type="radio" id="tab-1" name="tab-group-1" checked>
        <label for="tab-1"><strong>Search Rides</strong></label>
        <div class="rides-list-content">
            {{ HTML::ul($errors->all()) }}
            <div id="rides-search-div">
                {{ Form::open(array('method'=>'get', 'id' => 'searchForm')) }}
                <div class="form-group">
                    {{ Form::label('to', 'To') }}
                    {{ Form::text('to', Input::old('to'), array('id' => 'searchTextField', 'class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('from', 'From') }}
                    {{ Form::text('from', Input::old('from'), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('advanced', 'Advanced') }}
                    {{ Form::checkbox('advanced', 1, false, array('id' => 'advanced', 'onclick' => 'showAdvanced()')) }}
                </div>
                <div class="form-group" id="AdvancedField1" style="display: none">
                	<label for="date">Date/Time</label>
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
            {{ Form::open(array( 'action' => 'RideController@store')) }}
            {{ Form::hidden('user_id', $currentUser->id, array('class' => 'form-control')) }}
            <div class="form-group">
                {{ Form::label('to', 'To') }}
                {{ Form::text('to', Input::old('to'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('from', 'From') }}
                {{ Form::text('from', Input::old('from'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                <label for="date">Date/Time</label>
                <input class="form-control" type="datetime-local" name="date"/>
            </div>
            <div class="form-group">
                {{ Form::label('seats', 'Seats Available') }}
                {{ Form::text('seats', Input::old('seats'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('price', 'Seat Price') }}
                {{ Form::text('price', Input::old('price'), array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Create the Ride!', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
<div id="rides-result-div">
    <h2>Available Rides</h2>
    @foreach($rides as $key => $value)
        <div id="ride-list-item"
            onmouseover="showRoute(this,'{{ $value->to }}', '{{ $value->from }}');"
            onmouseout="hideRoute();">
            <a href="{{ route('rides.show', $value->id) }}"></a>
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
