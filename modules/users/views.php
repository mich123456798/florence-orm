<?php
class Views extends Model{
	function Views(){
		$this->model = 'Views';
		$this->fields = array(
			$this->char('name',50,'Group'),
			$this->char('description',50,'Description'),
			$this->char('type',50,'Type'),
			$this->text('views','Views'),
		);
		parent::Model();
	}
}
new Views();
?>