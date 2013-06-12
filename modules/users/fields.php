<?php
class Fields extends Model{
	function Fields(){
		$this->model = 'Fields';
		$this->fields = array(
			$this->char('name',50,'Group'),
			$this->char('description',50,'Description'),
		);
		parent::Model();
	}

}
new Fields();

?>