<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Manuel
 * Date: 07-09-2011
 * Time: 14:05
 * To change this template use File | Settings | File Templates.
 */

class Shorturl_Fixed {

	protected $_config = null;

	public function __construct($config)
	{
		$this->_config = $config;
	}

	public function next()
	{
		return self::get($this->_config["set"], $this->_config["fixed_length"]);
	}

	private static function get($set, $length)
	{
		$result = array();

		for ( $i = 0; $i < $length; $i++ )
		{
			$result[] = $set{rand(0, strlen($set) - 1)};
		}

		return implode($result);
	}
}
 
