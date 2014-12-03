<?php

class UserController extends BaseController
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function show($id)
    {
        $user = User::find($id);
        return View::make('users.show')->with('user', $user);
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
    }

    public function destroy($id)
    {
    }
}