<?php
class Users extends Model{
	function Users(){
		$this->model = 'Users';
		$this->fields = array(
			$this->char('name',50,'Users'),
			$this->char('password',50,'Password'),
			$this->int('number','Number'),
			$this->o2m('menu_ids','Menu','user_id','Menu'),
		);
		parent::Model();
	}
}
new Users();

class Groups extends Model{
	function Groups(){
		$this->model = 'Groups';
		$this->fields = array(
			$this->char('name',50,'Group'),
			$this->char('description',50,'Description'),
		);
		parent::Model();
	}
}
new Groups();

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