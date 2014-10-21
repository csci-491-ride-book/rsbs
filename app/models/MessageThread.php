<?php

class MessageThread extends \Eloquent {
	protected $fillable = [];

	public function user()
    {
    	return $this->belongsTo('User', 'user_id');
    }

    public function messages()
    {
    	return $this->hasMany('Message', 'message_thread_id');
    }

    public function participants()
    {
    	return $this->belongsToMany('User', 'conversations', 'message_thread_id', 'user_id');
    }
}