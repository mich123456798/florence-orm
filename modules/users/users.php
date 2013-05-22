<?php
include("../../orm/config.php");
include("../../orm/orm.php");


class Users extends Model{
	function Users(){
		$this->model = 'Users';
		$this->fields = array(
			$this->char('name',50,'Users'),
			$this->int('number','Number'),
			$this->o2m('menu_ids','Menu','user_id','Menu'),
		);
		parent::Model();
	}
}
new Users();



class Menu extends Model{
	function Menu(){
		$this->model = 'Menu';
		$this->fields = array(
			$this->char('name',50,'Users'),
			$this->char('path',50,'Path'),
			$this->m2o('users_id','Users','Users'),
		);
		parent::Model();
	}
}
new Menu();



?>