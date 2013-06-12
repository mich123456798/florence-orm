<?php
class Access extends Model{
	function Access(){
		$this->model = 'Access';
		$this->fields = array(
			$this->char('name',50,'Group'),
			$this->char('description',50,'Description'),
		);
		parent::Model();
	}
}
new Access();
?>