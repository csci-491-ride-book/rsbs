@extends('layout')

@section('content')
<div class="row" id="page-header">
    <div class="col-lg-6 text-left">
        <h1>{{ $user->display_name }}'s Details</h1>
    </div>
</div>
@foreach($ridesAsDriver as $ride)
<h5>{{ $ride->id }}</h5>
@endforeach
@stop