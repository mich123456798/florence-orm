<?php
include("db.php");


class Model{
	var $model = null;
	var $fields = array();
	var $name = null;

	function Model(){
		$this->Create_table();
	}

	function Create_table(){
		$db = new Database_manager();
		$db->Connexion();
		$query = " CREATE TABLE ".$this->model." (id int NOT NULL AUTO_INCREMENT PRIMARY KEY)";
		mysql_query($query);
		
		echo 'create table -->'.$this->model.'<br/>';

		foreach ($this->fields as $field){
			mysql_query($field);
			echo 'creation de champs <br/>';
		}

		$db->Close_connexion();
	}
	// function for the orm
	function get_name(){
		return;
	}
	function search(){
		return;
	}
	function read(){
		return;
	}
	function browse(){
		return;
	}
	function insert($uid,$value){
		return;
	}
	function update($uid,$ids,$value){
		return;
	}

	// all the fields
	function char($name,$size,$label){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." varchar(".$size.")";
		return $query;
	}
	function int($name,$label){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." int";
		return $query;
	}
	function datetime($name,$label){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." datetime";
		return $query;
	}
	function date($name,$label){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." date";
		return $query;
	}
	function time($name,$label){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." time";
		return $query;
	}
	function float($name,$label){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." float";
		return $query;
	}
	function files($name,$label){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." binary";
		return $query;
	}
	function m2o($name,$relation,$label){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." int,FOREIGN KEY (".$name.") REFERENCES ".$relation."(".$id.")";
		return $query;
	}
	function o2m($name,$relation,$rev_m2o,$label){
		$query = "ALTER TABLE ".$relation." ADD ".$name." int,FOREIGN KEY (".$name.") REFERENCES ".$this->model."(".$id.")";
		return $query;
	}
	function m2m(){
		return;
	}

}

?>