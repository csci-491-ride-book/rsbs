<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 11/17/2014
 * Time: 6:05 PM
 */

class RideController extends BaseController {

    protected function getRides() {
        // Advanced Search
        if (Input::has('searchTo') || Input::has('searchFrom')){
            $rides = Ride::where(function($query)
            {
                // Try to add to
                if (Input::has('searchTo')) {
                    $query->where('destination', 'LIKE', '%' . Input::get('searchTo') . '%');
                }
                // Try to add from
                if (Input::has('searchFrom')) {
                    $query->where('origin', 'LIKE', '%' . Input::get('searchFrom') . '%');
                }
                // If advanced is checked
                if (Input::has('advanced')) {
                    // Try to add price
                    if (Input::has('price')) {
                        $query->where('price', 'LIKE', '%' . Input::get('price') . '%');
                    }
                    // Try to add date
                    if (Input::has('date')) {
                        $query->where('date', 'LIKE', '%' . Input::get('date') . '%');
                    }
                    // Try to add available seats
                    if (Input::has('seats')) {
                        $query->where('seats', 'LIKE', '%' . Input::get('seats') . '%');
                    }
                }
            })->where('date', '>', new DateTime('now'))->orderBy('date', 'asc')->get();
        } else {
            // Simple Search
            if (Input::has('search')){
                $rides = Ride::where(function($query){
                                        $query->where('destination', 'LIKE', '%' . Input::get('search') . '%')
                                              ->orwhere('origin', 'LIKE', '%' . Input::get('search') . '%');
                                    })->where('date', '>', new DateTime('now'))->orderBy('date', 'asc')->get();
            }
            // Empty Simple Search Form
            else {
                $rides = Ride::where('date', '>', new DateTime('now'))->orderBy('date', 'asc')->get();
            }
        }
        return $rides;
    }

    public function index() {
        return View::make('rides.index')->with('rides', $this->getRides());
    }

    public function create() {

    }

    public function store() {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'destination' => 'required',
            'origin'      => 'required',
            'date'        => 'required|date',
            'price'       => 'required|numeric',
            'seats'       => 'required|integer'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            Session::flash('message', 'Failed ride creation!');
            return Redirect::to('rides')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $ride = new Ride;
            $ride->user_id = Input::get('user_id');
            $ride->destination = Input::get('destination');
            $ride->origin = Input::get('origin');
            $ride->date = Input::get('date');
            $ride->seat_price = Input::get('price');
            $ride->seats = Input::get('seats');
            $ride->save();

            // redirect
            Session::flash('message', 'Successfully created ride!');
            return Redirect::to('rides');
        }
    }

    public function show($id) {
        $ride = Ride::find($id);
        
        if ($ride == null){
            return Redirect::to('rides');
        }
        
        $driver = User::find($ride->user_id);
        $passengers = $ride->passengers;
        $comments = $ride->comments;
        $requests = $ride->requests;

        return View::make('rides.show', array(
            'ride' => $ride,
            'driver' => $driver,
            'passengers' => $passengers,
            'comments' => $comments,
            'requests' => $requests));
    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function destroy($id) {
    }
    
    public function deleteRide(){
        $ride = Ride::find(Input::get('rideId'))->delete();
        return Redirect::route('users.show', Input::get('userId'));
    }

    public function addRequest() {
        $ride = Ride::find(Input::get('rideId'));
        $rideRequest = RideRequest::create(array('ride_id' => Input::get('rideId'), 'user_id' => Input::get('userId')));

        $ride->requests()->save($rideRequest);
        $ride->save();

        return Redirect::route('rides.show', $ride->id);
    }

    public function confirmRequest() {
        $user = User::find(Input::get('requesterId'));
        Ride::find(Input::get('rideId'))->passengers()->save($user);
        RideRequest::destroy(Input::get('requestId'));

        return Redirect::route('rides.show', Input::get('rideId'));
    }

    public function addComment() {
        $ride = Ride::find(Input::get('rideId'));
        $rideComment = RideComment::create(array(
            'ride_id' => Input::get('rideId'),
            'user_id' => Input::get('userId'),
            'message_body' => Input::get('messageBody')));

        $ride->comments()->save($rideComment);

        return Redirect::route('rides.show', $ride->id);
    }
} 