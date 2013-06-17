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
		return $db;
	}

	function Create_table($db){
		$model_id = NULL;
		try{
			$query = " CREATE TABLE ".$this->model." (id int NOT NULL AUTO_INCREMENT PRIMARY KEY,".$this->rec_name." varchar(64))";
			$prep = $db->prepare($query);
			$test_model = $prep->execute();
			if (($this->model != 'Models') AND ($test_model ==1)){
				$model_id = $this->pooler('Models')->insert(1,$db,array(':name'=>$this->model));
				echo '<h2>create table -->'.$this->model.'</h2>';
			}
			if(($this->model == 'Models') AND ($test_model ==1)){
				$model_id =$this->insert(1,$db,array(':name'=>$this->model));
				echo '<h2>create table -->'.$this->model.'</h2>';
			}
		}
		catch (Exception $e) {
 			echo 'Error : ',  $e->getMessage(), "<br/>";
		}

		foreach ($this->fields as $field){
			try{
				$prep_cret = $db->prepare($field[1]);
				$test_field = $prep_cret->execute();

				if (($this->model != 'Fields') AND ($test_field ==1)){
					$this->pooler('Fields')->insert(1,$db,array(':name'=>$field[0],':type'=>$field[2],':model_id'=>$model_id));
					echo 'create fields -->'.$field[0].' in the table '.$this->model.'<br/>';
				}
				if (($this->model == 'Fields') AND ($test_field ==1)){
					$this->insert(1,$db,array(':name'=>$field[0],':type'=>$field[2],':model_id'=>$model_id));
					echo 'create fields -->'.$field[0].' in the table '.$this->model.'<br/>';
				}
			}
			catch (Exception $e) {
 				echo 'Error : ',  $e->getMessage(), "<br/>";
			}
		}
		// $db->Close_connexion();
	}
	
	// function for the orm
	function pooler($model){
		return New $model();
	}

	function get_id($uid,$db){
		return;
	}

	function get_name($uid,$db){
		$names = array();
		$requete = "SELECT ".$this->rec_name." from ".$this->model;
		$names = $db->query($requete);
		return $names;
	}
	function search($uid,$db,$domain){
		//return ids
		$ids = array();
		$requete = "SELECT id from ".$this->model." where".$domain;
		return $ids;
	}

	function read($uid,$db,$vals,$fields){
		return;
	}

	function browse($uid,$db,$ids){
		$ids = "(".implode(",", $ids).")";
		$requete_prepare_1=$db->prepare("SELECT * FROM ".$this->model.' where id in '.$ids); // on prépare notre requête
		$db->beginTransaction();
		$requete_prepare_1->execute();
		$browse = $requete_prepare_1->fetch(PDO::FETCH_OBJ);
		$db->commit();
		return $browse;
	}

	function insert($uid,$db,$vals){
		//vals is an array the key is the name of a columns in and the value is the value of the new records	
		$keys = array_keys($vals);
		$comma_separated = implode(",", $keys);
		$without_columns = str_replace( ":", "",$comma_separated);
		$prep = $db->prepare('insert into '.$this->model.' ('.$without_columns.') values ('.$comma_separated.')');
		//check the relations field m2m o2m to insert in other table
		// if o2m{
		// 	$prep = $db->prepare('insert into '.$relation.' ('.$rel_id.') values ('.$values.')');
		// }
		// if m2m{
		// 	$prep = $db->prepare('insert into '.$inter_table.' ('fields1,fields2') values ('.$id.','.$id_rel.')';
		// }
		$db->beginTransaction();
		$prep->execute($vals);
		$id =$db->commit();
		return $id;
	}
	function update($uid,$db,$ids,$vals){
		$ids = "(".implode(",", $ids).")";
		$keys = array_keys($vals);
		$values = array_values($vals);
		
		$comma_separated = implode(" = ?,", $keys);
		$comma_separated =$comma_separated .' = ?';
		$prep = $db->prepare('update '.$this->model.' set '.$comma_separated.' where id in '.$ids);
		$db->beginTransaction();
		$prep->execute($values);
		$db->commit();
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
		return Array($name,$query,'char');
	}
	function int($name,$label,$isnull=NULL){
		//FUNCTION
		// function for create an integer field in db
		//ARGS 
		//name: is the technical name of the table
		//label is the name in the view
		$query = "ALTER TABLE ".$this->model." ADD ".$name." int";
		return Array($name,$query,'int');
	}
	function datetime($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." datetime";
		return Array($name,$query,'datetime');
	}
	function boolean($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." tinyint(1)";
		return Array($name,$query,'boolean');
	}
	function text($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." text";
		return Array($name,$query,'text');
	}
	function date($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." date";
		return Array($name,$query,'date');
	}
	function time($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." time";
		return Array($name,$query,'time');
	}
	function float($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." float";
		return Array($name,$query,'float');
	}
	function files($name,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD ".$name." binary";
		return Array($name,$query,files);
	}
	function m2o($name,$relation,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$this->model." ADD (".$name." int,FOREIGN KEY (".$name.") REFERENCES ".$relation."(id))";
		return Array($name,$query,'m2o');
	}
	function o2m($name,$relation,$rev_m2o,$label,$isnull=NULL){
		$query = "ALTER TABLE ".$relation." ADD (".$rev_m2o." int,FOREIGN KEY (".$rev_m2o.") REFERENCES ".$this->model."(id))";
		return Array($name,$query,'o2m');
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
		return Array($name,$query,'m2m');
	}

}

?>