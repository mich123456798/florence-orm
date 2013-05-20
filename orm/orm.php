<?php
include("db.php");


class Model{
	var $name;

	function Model(){
		$this->name = '';
		$this->Create_table();
	}


	function Create_table(){
		$db = new Database_manager();
		// $db->Connexion();
		$query = " CREATE TABLE ".$this->name." (First_Name char(50),";
		echo 'test '.$this->name;
		mysql_query($query);
		$db->Close_connexion();
	}
}

?>