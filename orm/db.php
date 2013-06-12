<?php


class Database_manager{
	var $db;
	var $user;
	var $password;
	var $host;

	function Database_manager(){
		$this->db = 'florence';
		$this->user='root';
		$this->password='steroids';
		$this->host='localhost';	
	}
	
	function Connexion(){
		try {
		  return new PDO("mysql:host=".$this->host.";dbname=".$this->db."", $this->user, $this->password);    
		}  
		catch(PDOException $e) {  
		    echo $e->getMessage();  
		}  
	}

	// function Close_connexion(){
		
	// }
}

?>