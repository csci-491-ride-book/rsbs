<?php

return array(
	'default' => array(

		/*
		|--------------------------------------------------------------------------
		| PHPCas Hostname
		|--------------------------------------------------------------------------
		|
		| Laravel uses a flexible driver-based system to handle authentication.
		| You are free to register your own drivers using the Auth::extend
		| method. Of course, a few great drivers are provided out of
		| box to handle basic authentication simply and easily.
		|
		| Exemple: 'cas.myuniv.edu'.
		|
		*/

		'cas_hostname' => 'websso.wwu.edu',

		/*
		|--------------------------------------------------------------------------
		| Authentication Username
		|--------------------------------------------------------------------------
		|
		| Here you may specify the database column that should be considered the
		| "username" for your users. Typically, this will either be "username"
		| or "email". Of course, you're free to change the value to anything.
		|
		*/

		'cas_proxy' => false,

		/*
		|--------------------------------------------------------------------------
		| Enable service to be proxied
		|--------------------------------------------------------------------------
		|
		| Example:
		| phpCAS::allowProxyChain(new CAS_ProxyChain(array(
		|                                 '/^https:\/\/app[0-9]\.example\.com\/rest\//',
		|                                 'http://client.example.com/'
		|                         )));
		| For the exemple above:
		|	'cas_service' => array('/^https:\/\/app[0-9]\.example\.com\/rest\//','http://client.example.com/'),
		*/

		'cas_service' => array(),

		/*
		|--------------------------------------------------------------------------
		| Authentication Password
		|--------------------------------------------------------------------------
		|
		| Here you may specify the database column that should be considered the
		| "password" for your users. Typically, this will be "password" but, 
		| again, you're free to change the value to anything you see fit.
		|
		*/

		'cas_port' => 443,

		/*
		|--------------------------------------------------------------------------
		| Authentication Model
		|--------------------------------------------------------------------------
		|
		| When using the "eloquent" authentication driver, you may specify the
		| model that should be considered the "User" model. This model will
		| be used to authenticate and load the users of your application.
		|
		*/

		'cas_uri' => '/cas',

		/*
		|--------------------------------------------------------------------------
		| Authentication Table
		|--------------------------------------------------------------------------
		|
		| When using the "fluent" authentication driver, the database table used
		| to load users may be specified here. This table will be used in by
		| the fluent query builder to authenticate and load your users.
		|
		*/

		'cas_validation' => '',
		'cas_cert' => '',
		'cas_login_url' => '',
		'cas_logout_url' => '',
	)
);
