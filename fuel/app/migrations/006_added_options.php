<?php

namespace Fuel\Migrations;

class Added_options {

	function up()
	{
		\Fuel\Core\DB::insert('options')->set(array(
		                                           "option_name" => "shorturl_driver",
		                                           "option_value" => "short"
		                                      ))->execute();

		\Fuel\Core\DB::insert('options')->set(array(
		                                           "option_name" => "shorturl_set",
		                                           "option_value" => "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_"
		                                      ))->execute();

		\Fuel\Core\DB::insert('options')->set(array(
		                                           "option_name" => "shorturl_fixed_length",
		                                           "option_value" => "5"
		                                      ))->execute();
	}

	function down()
	{
		\Fuel\Core\DB::delete("options")->where("option_name", "shorturl_driver");
		\Fuel\Core\DB::delete("options")->where("option_name", "shorturl_set");
		\Fuel\Core\DB::delete("options")->where("option_name", "shorturl_fixed_length");
	}
}