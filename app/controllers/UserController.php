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
        $ridesAsDriver = $user->ridesAsDriver;
        $ridesAsPassenger = $user->ridesAsPassenger;
        return View::make('users.show', array(
            'user' => $user,
            'ridesAsDriver' => $ridesAsDriver,
            'ridesAsPassenger' => $ridesAsPassenger));
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