<?php
include("../../orm/config.php");
include("../../orm/orm.php");


class Users extends Model{
	function Users(){
		$this->name = 'Users';
		$this->fields = array(
			$this->char('name',50,'Users'),
			$this->int('number','Number')
		);

		parent::Model();
	}
}
new Users();



class Menu extends Model{
	function Menu(){
		$this->name = 'Menu';
		$this->fields = array(
			$this->char('name',50,'Users'),
			$this->char('path',50,'Path')
		);

		parent::Model();
	}
}
new Menu();



?>