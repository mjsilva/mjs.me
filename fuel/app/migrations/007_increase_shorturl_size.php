<?php

namespace Fuel\Migrations;

class Increase_shorturl_size {

	function up()
	{
		\Fuel\Core\DB::query('ALTER TABLE `urls` CHANGE `short_url` varbinary (200)');
	}

	function down()
	{
		\Fuel\Core\DB::query('ALTER TABLE `urls` CHANGE `short_url` varbinary (5)');
	}
}