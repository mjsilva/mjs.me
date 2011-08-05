<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Manuel
 * Date: 05-08-2011
 * Time: 14:41
 * To change this template use File | Settings | File Templates.
 */

class Controller_Api extends Controller_Rest {

	public function get_url()
	{
		$api_key = \Fuel\Core\Input::get("api_key");
		$long_url = \Fuel\Core\Input::get("long_url");

		$user = Model_Users::get_user(array("api_key" => $api_key));

		if ( !count($user) ) $this->response();

		$user = $user[0];

		$short_url = ShortUrl::get_short_url();

		$db_data = array(
			"short_url" => $short_url,
			"real_url" => $long_url,
			"creator_ip_address" => Input::real_ip(),
			"date_created" => Date::factory()->format("mysql"),
			"user_id" => $user["id"]
		);

		Model_Url::set_url($db_data);
		$this->response(Uri::base() . $short_url);
	}

}
