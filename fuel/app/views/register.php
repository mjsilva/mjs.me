<div id="shrink_container">

	<p class="text">By registering on mjs.me you can keep track of your links.</p>

	<p class="text">Fields marked with * are required.</p>

	<div id="form_container">
		<fieldset>
			<?php echo Form::open(array('action' => Uri::create('auth/register'), "id" => "form_register")); ?>
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

			<p>
				<?php echo Form::label("Confirm Password<em>*</em>", "confirm_password"); ?>
				<?php echo Form::password("confirm_password"); ?>

			<div class="error"><?php echo $validation->errors("confirm_password"); ?></div>
			</p>
		</fieldset>
		<fieldset class="email">
			<p class="text">Insert your email if you think you might lose your password :-)</p>

			<p>
				<?php echo Form::label("Email", "email"); ?>
				<?php echo Form::input("email", $validation->input('email')); ?>

			<div class="error"><?php echo $validation->errors("email"); ?></div>
			</p>
		</fieldset>

		<div id="submit_container">
			<?php echo Form::submit("submit", "Submit"); ?>
		</div>
		<?php echo Form::close(); ?>
	</div>

</div>