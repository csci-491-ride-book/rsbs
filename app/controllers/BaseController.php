<?php

class BaseController extends Controller {

	public function __construct()
    {
		$this->beforeFilter(function() {
			include_once(base_path().'/vendor/jasig/phpcas/CAS.php');
			phpCAS::client(CAS_VERSION_2_0, 'websso.wwu.edu', 443, '/cas');
			//at the moment add the following line and comment out the two after that
			phpCAS::setNoCasServerValidation();
			//phpCAS::setCasServerCACert("CA_FILE.pem");
			//phpCAS::forceAuthentication();
			if (isset($_REQUEST['logout'])) {                
                            phpCAS::logout();
			}
                        
                        $current_user = User::firstOrCreate(array('user_name' => 'hamptom'));
                        if (!isset($current_user->email)) {
                            $current_user->email = $current_user->user_name . '@students.wwu.edu';
                            $current_user->save();
                        }
                        View::share('current_user', $current_user);
		});
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}