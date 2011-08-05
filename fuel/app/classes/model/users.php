<?php

Class Model_Users {

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

	public static function assign_cookie_to_user_id($cookie_id, $user_id)
	{
		DB::update("urls")->value("user_id", $user_id)->where("cookie_id", $cookie_id)->execute();
		DB::update("urls")->value("cookie_id", null)->where("user_id", $user_id)->execute();
	}
}