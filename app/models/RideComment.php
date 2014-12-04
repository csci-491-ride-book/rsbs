<?php

class RideComment extends Eloquent {
    protected $fillable = [];

    public function poster() {
        return $this->belongsTo('User');
    }

    public function ride() {
        return $this->belongsTo('Ride');
    }
}