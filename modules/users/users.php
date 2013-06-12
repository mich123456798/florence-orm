<?php
class Users extends Model{
	function Users(){
		$this->model = 'Users';
		$this->rec_name='test';
		$this->fields = array(
			$this->char('name',50,'Users'),
			$this->char('password',50,'Password'),
			$this->int('numbers','Numbers'),
			$this->o2m('menu_ids','Menu','users_id','Menu'),
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
			$this->m2m('users_ids',"Users","Group_Users")
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