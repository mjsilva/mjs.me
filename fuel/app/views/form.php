<?php echo Asset::js('shrinkForm.js'); ?>
<div id="shrink_container">

	<div id="url_container">
		<?php echo Form::open(array('action' => Uri::create('set_url'), "id" => "shortener_form")); ?>
		<div id="url_input">
			<?php echo Form::input('url', $validation->input('url')); ?>
		</div>
		<div id="url_submit">
			<?php echo Form::submit('submit', 'Shrink'); ?>
		</div>
		<?php echo Form::close(); ?>
	</div>
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
						<a class="short_link" href="<?php echo Config::get("base_url") . $url["short_url"] ?>">
							<?php echo  Config::get("base_url") . $url["short_url"] ?>
						</a>
						<span class="clippy">
							<a class="copy_bto" href="#">Copy</a>
						</span>
					</div>
					<a class="stats_link" href="<?php echo Config::get("base_url") . $url["short_url"] . "/stats" ?>">
						Stats
					</a>
					<a class="long_link" href="<?php echo $url["real_url"] ?>"><?php echo $url["real_url"] ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>