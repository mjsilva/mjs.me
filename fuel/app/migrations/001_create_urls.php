<?php

namespace Fuel\Migrations;

class Create_urls {

	function up()
	{
		\DBUtil::create_table('urls', array(
		                                   'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
		                                   'short_url' => array('type' => 'varbinary', 'constraint' => 5),
		                                   'real_url' => array('type' => 'text', 'null' => true),
		                                   'date_created' => array('type' => 'datetime'),
		                                   'creator_ip_address' => array('type' => 'varchar', 'constraint' => 15),
		                                   'hits' => array('type' => 'int', 'constraint' => 100, 'default' => 0),
		                                   'date_last_hit' => array('type' => 'datetime', 'null' => true),
		                                   'legacy' => array('type' => 'tinyint', 'constraint' => 1, 'default' => 0),
		                                   'cookie_id' => array('type' => 'varchar', 'constraint' => 100, 'null' => true),
		                                   'user_id' => array('type' => 'int', 'constraint' => 11, 'null' => true),
		                              ), array('id', 'short_url'), false, 'InnoDB', 'utf8_unicode_ci');
	}

	function down()
	{
		\DBUtil::drop_table('urls');
	}
}
 
