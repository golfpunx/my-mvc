<?php 
class Bootstrap
{
	
	function __construct()
	{
		Session::init();
		$url = isset($_GET['url'])? $_GET['url'] : 'index';
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode("/", $url);

		if($url[0] == "error" ){
			$this->call_error('Errrr');
			return false;
		}

		$file = 'controllers/' . $url[0] . '.php';
		if(file_exists($file)){
			require $file;
		}else{
			$this->call_error('Errrr');
			return false;
		}
		//Init controller object
		$controller = new $url[0];
		$controller->loadModule($url[0]);

		//check value for method
		if(isset($url[2])){
			if(method_exists($controller, $url[1])){
				$controller->{$url[1]}($url[2]);
			}else{
				$this->call_error('Errrr');
				return false;
			}
		}else{
			if(isset($url[1])){
				if(method_exists($controller, $url[1])){
					$controller->{$url[1]}();
				}else{
					$this->call_error('Errrr');
					return false;	
				}
			}else{
				$controller->index();
			}
		}	
	}

	public function call_error($msg = null){
		require 'controllers/error.php';
		$controller = new Errors();
		$controller->index();	
	}
}
 ?>