<?php

namespace Fuel\Migrations;

class Create_users {

	function up()
	{
		\DBUtil::create_table('users', array(
		                                    'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
		                                    'username' => array('type' => 'varchar', 'constraint' => 50),
		                                    'password' => array('type' => 'varchar', 'constraint' => 255),
		                                    'email' => array('type' => 'varchar', 'constraint' => 255, 'null' => true),
		                                    'last_login' => array('type' => 'varchar', 'constraint' => 25, 'null' => true),
		                                    'login_hash' => array('type' => 'varchar', 'constraint' => 255, 'null' => true),
		                                    'profile_fields' => array('type' => 'text', 'null' => true),
		                                    'group' => array('type' => 'int', 'constraint' => 11, 'null' => true),
		                                    'api_key' => array('type' => 'varchar', 'constraint' => 255, 'null' => true),
		                               ), array('id'), false, 'InnoDB', 'utf8_unicode_ci');
	}

	function down()
	{
		\DBUtil::drop_table('users');
	}
}