@extends('layout')

@section('header-title')
<h1 style='padding-top: 28px; width: auto; float: left; '>Find a Ride</h1>
@stop



@section('content')

<!-- will be used to show any messages -->

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
//<![CDATA[

    function load() {
        var map = new google.maps.Map(document.getElementById("map-div"), {
            center: new google.maps.LatLng(48.5, -122.4750),
            zoom: 8,
            mapTypeId: 'roadmap'
        });


    }
//]]>

</script>
<body onload="load()">

    <div id="map-div"></div>
    <div id="rides-list">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class='rides-list-tab'>
            <input type='radio' id='tab-1' name='tab-group-1' checked>
            <label for='tab-1'><strong>Search Rides</strong></h1></label>

            <div class='rides-list-content'>
                <table class="table table-striped table-bordered" style="width: 100%; float: left">
                    <thead>
                        <tr>
                            <td>To</td>
                            <td>From</td>
                            <td>User</td>
                            <td>Date/Time</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rides as $key => $value)
                        <tr>
                            <td>{{ $value->to }}</td>
                            <td>{{ $value->from }}</td>
                            <!-- we will also add show, edit, and delete buttons -->
                            <!-- <td>
                                    <a class="btn btn-small btn-success" href="{{ URL::to('Rides/' . $value->id) }}">Show this Ride</a>
                                    <a class="btn btn-small btn-info" href="{{ URL::to('Rides/' . $value->id . '/edit') }}">Edit this Ride</a>
                            </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

                {{ Form::submit('Create the Ride!', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</body>
@stop