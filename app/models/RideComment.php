<?php

class RideComment extends Eloquent {
    protected $fillable = array('ride_id', 'user_id', 'message_body');

    public function poster() {
        return $this->belongsTo('User');
    }

    public function ride() {
        return $this->belongsTo('Ride');
    }
}