<?php

class User extends Eloquent {
    protected $fillable = array('user_name');

    /**
     * One to many relationship defining rides where this user was the driver.
     *
     * Local key:   id
     * Foreign key: user_id
     */
    protected function ridesAsDriver() {
        return $this->hasMany('Ride');
    }

    /**
     * Many to many relationship defining rides where this user was a passenger.
     *
     * Pivot Table:      user_passenger_rides
     * Pivot Table keys: user - user_id
     *                   ride - ride_id
     */
    protected function ridesAsPassenger() {
        return $this->belongsToMany('Ride');
    }

    /**
     * One to many relationship defining rides where this user requested a ride.
     *
     * Local key:   id
     * Foreign key: user_id
     */
    public function rideRequests()
    {
        return $this->hasMany('RideRequest');
    }
}