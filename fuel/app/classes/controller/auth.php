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

		$val = Validation::factory();

		$val->add('username', 'Username')->add_rule("required")->add_rule(array("username_exists" => function($value)
		                                                                  { return !count(Model_Users::get_user(array("username" => $value))); }));

		$val->add('password', 'Password')->add_rule("required");

		$val->add('confirm_password', 'Confirm Password')
				->add_rule("required")
				->add_rule(array("match_password" => function($value)
				           { return ($value === Input::post('password')); }));

		$val->add('email', 'Email')->add_rule("valid_email")->add_rule(array("email_exists" => function($value)
		                                                               { return !count(Model_Users::get_user(array("email" => $value))); }));

		$val->set_message('confirm_password', 'Password fields does not match.');
		$val->set_message('username_exists', 'Someone beat you, that username already exists.');
		$val->set_message('email_exists', 'Someone beat you, that email already exists.');

		if ( $val->run() )
		{

			if ( Auth::instance('derpauth')->create_user($val->validated("username"), $val->validated("password"), $val->validated("email")) )
			{
				Session::set_flash("message", "Successfully registered you can now login.");
				Response::redirect(\Fuel\Core\Uri::base());
			}
			else
			{
				throw new Exception('An unexpected error occurred.' .
				                    ' Please try again.');
			}
		}
		else
		{

			$view = View::factory('register');
			$view->set("validation", $val, false);

			$this->template->set("title", "Shrink your huge URL");
			$this->template->set("content", $view, false);

		}
	}

	public function action_login()
	{
		$val = Validation::factory();

		$val->add('username', 'Username')->add_rule("required");
		$val->add('password', 'Password')->add_rule("required")
				->add_rule(array("valid_user" => array($this, "_callback_valid_user")));

		$val->set_message('confirm_password', 'Password fields does not match.');
		$val->set_message('valid_user', 'Access Denied.');


		if ( $val->run() )
		{
			$this->template->set("title", "Shrink your huge URL");
			$this->template->set("content", "", false);

			//assign current cookie urls to user id
			$cookie_id = Cookie::get('cookie_id');

			if ( $cookie_id )
			{
				$user_id = Auth::instance()->get_user_id();
				Model_Users::assign_cookie_to_user_id($cookie_id, $user_id[1]);
				Cookie::delete('cookie_id');
			}

			Response::redirect(\Fuel\Core\Uri::base());

		}
		else
		{
			$view = View::factory('login');
			$view->set("validation", $val, false);

			$this->template->set("title", "Shrink your huge URL");
			$this->template->set("content", $view, false);
		}
	}

	public function action_logout()
	{
		Auth::instance('derpauth')->logout();
		Session::set_flash("message", "Successfully logged out.");
		Response::redirect(\Fuel\Core\Uri::base());
	}

	public function _callback_valid_user($password)
	{
		return Auth::instance()->login(Input::post('username'), $password);
	}
}