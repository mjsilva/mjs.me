<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mjsilva
 * Date: 11-07-2011
 * Time: 20:07
 * To change this template use File | Settings | File Templates.
 */

class Controller_Shortener extends Controller_Template {

	public function action_index()
	{
		$this->action_set_url();
	}

	public function action_set_url()
	{

		if ( !Auth::check() )
		{
			$cookie_id = Cookie::get('cookie_id');

			if ( empty($cookie_id) )
			{
				$cookie_id = uniqid();
				Cookie::set('cookie_id', $cookie_id, 60 * 60 * 24 * 360 * 10);
			}
		}


		$val = \Validation::factory();

		$val->add('url', 'URL')
				->add_rule("required")
				->add_rule("trim")
				->add_rule("valid_url")
				->add_rule(array("valid_domain" => function($url)
				           {
					           return (strpos($url, Uri::base(), 0) === FALSE);
				           }));


		$val->set_message('valid_domain', 'This is already a mjs.me url.');
		$val->set_message('valid_url', 'What? This is not a valid URL, focus!');

		if ( $val->run() )
		{
			$short_url = ShortUrl::get_short_url();

			$user_id = \Auth\Auth::instance()->get_user_id();
			$user_id = !isset($user_id[1]) ? null : $user_id[1];

			$db_data = array(
				"short_url" => $short_url,
				"real_url" => Input::post('url'),
				"creator_ip_address" => Input::real_ip(),
				"date_created" => Date::factory()->format("mysql"),
				"cookie_id" => Auth::check() ? : $cookie_id,
				"user_id" => $user_id
			);

			Model_Url::set_url($db_data);

			$short_url = Uri::base() . $short_url;

			if ( Input::is_ajax() )
			{
				$response = array(
					"short_link" => $short_url,
					"stats_link" => $short_url . "/stats",
					"long_link" => Input::post('url')
				);

				exit(json_encode($response));
			}
		}
		else
		{
			$errors = $val->show_errors();

			if ( !empty($errors) )
			{
				if ( Input::is_ajax() )
				{
					exit(json_encode(array("errors" => $errors)));
				}
			}
		}

		$view = View::factory('form');
		$view->set("validation", $val, false);

		if ( Auth::check() )
		{
			$user_id = Auth::instance()->get_user_id();
			$user_id = $user_id[1];

			$user_urls = Model_Url::get_short_urls(array("user_id" => $user_id), array("date_created" => "desc"));
		}
		else
		{
			$user_urls = Model_Url::get_short_urls(array("cookie_id" => $cookie_id), array("date_created" => "desc"));
		}

		$view->set("user_urls", $user_urls, false);


		$this->template->set("content", $view, false);
	}

	public function action_get_url($url)
	{
		$url = Model_Url::get_url($url);

		if ( !$url ) Request::show_404();

		$db_data = array(
			"short_url" => $url["short_url"],
			"ip_address" => Input::real_ip(),
			"date_created" => Date::factory()->format("mysql")
		);

		Model_Url::set_url_hit($db_data);

		Response::Redirect($url["real_url"]);
	}

	public function action_stats($url)
	{
		$url_db = Model_Url::get_url($url);

		if ( !$url_db ) Request::show_404();

		$url_hits = Model_Url::get_url_hits($url);

		$view = View::factory('stats');

		$chart_data = array();

		foreach ( $url_hits as $hist )
		{
			$ts = strtotime($hist["date_created"]);

			if ( empty($ts) ) throw new exception("Couldn't parse date: {$hist["date_created"]}");

			$month = Date::factory($ts)->format("%Y-%m");

			if ( !array_key_exists($month, $chart_data) )
			{
				$chart_data[$month] = 1;
			}
			else
			{
				$chart_data[$month] += 1;
			}
		}

		$view->set("chart_data", $chart_data, false);
		$view->set("short_url", Config::get("base_url") . $url);
		$view->set("real_url", $url_db["real_url"]);

		$this->template->set("content", $view, false);

		$this->response->body = $view;
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_404()
	{
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
		$data['title'] = $messages[array_rand($messages)];

		// Set a HTTP 404 output header
		$this->response->status = 404;
		$this->template->set("content", View::factory('404', $data), false);
	}

}