<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

return array(
	'active' => Config::get('environment'),

	Fuel::DEVELOPMENT => array(
		'type'			=> 'mysql',
		'connection'	=> array(
			'hostname'   => 'localhost',
			'database'   => 'dev.rks.bz2',
			'username'   => 'root',
			'password'   => 'passw0rd',
			'persistent' => false,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => false,
		'profiling'    => false,
	),

	Fuel::PRODUCTION => array(
		'type'			=> 'mysql',
		'connection'	=> array(
			'hostname'   => 'localhost',
			'database'   => '',
			'username'   => '',
			'password'   => '',
			'persistent' => false,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => false,
		'profiling'    => false,
	)
);

/* End of file db.php */