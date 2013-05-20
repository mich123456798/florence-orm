<?php


class Database_manager{
	var $name;
	function Database_manager(){
		$this->db = '';
		$this->user='';
		$this->password='';
		$this->host='';	
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