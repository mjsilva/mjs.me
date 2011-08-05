<?php

Class Model_Auth {

	public static function set_user($db_data)
	{
		return DB::insert('users')->set($db_data)->execute();
	}

	public static function get_user($where)
	{
		$query = DB::select("*")->from("users");
		foreach ( $where as $field => $value ) $query->where($field, $value);
		return $query->execute();
	}

}