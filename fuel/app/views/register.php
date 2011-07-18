<?php echo Asset::js('jquery.jgrowl_minimized.js'); ?>
<?php echo Asset::css('jquery.jgrowl.css'); ?>
<div id="shrink_container">
	<div id="register_container">
		<p>
			<?php echo Form::label("Username", "username"); ?>
			<?php echo Form::input("username", "Username"); ?>
		</p>

		<p>
			<?php echo Form::label("Password", "password"); ?>
			<?php echo Form::input("password", "password"); ?>
		</p>

		<p>
			<?php echo Form::label("Confirm Password", "confirm_password"); ?>
			<?php echo Form::input("confirm_password", "confirm_password"); ?>
		</p>
	</div>
</div>