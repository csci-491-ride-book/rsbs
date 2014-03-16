<?php

class BookPosting extends \Eloquent {
    protected $fillable = [];

    public function posting()
    {
    	return $this->hasOne('Posting', 'book_posting_id');
    }
}