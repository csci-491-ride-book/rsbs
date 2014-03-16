<?php

class RideRequest extends \Eloquent {
    protected $fillable = [];

    public function posting()
    {
        return $this->belongsTo('Posting', 'posting_id');
    }

    public function user()
    {
    	return $this->belongsTo('User', 'user_id');
    }
}