@extends('layout')

@section('resources')
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />

@section('content')
<div class="row" style="margin-top: 1em">
    <div class="col-sm-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    User Details
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="control-label col-xs-6">User Name:</label>
                    <label class="control-label col-xs-6 text-right">{{ $user->user_name }}</label>
                </div>
                <div class="row">
                    <label class="control-label col-xs-6">Display Name:</label>
                    <label class="control-label col-xs-6 text-right">{{ $user->display_name }}</label>
                </div>
                <div class="row">
                    <label class="control-label col-xs-6">Email:</label>
                    <label class="control-label col-xs-6 text-right">{{ $user->email }}</label>
                </div>
                <div class="row">
                    <label class="control-label col-xs-6">User Since:</label>
                    <label class="control-label col-xs-6 text-right">{{ $user->created_at }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    Rides As Driver
                </div>
            </div>
            <div class="panel-body">
            @if ($user->ridesAsDriver->count()>0)
                @foreach($user->ridesAsDriver as $ride)
                <div class="row ride-list-item">
                    <a href="{{ route('rides.show', $ride->id) }}"></a>
                    <label class="control-label col-xs-6">To:</label>
                    <label class="control-label col-xs-6 text-right">{{ $ride->destination }}</label>
                    <label class="control-label col-xs-6">From:</label>
                    <label class="control-label col-xs-6 text-right">{{ $ride->origin }}</label>
                    <label class="control-label col-xs-6">Date:</label>
                    <label class="control-label col-xs-6 text-right">{{ $ride->date }}</label>
                </div>
                @endforeach
            @else
            <div class="row">
                <div class="col-xs-12">
                    <i>No rides offered</i>
                </div>
            </div>
            @endif
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    Rides As Passenger
                </div>
            </div>
            <div class="panel-body">
                @if ($user->ridesAsPassenger->count()>0)
                    @foreach($user->ridesAsPassenger as $ride)
                    <div class="row ride-list-item">
                        <a href="{{ route('rides.show', $ride->id) }}"></a>
                        <label class="control-label col-xs-6">To:</label>
                        <label class="control-label col-xs-6 text-right">{{ $ride->destination }}</label>
                        <label class="control-label col-xs-6">From:</label>
                        <label class="control-label col-xs-6 text-right">{{ $ride->origin }}</label>
                        <label class="control-label col-xs-6">Date:</label>
                        <label class="control-label col-xs-6 text-right">{{ $ride->date }}</label>
                    </div>
                    @endforeach
                @else
                <div class="row">
                    <div class="col-xs-12">
                        <i>No rides ridden</i>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop