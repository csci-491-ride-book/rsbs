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

    public function ownedMessageThreads()
    {
        return $this->hasMany('MessageThread', 'user_id');
    }

    public function messageThreads()
    {
        return $this->belongsToMany('MessageThread', 'conversations', 'user_id', 'message_thread_id');
    }

    public function rides()
    {
        return $this->belongsToMany('RidePosting', 'rides', 'user_id', 'ride_posting_id');
    }
}