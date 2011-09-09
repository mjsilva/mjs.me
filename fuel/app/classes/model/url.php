<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mjsilva
 * Date: 11-07-2011
 * Time: 20:16
 * To change this template use File | Settings | File Templates.
 */

class Model_Url {

	public static function short_url_exist($short_url)
	{
		$result = DB::select("*")->from('urls')->where("short_url", $short_url)->execute();
		return (count($result) > 0);
	}

	public static function get_last_short_url($exclude_legacy = TRUE)
	{
		$result = DB::select("short_url")->from('urls')->where("legacy", 0)->order_by("id", "desc")->limit(1)->execute()->current();
		return $result["short_url"];
	}

	public static function get_url($short_url)
	{
		$result = DB::select("*")->from('urls')->where("short_url", $short_url)->limit(1)->execute()->current();
		return $result;
	}

	public static function set_url($db_data)
	{
		return DB::insert('urls')->set($db_data)->execute();
	}

	public static function set_url_hit($db_data)
	{
		DB::insert('url_tracking')->set($db_data)->execute();
		$result = DB::select("hits")->from('urls')->where("short_url", $db_data["short_url"])->execute()->current();

		$hit_data = array(
			"hits" => $result["hits"] + 1,
			"date_last_hit" => Date::factory()->format("mysql")
		);

		DB::update("urls")->set($hit_data)->where("short_url", $db_data["short_url"])->execute();
	}

	public static function get_url_hits($url)
	{
		$result = DB::select("*")->from('url_tracking')->where("short_url", $url)->execute();
		return $result->as_array();
	}

	public static function get_short_urls($where = '', $order_by = '')
	{
		$query = DB::select("*");
		$query->from('urls');

		if ( !empty($where) && is_array($where) )
		{
			foreach ( $where as $field => $value )
			{
				$query->where($field, $value);
			}
		}

		if ( !empty($order_by) && is_array($order_by) )
		{
			foreach ( $order_by as $field => $order_type )
			{
				$query->order_by($field, $order_type);
			}
		}

		$results = $query->execute();

		return $results->as_array();

	}

	public static function get_shorturls()
	{
		$results = DB::select("short_url")->from('urls')->execute();
		$results = $results->as_array();
		foreach ( $results as $k => $v ) $flat_array[] = $v["short_url"];
		return $flat_array;
	}

}