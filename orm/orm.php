<?php
include("db.php");

class Model{
	var $model = null;
	var $fields = array();
	var $rec_name = 'name';

	function Model(){
		$db = new Database_manager();
		$db = $db->Connexion();
		$this->Create_table($db);
	}

	function Create_table($db){
		try{
			$query = " CREATE TABLE ".$this->model." (id int NOT NULL AUTO_INCREMENT PRIMARY KEY,".$this->rec_name." varchar(64))";
			$prep = $db->prepare($query);
			$prep->execute();
			echo 'create table -->'.$this->model.'<br/>';
		}
		catch (Exception $e) {
 			echo 'Error : ',  $e->getMessage(), "<br/>";
		}

		foreach ($this->fields as $field){
			try{
				echo 'create fields -->'.$field[0].'<br/>';
				$prep_cret = $db->prepare($field[1]);
				$prep_cret->execute();
			}
			catch (Exception $e) {
 				echo 'Error : ',  $e->getMessage(), "<br/>";
			}
		}
		// $db->Close_connexion();
	}
	// function for the orm
	function get_name($model){
		$requete = "SELECT ".$this->rec_name." from ".$model."";
		$prep = $db->prepare($query);
		$prep->execute();
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
	function char($name,$size,$label,$isnull=NULL){
		//FUNCTION
		// function for create a char field in db
		//ARGS 
		//name: is the technical name of the table
		//size: is the size in db for a char
		//label is the name in the view
		$query = "ALTER TABLE ".$this->model." ADD ".$name." varchar(".$size.")";
		return Array('create '.$name,$query);
	}
	function int($name,$label,$isnull=NULL){
		//FUNCTION
		// function for create an integer field in db
		//ARGS 
		//name: is the technical name of the table
		//label is the name in the view
		$query = "ALTER TABLE ".$this->model." ADD ".$name." int";
		return Array($name,$query);
	}
	function datetime($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." datetime";
		return Array($name,$query);
	}
	function boolean($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." tinyint(1)";
		return Array($name,$query);
	}
	function text($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." text";
		return Array($name,$query);
	}
	function date($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." date";
		return Array($name,$query);
	}
	function time($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." time";
		return Array($name,$query);
	}
	function float($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." float";
		return Array($name,$query);
	}
	function files($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." binary";
		return Array($name,$query);
	}
	function m2o($name,$relation,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD (".$name." int,FOREIGN KEY (".$name.") REFERENCES ".$relation."(id))";
		return Array($name,$query);
	}
	function o2m($name,$relation,$rev_m2o,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$relation." ADD (".$rev_m2o." int,FOREIGN KEY (".$rev_m2o.") REFERENCES ".$this->model."(id))";
		return Array($name,$query);
	}
	function m2m($name,$relation,$name_table=""){
		if (!isset ($name_table)){
			$name_table = $this->model+"_"+$relation;
		}
		$query="CREATE TABLE ".$name_table."(
				first_id int,
				second_id int,
				FOREIGN KEY (first_id) REFERENCES ".$this->model."(id),
				FOREIGN KEY (second_id) REFERENCES ".$relation."(id)
		)";
		return Array($name,$query);
	}

}

?>