<?php

class User extends \Eloquent {
    protected $fillable = array('user_name', );

    public function messages()
    {
        return $this->hasMany('Message', 'to_id');
    }

    public function postings()
    {
        return $this->hasMany('Posting', 'user_id');
    }

    public function rideRequests()
    {
        return $this->hasMany('RideRequest', 'user_id');
    }
}