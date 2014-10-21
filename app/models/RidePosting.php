<?php

class RidePosting extends \Eloquent {
    protected $fillable = [];

    public function posting()
    {
    	return $this->hasOne('Posting', 'ride_posting_id');
    }

    public function requests()
    {
    	return $this->hasMany('RideRequest', 'ride_posting_id');
    }

    public function riders()
    {
    	return $this->belongsToMany('User', 'rides', 'ride_posting_id', 'user_id');
    }

}