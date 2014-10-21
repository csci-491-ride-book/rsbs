<?php

class RideRequest extends \Eloquent {
    protected $fillable = [];

    public function ridePosting()
    {
        return $this->belongsTo('RidePosting', 'ride_posting_id');
    }

    public function user()
    {
    	return $this->belongsTo('User', 'user_id');
    }

}