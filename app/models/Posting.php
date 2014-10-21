<?php

class Posting extends \Eloquent {
    protected $fillable = [];

    public function ride()
    {
        return $this->belongsTo('RidePosting', 'ride_posting_id');
    }

    public function book()
    {
        return $this->belongsTo('BookPosting', 'book_posting_id');
    }

    public function user()
    {
    	return $this->belongsTo('User', 'user_id');
    }


}