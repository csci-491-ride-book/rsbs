@extends('layout')

@section('resources')

@stop

@section('content')
<div class="row" style="margin-top: 1em">
    <div class="col-sm-6 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    Ride Details
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="control-label col-xs-6 col-sm-4">Destination:</label>
                    <div class="col-xs-6 col-sm-4 text-right">
                        {{ $ride->destination }}
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-xs-6 col-sm-4">Origin:</label>
                    <div class="col-xs-6 col-sm-4 text-right">
                        {{ $ride->origin }}
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-xs-6 col-sm-4">Departure Date:</label>
                    <div class="col-xs-6 col-sm-4 text-right">
                        <?php
                             $date = new DateTime($ride->date);
                             echo $date->format('m/d/y')
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-xs-6 col-sm-4">Departure Time:</label>
                    <div class="col-xs-6 col-sm-4 text-right">
                        <?php
                             echo $date->format('g:i A')
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-xs-6 col-sm-4">Driver:</label>
                    <div class="col-xs-6 col-sm-4 text-right">
                        {{ $driver->display_name }}
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-xs-6 col-sm-4">Open Seats:</label>
                    <div class="col-xs-6 col-sm-4 text-right">
                        {{ $ride->availableSeats() }}
                    </div>
                    @if (($ride->availableSeats()>0) && ($driver->id !== $currentUser->id))
                        @if ($ride->passengers->contains($currentUser->id))
                        <div class="col-sm-4 hidden-xs">
                            <i>Ride Confirmed</i>
                        </div>
                        @elseif ($ride->requestedBy($currentUser->id))
                        <div class="col-sm-4 hidden-xs">
                            <i>Ride Requested</i>
                        </div>
                        @else
                        {{ Form::open(array('action' => 'RideController@addRequest')) }}
                        {{ Form::hidden('rideId', $ride->id) }}
                        {{ Form::hidden('userId', $currentUser->id) }}
                        <div class="col-sm-4 hidden-xs">
                        {{ Form::submit('Request Ride', array('class' => 'btn btn-primary btn-xs')) }}
                        </div>
                        {{ Form::close() }}
                        @endif
                    @endif
                </div>
                <div class="row">
                    <label class="control-label col-xs-6 col-sm-4">Confirmed Riders:</label>
                    @if ($passengers->count()>0)
                        <div class="col-xs-6 col-sm-4 text-right">
                            {{ $passengers[0]->display_name }}
                        </div>
                    @else
                        <div class="col-xs-6 col-sm-4 text-right">
                            <i>Available</i>
                        </div>
                    @endif
                </div>
                @for ($i = 1; $i < $passengers->count(); $i++)
                    <div class="row">
                        <div class="col-xs-offset-6 col-xs-6 col-sm-offset-4  col-sm-4 text-right">
                            {{ $passengers[$i]->display_name }}
                        </div>
                    </div>
                @endfor
                @for ($j=1 ; $j < $ride->availableSeats()+$passengers->count(); $j++)
                    <div class="row">
                        <div class="col-xs-offset-6 col-xs-6 col-sm-offset-4  col-sm-4 text-right">
                            <i>Available</i>
                        </div>
                    </div>
                @endfor
                @if (($ride->availableSeats()>0) && ($driver->id !== $currentUser->id))
                <div class="row visible-xs" role="group">
                     @if ($ride->passengers->contains($currentUser->id))
                        <div class="col-xs-12 text-center">
                            <i>Ride Confirmed</i>
                        </div>
                     @elseif ($ride->requestedBy($currentUser->id))
                        <div class="col-xs-12 text-center">
                            <i>Ride Requested</i>
                        </div>
                     @else
                        <div class="col-xs-12">
                        {{ Form::open(array('action' => 'RideController@addRequest')) }}
                        {{ Form::hidden('rideId', $ride->id) }}
                        {{ Form::hidden('userId', $currentUser->id) }}
                        {{ Form::submit('Request Ride', array('class' => 'btn btn-primary btn-block')) }}
                        {{ Form::close() }}
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    @if ($driver->id === $currentUser->id)
    <div class="col-sm-6 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    Ride Requests
                </div>
            </div>
            @if ($requests->count()>0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Requester</th>
                            <th>Request Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->user->display_name }}</td>
                            <td>
                                <?php
                                     $requestDate = new DateTime($request->created_at);
                                     echo $date->format('m/d/y');
                                ?>
                            </td>
                            <td>
                                {{ Form::open(array('action' => 'RideController@confirmRequest')) }}
                                {{ Form::hidden('rideId', $ride->id) }}
                                {{ Form::hidden('requesterId', $request->user->id) }}
                                {{ Form::hidden('requestId', $request->id) }}
                                {{ Form::submit('Confirm', array('class' => 'btn btn-primary btn-xs btn-block')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
            <div class="panel-body">
                <i>No requests yet...</i>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Comments</h3>
            </div>
            <ul class="list-group">
                @foreach($comments as $comment)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-4 text-left">
                            {{ User::find($comment->user_id)->display_name }}<br />
                            <?php
                                $commentDate = new DateTime($comment->created_at);
                                echo $commentDate->format('m/d/y g:i A'); ?>
                        </div>
                        <p class="col-xs-8">{{ $comment->message_body }}</p>
                    </div>
                </li>
                @endforeach
                <li class="list-group-item">
                    <div class="row">
                        {{ Form::open(array('action' => 'RideController@addComment')) }}
                        {{ Form::hidden('rideId', $ride->id) }}
                        {{ Form::hidden('userId', $currentUser->id) }}
                        <div class="col-lg-12">
                            <div class="input-group">
                                {{ Form::text('messageBody', Input::old('messageBody'), array('class' => 'form-control', 'maxlength' => '255', 'placeholder' => 'Add a comment...')) }}
                                <span class="input-group-btn">
                                    {{ Form::submit('Submit', array('class' => "btn btn-default", 'type' => 'button')) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop