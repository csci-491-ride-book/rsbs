@extends('layout')

@section('resources')
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />

<script src=http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script type="text/javascript">

    google.maps.event.addDomListener(window, 'load', initialize);

    var map;
    var marker;
    var directionsDisplay;
    var searchAutocomplete;
    var toSearchAutocomplete;
    var fromSearchAutocomplete;
    var toOfferAutocomplete;
    var fromOfferAutocomplete;
    var directionService;

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
        setRidesListHeight();
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
        
        searchAutocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('searchAutocomplete')),
            {types: ['(cities)']}
        );
        toSearchAutocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('toSearchAutocomplete')),
            {types: ['(cities)']}
        );
        fromSearchAutocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('fromSearchAutocomplete')),
            {types: ['(cities)']}
        );
        toOfferAutocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('toOfferAutocomplete')),
            {types: ['(cities)']}
        );
        fromOfferAutocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('fromOfferAutocomplete')),
            {types: ['(cities)']}
        );

        google.maps.event.addListener(searchAutocomplete, 'place_changed', function(){
            var box = document.getElementById('searchAutocomplete');
            var placeComponents = box.value.split(",");
            var output = placeComponents[0]
            box.value = output;
        });
        google.maps.event.addListener(toSearchAutocomplete, 'place_changed', function(){
            var box = document.getElementById('toSearchAutocomplete');
            var placeComponents = box.value.split(",");
            if (placeComponents[1]){
                var output = placeComponents[0] + "," + placeComponents[1];
            } else {
                var output = placeComponents[0];
            }
            box.value = output;
        });
        google.maps.event.addListener(fromSearchAutocomplete, 'place_changed', function(){
            var box = document.getElementById('fromSearchAutocomplete');
            var placeComponents = box.value.split(",");
            if (placeComponents[1]){
                var output = placeComponents[0] + "," + placeComponents[1];
            } else {
                var output = placeComponents[0];
            }
            box.value = output;
        });
        google.maps.event.addListener(toOfferAutocomplete, 'place_changed', function(){
            var box = document.getElementById('toOfferAutocomplete');
            var placeComponents = box.value.split(",");
            if (placeComponents[1]){
                var output = placeComponents[0] + "," + placeComponents[1];
            } else {
                var output = placeComponents[0];
            }
            box.value = output;
        });
        google.maps.event.addListener(fromOfferAutocomplete, 'place_changed', function(){
            var box = document.getElementById('fromOfferAutocomplete');
            var placeComponents = box.value.split(",");
            if (placeComponents[1]){
                var output = placeComponents[0] + "," + placeComponents[1];
            } else {
                var output = placeComponents[0];
            }
            box.value = output;
        });
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
        //directionsDisplay.set('directions', null);
    }

    function placeMarker(position, map) {

        marker = new google.maps.Marker({
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
                            }
                            if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                                state = results[0].address_components[i];
                            }
                        }
                    }

                    var to = document.getElementById('toSearchAutocomplete');
                    var from = document.getElementById('fromSearchAutocomplete');
                    if(from.getAttribute("value") === null){
                        from.setAttribute("value", city.long_name + ", " + state.short_name);

                    }
                    else{
                        to.setAttribute("value", city.long_name + ", " + state.short_name);
                    }
                } else {
                  alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }
</script>
@stop

@section('content')
<!-- Page Header/User -->


<!-- Display Errors/Messages -->
@if (Session::has('message'))
    @if ($errors->count() > 0)
        <div class="alert alert-danger alert-dismissible" id="messages">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            {{ Session::get('message') }}
            {{ HTML::ul($errors->all()) }}
        </div>
    @else
        <div class="alert alert-success alert-dismissible" id="messages">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            {{ Session::get('message') }}
        </div>
    @endif
@endif

<!-- Main Content -->
<div class="row">
<!--
Map - 2/3 of page on left
Height is set on page load in footer script.
-->
    <div class="col-lg-8" id="map-div"></div>
<!-- /Map -->

<!-- RightSide - 1/3 of page on right -->
    <div class="col-lg-4" id="right-div">

        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Advanced Ride Search</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Search Tab -->
                        <div role="tabpanel" class="tab-pane active" id="search">
                            {{ Form::open(array('method'=>'get', 'id' => 'searchForm', 'class' => 'form-horizontal', 'role' => 'form')) }}
                            <div class="form-group" style="margin-top: 10px;">
                                {{ Form::label('to', 'To', array('class' => 'col-lg-2 control-label')) }}
                                <div class="col-lg-10">
                                    {{ Form::text('searchTo', Input::old('searchTo'), array('id' => 'toSearchAutocomplete', 'class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('from', 'From', array('class' => 'col-lg-2 control-label')) }}
                                <div class="col-lg-10">
                                    {{ Form::text('searchFrom', Input::old('searchFrom'), array('id' => 'fromSearchAutocomplete' , 'class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group" id="AdvancedField1">
                                <label class="col-lg-2 control-label" for="date">Date/Time</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="datetime-local" name="date"/>
                                </div>
                            </div>
                            <div class="form-group" id="AdvancedField2">
                                {{ Form::label('seats', 'Seats Available', array('class' => 'col-lg-2 control-label')) }}
                                <div class="col-lg-10">
                                    {{ Form::text('seats', Input::old('seats'), array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group" id="AdvancedField3">
                                {{ Form::label('price', 'Seat Price', array('class' => 'col-lg-2 control-label')) }}
                                <div class="col-lg-10">
                                    {{ Form::text('price', Input::old('price'), array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('advanced', 'true') }}
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{ Form::submit('Submit Search', array('class' => 'btn btn-primary')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Offer a Ride</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Offer Tab -->
                        <div role="tabpanel" class="tab-pane" id="offer">
                            {{ Form::open(array( 'action' => 'RideController@store', 'class' => 'form-horizontal', 'role' => 'form')) }}
                            {{ Form::hidden('user_id', $currentUser->id, array('class' => 'form-control')) }}
                            <div class="form-group" style="margin-top: 10px;">
                                {{ Form::label('destination', 'To', array('class' => 'col-lg-2 control-label')) }}
                                <div class="col-lg-10">
                                    {{ Form::text('destination', Input::old('destination'), array('id' => 'toOfferAutocomplete', 'class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('origin', 'From', array('class' => 'col-lg-2 control-label')) }}
                                <div class="col-lg-10">
                                    {{ Form::text('origin', Input::old('origin'), array('id' => 'fromOfferAutocomplete', 'class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="date">Date/Time</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="datetime-local" name="date"/>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('seats', 'Seats Available', array('class' => 'col-lg-2 control-label')) }}
                                <div class="col-lg-10">
                                    {{ Form::text('seats', Input::old('seats'), array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('price', 'Seat Price', array('class' => 'col-lg-2 control-label')) }}
                                <div class="col-lg-10">
                                    {{ Form::text('price', Input::old('price'), array('class' => 'form-control')) }}
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{ Form::submit('Create the Ride!', array('class' => 'btn btn-primary')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        
<!-- Search/Offer Tabs -->
        <div class="row" id="ride-tabs">
            <div class="col-lg-12" id="rides-header">
                <h2 style="margin-top: 0.2em; margin-bottom: 0.4em">Available Rides</h2>
            </div>
            <div class="col-lg-12">
                {{ Form::open(array('method'=>'get', 'id' => 'searchForm', 'class' => 'form-horizontal', 'role' => 'form')) }}
                <div class="input-group">
                    {{ Form::text('search', Input::old('search'), array('id' => 'searchAutocomplete', 'class' => 'form-control', 'placeholder' => 'Search Rides')) }}
                    <span class="input-group-btn">
                        {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
                    </span>
                </div>
                {{ Form::close() }}
            </div>
            <div class="col-lg-12" style="margin-top: 1em; margin-bottom: 1em">
                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group btn-group-justified">
                    <div class="btn-group"><a href="#search" data-toggle="modal" data-target="#searchModal"><button type="button" class="btn btn-default">Advanced Search</button></a></div>
                    <div class="btn-group"><a href="#search" data-toggle="modal" data-target="#offerModal"><button type="button" class="btn btn-default">Offer a Ride</button></a></div>
                    </div>
                </div>
            </div>
        </div>
<!-- Available Rides -->
        <div class="row">
            <div class="col-lg-12" id="available-rides" style="overflow-y: scroll">
                @foreach($rides as $ride)
                @if($ride->availableSeats()>0)
                <div class="row" id="ride-list-item"
                    onmouseover="showRoute(this,'{{ $ride->destination }}', '{{ $ride->origin }}');"
                    onmouseout="hideRoute();">
                    <a href="{{ route('rides.show', $ride->id) }}"></a>
                    <div class="col-lg-9 text-left" id="ride-list-item-to-from">
                        <h4>To: {{ $ride->destination }}</h4>
                        <h4>From: {{ $ride->origin }}</h4>
                    </div>
                    <div class="col-lg-3 text-right" id="ride-list-item-date">
                        <h5>
                            <?php
                                $date = new DateTime($ride->date);
                                echo $date->format('m/d/y');
                            ?>
                        </h5>
                        <h6>
                            {{ $date->format('h:i A') }}
                        </h6>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
<!-- /Available Rides -->
    </div>
<!-- /RightSide -->
</div>
@stop

@section('footer-resources')
<script type="text/javascript">
    function setRidesListHeight(){
        var ridesList = document.getElementById('available-rides');

        var height = $('#right-div').outerHeight(true);
        var tabsHeight = $('#ride-tabs').outerHeight(true);
        var divideHeight = $('#ride-divider').outerHeight(true);
        var headerHeight = $('#rides-header').outerHeight(true);

        var listHeight = height - tabsHeight - divideHeight; // - headerHeight;
        ridesList.style.height = listHeight + 'px';
    }

    $(document).on('shown.bs.tab', 'a[data-toggle="pill"]', function(){
        setRidesListHeight();
    });

    $(window).load(function(){
        var mapDiv = document.getElementById('map-div');
        var rightDiv = document.getElementById('right-div');

        var height = window.innerHeight;
        var headerHeight = $('#header').outerHeight(true) + $('#leaderboard').outerHeight(true) + $('#page-header').outerHeight(true);
        var footerHeight = $('#footer').outerHeight(true);

        var newHeight = height - headerHeight - footerHeight;
        mapDiv.style.height = newHeight + 'px';
        rightDiv.style.height = newHeight + 'px';
        //google.maps.event.trigger(map, "resize");

        setRidesListHeight();
    });
</script>
@stop