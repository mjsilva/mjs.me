<?php
return array(
	'_root_' => 'shortener/set_url', // The default route
	'_404_' => 'shortener/404', // The main 404 route


	'set_url' => 'shortener/set_url',
	'(:any)/stats' => 'shortener/stats/$1',
	'(:any)' => 'shortener/get_url/$1',

	/**
	 * This is an example of a BASIC named route (used in reverse routing).
	 * The translated route MUST come first, and the 'name' element must come
	 * after it.
	 */
	// 'foo/bar' => array('welcome/foo', 'name' => 'foo'),
);