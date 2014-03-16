<?php

class RidePostingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rides = RidePosting::all();

    	return View::make('RidePosting/index')->with('rides', $rides);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('RidePosting/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'to'       => 'required',
			'from'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('RidePostings/create')
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
			return Redirect::to('RidePostings');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}