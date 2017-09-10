<?php 
/**
 *
 * A tiny Nonce generator with variable time-outs.
 * 
 * No database required.
 * Each Nonce has its own Salt.
 * 
 */
class NonceUtil {

	public static function generate() {
		$timeoutSeconds = 60;
		$salt = self::generateSalt();
		$time = time();
		$maxTime = $time + $timeoutSeconds;
		$nonce = $salt .  sha1( $salt . NONCE_KEY . $maxTime );

		require 'models/nonce_model.php';
		$mgrNonce = new Nonce_Model();
		$mgrNonce->create(array(
			"nonce" => $nonce,
			"age"   => $maxTime
		));

		return $nonce;
	}
	public static function check($nonce) {
		require 'models/nonce_model.php';
		$mgrNonce = new Nonce_Model();
		$result = $mgrNonce->nonceSingleList($nonce);
		if(isset($result)) return true;
		else return false;
	}

	public static function delete($nonce){
		$mgrNonce = new Nonce_Model();
		$mgrNonce->delete($nonce);
	}
	
	
	private static function generateSalt() {
		$length = 10;
		$chars='1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
		$ll = strlen($chars)-1;
		$o = '';
		while (strlen($o) < $length) {
			$o .= $chars[ rand(0, $ll) ];
		}
		return $o;
	}
	
	
}
