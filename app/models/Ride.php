<?php

class Ride extends Eloquent {
    protected $fillable = [];

    public function driver() {
        return $this->belongsTo('User');
    }

    public function passengers() {
        return $this->belongsToMany('User');
    }

    public function requests() {
        return $this->hasMany('RideRequest');
    }

    public function requestedBy($userId) {
        foreach($this->requests as $request) {
            if ($request->user_id === $userId) {
                return true;
            }
        }
        return false;
    }

    public function availableSeats() {
        $totalSeats = $this->seats;
        $acceptedPassengers = $this->passengers()->count();

        return $totalSeats-$acceptedPassengers;
    }
}