<?php 
/**
* 
*/
class Login extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if(Session::get("loggedIn")) header('location: ' . URL .'dashboard');
		$this->view->render('login/index');
	}

	function run()
	{
		$this->model->run();
	}
}
 ?>