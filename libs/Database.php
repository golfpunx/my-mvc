<?php 
class Database extends PDO {
	private static $instance = null;
	public static function getInstance($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS){
		if(self::$instance == null){
			self::$instance = new Database($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
		}
		return self::$instance;
	}

	function __construct ($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS){
		parent::__construct($DB_TYPE . ":host=" . $DB_HOST . ";charset=utf8;dbname=" . $DB_NAME, $DB_USER, $DB_PASS);
	}

	function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC){
		$stm = $this->prepare($sql);
		foreach ($array as $key => $value) {
			$stm->bindValue($key, $value);
		}
		$stm->execute();
		return $stm->fetchAll($fetchMode);
	}

	function insert($table, $data){
		ksort($data);
		$fieldNames  = implode('`,`', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		$stm = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
		foreach ($data as $key => $value) {
			$stm->bindValue(':'.$key, $value);
		}
		$stm->execute();
		//echo $stm->rowCount();
	}

	function insertUpdate($table, $data){
		ksort($data);
		$fieldNames  = implode('`,`', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		$filedUpdate = "";
		foreach ($data as $key => $value) {
			$fieldUpdate .= " $key = :$key,";
		}
		$fieldUpdate = rtrim($fieldUpdate, ",");
		$myfile = fopen("newfile2.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $fieldUpdate);
		fclose($myfile);
		$stm = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues) ON DUPLICATE KEY UPDATE $fieldUpdate");
		foreach ($data as $key => $value) {
			$stm->bindValue(':'.$key, $value);
		}
		$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		fwrite($myfile, print_r($stm, true));
		fclose($myfile);
		$stm->execute();
	}

	function update($table, $data, $where){
		ksort($data);
		$fieldDetails = NULL;
		foreach ($data as $key => $value) {
			$fieldDetails .= "$key = :$key, ";
		}
		$fieldDetails = rtrim($fieldDetails, ', ');
		$stm = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
		foreach ($data as $key => $value) {
			$stm->bindValue(':'.$key, $value);
		}
		$stm->execute();	
		//echo $stm->rowCount();
	}

	public function delete($table, $where, $limit = 1){
		return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
	}
}

?>