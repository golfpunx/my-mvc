<?php 
class Errors extends Controller
{	
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		$this->view->msg = "This page doesnt exit";
		$this->view->css = array('error/css/error.css');
		$this->view->render('error/index', 1);
	}
}

 ?>