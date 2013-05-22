<?php
include("../../orm/config.php");
include("../../orm/orm.php");


class Users extends Model{
	function Users(){
		$this->name = 'users';
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
		$this->name = 'menu';
		$this->fields = array(
			$this->char('name',50,'Users'),
			$this->char('path',50,'Path'),
			$this->m2o('users_id','users','Users')
		);
		parent::Model();
	}
}
new Menu();



?>