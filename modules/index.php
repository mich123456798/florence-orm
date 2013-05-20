<?php
include("../orm/orm.php");

class Users extends Model{
	function Users(){
		$this->name = 'test coucou';
		echo $this->name;
	}
}
new Users();
?>