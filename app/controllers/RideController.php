<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 11/17/2014
 * Time: 6:05 PM
 */

class RideController extends BaseController {

    protected function getRides() {
        if (Input::has('searchTo') || Input::has('searchFrom')){
            $rides = RidePosting::where(function($query)
            {
                // Try to add to
                if (Input::has('searchTo')) {
                    $query->where('to', 'LIKE', '%' . Input::get('searchTo') . '%');
                }
                // Try to add from
                if (Input::has('searchFrom')) {
                    $query->where('from', 'LIKE', '%' . Input::get('searchFrom') . '%');
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
            })->orderBy('date', 'asc')->get();
        } else {
            $rides = RidePosting::orderBy('date', 'asc')->get();
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
            'to'   => 'required',
            'from' => 'required'
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
            $ride = new RidePosting;
            $ride->to = Input::get('to');
            $ride->from = Input::get('from');
            $ride->date = Input::get('date');
            $ride->price = Input::get('price');
            $ride->seats = Input::get('seats');
            $ride->save();
            $posting = new Posting;
            $posting->ride_posting_id = $ride->id;
            $posting->user_id = Input::get('user_id');
            $posting->save();

            // redirect
            Session::flash('message', 'Successfully created ride!');
            return Redirect::to('rides');
        }
    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function destroy($id) {

    }
} 