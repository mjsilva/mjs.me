<?php echo Asset::js('jquery.zclip.min.js'); ?>
<?php echo Asset::js('shrinkForm.js'); ?>
<?php echo Asset::css('jquery.jgrowl.css'); ?>
<div id="shrink_container">

	<div id="actions_container">
		<?php
		  if ( !Auth::check()
	):
		// user is not authenticated
		echo Html::anchor("auth/login", "login");
		if ( Model_Options::get("public")
		) :
			// if site is open to public allow registering
			echo " | ";
			echo Html::anchor("auth/register", "register");
		endif;
	else:
		echo "<span style='float:left;'>Quite fancy to seeing you <strong>" . \Auth\Auth::instance("derpauth")->get_screen_name() . "</strong>!</span>";
		echo Html::anchor("auth/profile", "profile");
		echo " | ";
		echo Html::anchor("auth/logout", "logout");
	endif;
		?>
	</div>

	<?php if ( Model_Options::get("public") OR Auth::check() ): ?>
	<div id="url_container">
		<?php echo Form::open(array('action' => Uri::create('set_url'), "id" => "shortener_form")); ?>
		<div id="">
			<?php echo Form::input('url', $validation->input('url'), array("id" => "url_input", "title" => "Paste your long url")); ?>
			<?php echo Form::submit('submit', 'Shrink', array("id" => "url_submit")); ?>
		</div>

		<div id="form_options">
			<?php if ( Auth::check() ): ?>
			<div id="options_toggle" class="fake_link hidden">More Options</div>
			<div id="options_elements">
				<?php echo \Fuel\Core\Form::label("Custom: ", "algorithm")?>
				<?php echo \Fuel\Core\Form::input("custom_shorturl", null, array("title" => "Insert your custom short url")); ?>

				<?php echo \Fuel\Core\Form::label("Algorithm: ", "algorithm")?>
				<?php echo \Fuel\Core\Form::select("algorithm", $validation->input('algorithm', 'short'), array("short" => "Shortest", "fixed" => "Fixed")); ?>
				<?php echo \Fuel\Core\Form::label("Size: ", "fixed_size")?>
				<?php echo \Fuel\Core\Form::input("fixed_size", $validation->input('fixed_size', Model_Options::get("shorturl_fixed_length")), array(
				                                                                                          "title" => "Short link size",
				                                                                                          "maxlength" => 3,
				                                                                                          "size" => 2)); ?>
			</div>
			<?php endif; ?>
		</div>
		<?php echo Form::close(); ?>
	</div>
	<?php else: ?>
	<?php echo Model_Options::get("private_message") ?>
	<?php endif; ?>

	<div id="shortened" style="display: <?php echo (empty($user_urls)) ? "none" : "block"?>">
		<div id="shortened_table_hd" class="clearfix">
			<strong class="short_link_hd">Short Link</strong>
			<strong class="stats_link_hd">Stats</strong>
			<strong class="real_link_hd">Long Link</strong>
		</div>
		<div id="shortened_results_ct">
			<ul id="shortened_results">
				<?php if ( !empty($user_urls) ) foreach ( $user_urls as $url ): ?>
				<li class="link_details clearfix">
					<div class="short_link_ct clearfix">
						<a class="short_link" href="<?php echo \Fuel\Core\Uri::base() . $url["short_url"] ?>">
							<?php echo  \Fuel\Core\Uri::base() . $url["short_url"] ?>
						</a>
						<span class="clippy">
							<a class="copy_bto" title="Copy short link to clipboard" href="#" data-short_link="<?php echo \Fuel\Core\Uri::base() . $url["short_url"] ?>">Copy</a>
						</span>
					</div>
					<a class="stats_link" href="<?php echo \Fuel\Core\Uri::base() . $url["short_url"] . "/stats" ?>">
						Stats
					</a>
					<a class="long_link" href="<?php echo $url["real_url"] ?>"><?php echo $url["real_url"] ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>