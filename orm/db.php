<?php


class Database_manager{
	var $db;
	var $user;
	var $password;
	var $host;

	function Database_manager(){
		$this->db = 'florence';
		$this->user='root';
		$this->password='root';
		$this->host='localhost';	
	}
	
	function Connexion(){
		mysql_connect($this->host, $this->user,$this->password) or die("erreur de connexion au serveur");
		mysql_select_db($this->db) or die("erreur de connexion a la base de donnees");
	}

	function Close_connexion(){
		mysql_close();
	}
}

?>