<?php

class Message extends \Eloquent {
    protected $fillable = [];

    public function messageThread()
    {
        return $this->belongsTo('MessageThread', 'message_thread_id');
    }
}