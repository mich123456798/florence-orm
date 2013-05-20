<?php
include("db.php");


class Model{
	var $name = null;
	var $fields = array();

	function Model(){
		$this->Create_table();
	}

	function Create_table(){
		$db = new Database_manager();
		$db->Connexion();
		$query = " CREATE TABLE ".$this->name." (id int NOT NULL AUTO_INCREMENT PRIMARY KEY,name varchar(68))";
		mysql_query($query);
		
		echo 'create table -->'.$this->name.'<br/>';

		foreach ($this->fields as $field){
			mysql_query($field);
			echo 'creation de champs <br/>';
		}

		$db->Close_connexion();
	}

	// all the fields
	function char($name,$size,$label){
		$query = "ALTER TABLE ".$this->name." ADD ".$name." varchar(".$size.")";
		return $query;
	}
	function int($name,$label){
		$query = "ALTER TABLE ".$this->name." ADD ".$name." int";
		return $query;
	}
	function datetime($name,$label){
		$query = "ALTER TABLE ".$this->name." ADD ".$name." datetime";
		return $query;
	}
	function date($name,$label){
		$query = "ALTER TABLE ".$this->name." ADD ".$name." date";
		return $query;
	}
	function time($name,$label){
		$query = "ALTER TABLE ".$this->name." ADD ".$name." time";
		return $query;
	}
	function float($name,$label){
		$query = "ALTER TABLE ".$this->name." ADD ".$name." float";
		return $query;
	}
	function files(){
		return;
	}
	function m2o(){
		return;
	}
	function o2m(){
		return;
	}
	function m2m(){
		return;
	}
}

?>