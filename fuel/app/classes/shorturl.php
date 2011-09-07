<?php

abstract class ShortUrl {


	protected static $_instance = null;
	protected static $_config = array();
	protected static $safe_limit = 100;


	/**
	 * Creates a new instance for static use of the class.
	 *
	 * @return  Image_Driver
	 */
	protected static function instance()
	{
		if ( static::$_instance == null )
		{
			static::$_instance = static::factory(static::$_config);
		}
		return static::$_instance;
	}

	/**
	 * Creates a new instance of the image driver
	 *
	 * @param  array   $config
	 * @return Shorturl_Driver
	 */
	public static function factory($config = array())
	{
		!is_array($config) and $config = array();

		\Config::load('shorturl', 'shorturl');
		$config = array_merge(\Config::get('shorturl', array()), $config);

		$algorithm = ucfirst(!empty($config['driver']) ? $config['driver'] : 'short');

		$config['set'] = !empty($config['set']) ? $config['set'] : 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
		$config['fixed_length'] = !empty($config['fixed_length']) ? $config['fixed_length'] : 5;

		$class = 'Shorturl_' . $algorithm;
		if ( $algorithm == 'Driver' || !class_exists($class) )
		{
			throw new \Fuel_Exception('Driver ' . $algorithm . ' is not a valid driver for shortening url.');
		}
		
		$return = new $class($config);
		return $return;
	}

	public static function get_short_url()
	{
		$url = '';
		$safecnt = 0;

		do
		{
			$url = self::next($url);
			$safecnt++;
			
		} while ( Model_Url::short_url_exist($url) && $safecnt <= self::$safe_limit );

		return $url;
	}

	private static function next($last = '')
	{
		return static::instance()->next($last);
	}
}
