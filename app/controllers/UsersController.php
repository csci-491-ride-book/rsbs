<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
    	return View::make('User/index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('User/create');
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
			'user_name'       => 'required',
			'email'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('Users/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store
			$user = new User;
			$user->user_name = Input::get('user_name');
			$user->email = Input::get('email');
			$user->save();

			// redirect
			Session::flash('message', 'Successfully created user!');
			return Redirect::to('Users');
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
		$user = User::find($id);
		$rides = Posting::where('user_id', '=', $id)->whereNotNull('ride_posting_id')->get();
		$books = Posting::where('user_id', '=', $id)->whereNotNull('book_posting_id')->get();
		$requests = $user->rideRequests();

    	return View::make('User/show')->with('user', $user)->with('rides',$rides)->with('books',$books)
    	->with('requests',$requests);
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