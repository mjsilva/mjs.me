<?php

namespace Fuel\Migrations;

class Default_options {

	function up()
	{
		\Fuel\Core\DB::insert('options')->set(array(
		                                           "option_name" => "public",
		                                           "option_value" => 1
		                                      ))->execute();

		\Fuel\Core\DB::insert('options')->set(array(
		                                           "option_name" => "site_name",
		                                           "option_value" => "mjs.me"
		                                      ))->execute();

		\Fuel\Core\DB::insert('options')->set(array(
		                                           "option_name" => "site_title",
		                                           "option_value" => "URL Shortener"
		                                      ))->execute();

		\Fuel\Core\DB::insert('options')->set(array(
		                                           "option_name" => "private_message",
		                                           "option_value" => 'This site is private.<br />Please login to insert urls.'
		                                      ))->execute();

		\Fuel\Core\DB::insert('options')->set(array(
		                                           "option_name" => "analytics_code",
		                                           "option_value" => null
		                                      ))->execute();
	}

	function down()
	{
		\Fuel\Core\DB::delete("options")->where("option_name", "public")->where("option_value", 1);
		\Fuel\Core\DB::delete("options")->where("option_name", "site_name")->where("option_value", "mjs.me");
		\Fuel\Core\DB::delete("options")->where("option_name", "site_title")->where("option_value", "URL Shortener");
		\Fuel\Core\DB::delete("options")->where("option_name", "private_message")->where("option_value", "This site is private.<br />Please login to insert urls.");
		\Fuel\Core\DB::delete("options")->where("option_name", "analytics_code")->where("option_value", null);
	}
}