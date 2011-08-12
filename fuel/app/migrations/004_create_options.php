<?php

namespace Fuel\Migrations;

class Create_options {

	function up()
	{
		\DBUtil::create_table('options', array(
		                                      'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
		                                      'option_name' => array('type' => 'varchar', 'constraint' => 255),
		                                      'option_value' => array('type' => 'text', 'null' => true),
		                                 ), array('id'), false, 'InnoDB', 'utf8_unicode_ci');
	}

	function down()
	{
		\DBUtil::drop_table('options');
	}
}