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
		$db = $db->Connexion();
		$query = " CREATE TABLE ".$this->model." (id int NOT NULL AUTO_INCREMENT PRIMARY KEY )";
		$prep = $db->prepare($query);
		$prep->execute();


		echo 'create table -->'.$this->model.'<br/>';

		foreach ($this->fields as $field){
			$prep_cret = $db->prepare($field);
			$prep_cret->execute();
		}
		// $db->Close_connexion();
	}
	// function for the orm
	function get_name($model){
		$requete = "SELECT name from ".$model."";
		return;
	}
	function search(){
		//return ids
		return;
	}
	function read(){
		return;
	}
	function browse(){
		//return dataset
		return;
	}
	function insert($uid,$vals){
		//vals is an array the key is the name of a columns in and the value is the value of the new records
		$insertStatement = $pdo->prepare('insert into mytable (name, age) values (:name, :age)');
		$pdo->beginTransaction();
		foreach($data as &$row) {
		  $pdo->execute($row);
		}
		$pdo->commit();
	}
	function update($uid,$ids,$vals){
		$insertStatement = $pdo->prepare('update set mytable (name, age) values (:name, :age)');
		$pdo->beginTransaction();
		foreach($data as &$row) {
		  $pdo->execute($row);
		}
		$pdo->commit();
	}

	// all the fields
	function char($name,$size,$label){
		//FUNCTION
		// function for create a char field in db
		//ARGS 
		//name: is the technical name of the table
		//size: is the size in db for a char
		//label is the name in the view
		$query = "ALTER TABLE ".$this->model." ADD ".$name." varchar(".$size.")";
		return $query;
	}
	function int($name,$label){
		//FUNCTION
		// function for create an integer field in db
		//ARGS 
		//name: is the technical name of the table
		//label is the name in the view
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
		$query = "ALTER TABLE ".$this->model." ADD (".$name." int,FOREIGN KEY (".$name.") REFERENCES ".$relation."(id))";
		return $query;
	}
	function o2m($name,$relation,$rev_m2o,$label){
		$query = "ALTER TABLE ".$relation." ADD (".$name." int,FOREIGN KEY (".$name.") REFERENCES ".$this->model."(id))";
		return $query;
	}
	function m2m($name,$relation,$name_table=""){
		// if $name_table
		$query="CREATE TABLE ";
		return;
	}

}

?>