<?php

class BookPostingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$books = BookPosting::all();

    	return View::make('BookPosting/index')->with('books', $books);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('BookPosting/create');
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

		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('BooksPosting/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store
			$book = new BookPosting;
			$book->title = Input::get('title');
			$book->author = Input::get('author');
			$book->ISBN = Input::get('ISBN');
			$book->condition = Input::get('condition');
			$book->edition = Input::get('edition');
			$book->class = Input::get('class');
			$book->major = Input::get('major');
			$book->price = Input::get('price');
			$book->save();
			$posting = new Posting;
			$posting->book_posting_id = $book->id;
			$posting->user_id = $_SESSION['user']->id;
			$posting->save();

			// redirect
			Session::flash('message', 'Successfully created ride!');
			return Redirect::to('BookPostings');
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