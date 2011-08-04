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
		                                                                  { return !count(Model_Auth::get_user(array("username" => $value))); }));
		$val->add('password', 'Password')->add_rule("required");
		$val->add('confirm_password', 'Confirm Password')
				->add_rule("required")
				->add_rule(array("match_password" => function($value)
				           { return ($value === Input::post('password')); }));

		$val->add('email', 'Email')->add_rule("valid_email");

		$val->set_message('confirm_password', 'Password fields does not match.');
		$val->set_message('username_exists', 'Someone beat you, that username already exists.');

		if ( $val->run() )
		{

			Auth::instance('DerpAuth')->create_user(Input::post("username"), Input::post("password"), Input::post("email"));

			\Fuel\Core\Session::set_flash("message", "Successfully registered you can now login.");

			\Fuel\Core\Response::redirect(\Fuel\Core\Uri::base());
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
			// session start

			//assign current cookie urls to user id

			// get urls

			//redirect to home
		}
		else
		{
			$view = View::factory('login');
			$view->set("validation", $val, false);

			$this->template->set("title", "Shrink your huge URL");
			$this->template->set("content", $view, false);
		}
	}

	public function _callback_valid_user($password)
	{
		return Auth::instance('DerpAuth')->login(Input::post('username'), $password);
	}

	public function action_test()
	{
		echo "One: " . Auth::instance('DerpAuth')->hash_password("123456");
		echo "<br />";
		echo "Two: " . Auth::instance('DerpAuth')->hash_password("123456");
	}
}