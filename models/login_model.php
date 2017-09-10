<?php 
class Login_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function run(){
		$username = $_POST['user'];
		$pass = $_POST['pass'];

		$stm = $this->db->prepare("SELECT id, role, user, name FROM user WHERE user = :user AND pass = :pass");
		$stm->execute(array(
			':user' => $username,
			':pass' => Hash::create('sha1', $pass, HASH_PASSWORD_KEY)
		));
		$data = $stm->fetch();
		$count = $stm->rowCount();

		if($count > 0){
			Session::set('loggedIn', true);
			Session::set('role', $data['role']);
			Session::set('user', $data['user']);
			if(isset($data['name']))
				Session::set('echoName', $data['name']);
			else Session::set('echoName', $data['user']);
			if($data['role'] != 'default')
				header('location: ' . URL .'dashboard');
			else
				header('location: ' . URL .'listbillnote');
		}else{
			header('location: ' . URL .'login');
		}
	}
}
 ?>