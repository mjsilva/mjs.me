<div id="shrink_container">

	<div id="form_container">
		<fieldset>
			<?php echo Form::open(array('action' => Uri::create('auth/login'), "id" => "form_login")); ?>
			<p>
				<?php echo Form::label("Username<em>*</em>", "username"); ?>
				<?php echo Form::input("username", $validation->input('username')); ?>

			<div class="error"><?php echo $validation->errors("username"); ?></div>
			</p>

			<p>
				<?php echo Form::label("Password<em>*</em>", "password"); ?>
				<?php echo Form::password("password"); ?>

			<div class="error"><?php echo $validation->errors("password"); ?></div>
			</p>

		</fieldset>

		<div id="submit_container">
			<?php echo Form::submit("submit", "Submit"); ?>
		</div>
		<?php echo Form::close(); ?>
	</div>

</div>