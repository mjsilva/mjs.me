<?php

namespace Fuel\Migrations;

class Create_url_tracking {

	function up()
	{
		\DBUtil::create_table('url_tracking', array(
		                                           'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
		                                           'short_url' => array('type' => 'varbinary', 'constraint' => 5),
		                                           'date_created' => array('type' => 'datetime'),
		                                           'ip_address' => array('type' => 'varchar', 'constraint' => 15),
		                                      ), array('id'), false, 'InnoDB', 'utf8_unicode_ci');
	}

	function down()
	{
		\DBUtil::drop_table('url_tracking');
	}
}