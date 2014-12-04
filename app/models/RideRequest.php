<?php

class RideRequest extends Eloquent {
    protected $fillable = array('user_id', 'ride_id');

    public function ride()
    {
        return $this->belongsTo('Ride');
    }

    public function user()
    {
    	return $this->belongsTo('User');
    }

}