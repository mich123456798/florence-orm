<?php
class Access extends Model{
	function Access(){
		$this->model = 'Access';
		$this->fields = array(
			$this->char('name',50,'Group'),
			$this->char('description',50,'Description'),
			$this->boolean('create_access','Create'),
			$this->boolean('read_access','Create'),
			$this->boolean('update_access','Create'),
			$this->boolean('delete_access','Create'),
		);
		parent::Model();
	}
}
new Access();
?>