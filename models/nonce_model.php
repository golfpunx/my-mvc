<?php 
 class Nonce_Model extends Model
 {
 	
 	public function __construct()
 	{
 		parent::__construct();  	
 	}

 	public function create($data){
 		$this->deleteAll();
 		$this->db->insert('nonce_store', $data);
 	}

 	public function deleteAll(){
 		$time = time();
 		$this->db->delete("nonce_store", "age <= $time", 120);
 	} 

 	public function delete($nonce){
 		$this->db->delete("nonce_store", "nonce = '$nonce'", 1);
 	}

 	public function nonceSingleList($nonce){
 		$result = $this->db->select('SELECT id FROM nonce_store WHERE nonce = :nonce', array(':nonce' => $nonce));
 		if(sizeof($result) > 0){
 			return $result[0];	
 		} 
 		return NULL;
 	}

 }