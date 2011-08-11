<div id="shrink_container">

	<p class="title">Edit your profile at will.</p>

	<div id="form_container">
		<?php echo Form::open(array('action' => Uri::create('auth/profile'), "id" => "form_profile")); ?>

		<fieldset style="border-bottom:none; ">
			<p class="sub_title">This fields cannot be changed</p>

			<p>
				<?php echo Form::label("Username", "profile_username"); ?>
				<?php echo Form::input("profile_username", $validation->input('profile_username', $user["username"]), array("readonly" => true, "class" => "field")); ?>
			</p>

			<p>
				<?php echo Form::label("Api Key", "profile_api_key"); ?>
				<?php echo Form::input("profile_api_key", $validation->input('profile_api_key', $user["api_key"]), array("readonly" => true, "class" => "field")); ?>
			</p>
		</fieldset>

		<fieldset>
			<p>
				<?php echo Form::label("Old Password", "old_password"); ?>
				<?php echo Form::password("old_password", $validation->input('old_password'), array("class" => "field")); ?>
			</p>
			<div class="error"><?php echo $validation->errors("old_password"); ?></div>

			<p>
				<?php echo Form::label("New Password", "new_password"); ?>
				<?php echo Form::password("new_password", $validation->input('new_password'), array("class" => "field")); ?>
			</p>
			<div class="error"><?php echo $validation->errors("new_password"); ?></div>


			<p>
				<?php echo Form::label("Confirm Password", "confirm_password"); ?>
				<?php echo Form::password("confirm_password", $validation->input('confirm_password'), array("class" => "field")); ?>
			</p>
			<div class="error"><?php echo $validation->errors("confirm_password"); ?></div>

		</fieldset>
		<fieldset class="email">
			<p>
				<?php echo Form::label("Email", "email"); ?>
				<?php echo Form::input("email", $validation->input('email', $user["email"])); ?>
			</p>
			<div class="error"><?php echo $validation->errors("email"); ?></div>
		</fieldset>

		<div id="submit_container">
			<?php echo Form::submit("submit", "Submit"); ?>
		</div>
		<?php echo Form::close(); ?>
	</div>

</div>