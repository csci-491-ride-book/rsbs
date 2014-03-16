<?php

class RidePosting extends \Eloquent {
    protected $fillable = [];

    public function posting()
    {
    	return $this->hasOne('Posting', 'ride_posting_id');
    }
}