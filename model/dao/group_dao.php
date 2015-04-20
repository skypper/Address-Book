<?php

class GroupDAO {

	public static function getGroups() {
	
	}
	
	public static function getGroupById($id);
	public static function getGroupByName($name);
	public static function addGroup(Group $group);
	public static function editGroup(Group $group);
	public static function getContacts($id);
	public static function getAllContacts($id);

}

?>
