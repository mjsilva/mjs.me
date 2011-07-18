<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mjsilva
 * Date: 11-07-2011
 * Time: 20:07
 * To change this template use File | Settings | File Templates.
 */

class Controller_Auth extends Controller_Template {

	private static $salt_length = 15;

	public function action_register()
	{

		$val = \Validation::factory();

		$val->add('username', 'Username')->add_rule("required");
		$val->add('password', 'Password')->add_rule("required");
		$val->add('confirm_password', 'Confirm Password')
				->add_rule("required")
				->add_rule(array("match_password" => function($value)
		{ return ($value === Input::post('password')); }));

		$val->add('email', 'Email')->add_rule("valid_email");

		$val->set_message('confirm_password', 'Password fields does not match.');

		if ( $val->run() )
		{
			$db_data = array(
				"username" => $val->validated('username'),
				"password" => sha2(self::$salt . $val->validated('password')),
				"email" => $val->validated('email')
			);

			Auth_model::set_user($db_data);

			//Success
		}
		else
		{

			$view = View::factory('register');
			$view->set("validation", $val, false);

			$this->template->set("title", "Shrink your huge URL");
			$this->template->set("content", $view, false);

		}
	}

	private static function hash_me($phrase, &$salt = null)
	{
		$key = 'g@s%s#!$%&FDg$s+«sd==%&%$,.55232**';

		if ( $salt == '' )
		{
			$salt = substr(hash('sha512', uniqid(rand(), true) . $key . microtime()), 0, self::$salt_length);
		}
		else
		{
			$salt = substr($salt, 0, SALT_LENGTH);
		}
		return hash('sha512', $salt . $key . $phrase);
	}

}