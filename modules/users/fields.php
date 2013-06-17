<?php

class Models extends Model{
	function Models(){
		$this->model = 'Models';
		$this->fields = array(
			$this->char('name',50,'Model','NOT NULL'),
			$this->char('description',50,'Description'),
		);
		parent::Model();
	}
}
new Models();

class Fields extends Model{
	function Fields(){
		$this->model = 'Fields';
		$this->fields = array(
			$this->char('name',50,'Group'),
			$this->char('type',50,'type of fields'),
			$this->char('description',50,'Description'),
			$this->m2o('model_id','Models','Models'),
		);
		parent::Model();
	}
}
new Fields();
?>