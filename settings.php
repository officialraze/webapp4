<?php
session_start();
/*
// --------------------------
// Webprojekt 4.0
// Copyright Melvin Lauber & David Clausen
// --------------------------
*/

include 'includes/start.php';
include 'includes/check_login.php';

// unset session and set new active element
unset($_SESSION['active']);
$_SESSION['active'] 			= 'settings';
$_SESSION['active_meta_nav']	= 'discover';

?>
<div class="settings_change">
	<h2 class="settings"><?php echo SETTINGS_CHANGE; ?></h2>

	<div class="change_profile_image">
		<h3 class="settings"><?php echo CHANGE_IMAGE; ?></h3>
		<div class="current_image">
			<?php if (file_exists('img/profiles/user_'.$_SESSION['user']['id'].'.jpg')) { ?>
				<img src="img/profiles/user_<?php echo $_SESSION['user']['id'];?>.jpg" alt="user_image">
			<?php } else { ?>
				<img src="img/profiles/no_user_image.png" alt="no_user_image">
			<?php } ?>
			<div class="upload-btn-wrapper" style="top: 15px; left: 10px;">
				<form action="classes/class.user.php" method="post" enctype="multipart/form-data">
					<input accept="image/*" name="user_image" type="file" class="upload_user_image" id="user_image">
					<button class="btn with_icon"><img src="img/assets/image_upload.svg" class="music_icon svg" alt="<?php echo CHANGE_IMAGE; ?>"></button>
					<input type="hidden" value="true" name="upload_user_image_form"/>
			</div>
		</div>
		<input class="submit-button" type="submit" value="<?php echo SAVE; ?>" name="submit" id="submit"/>
		</form>
	</div>

	<div class="choose_colours">
		<h3 class="settings"><?php echo SWITCH_DARKMODE; ?></h3>
		<label class="switch">
		<input name="switch" type="checkbox" <?php echo ($_SESSION['user']['has_darkmode'] == 1) ? 'checked' : ''; ?>>
		<span class="slider round darkmode"></span>
		</label>
	</div>

	<form class="settings_form" action="classes/class.user.php" method="post">
		<h3 class="settings"><?php echo CHANGE_BASICS; ?></h3>
		<div class="change_username">
			<div class="settings_change_username">
				<input type="text" name="change_username" placeholder="<?php echo USERNAME; ?>">
			</div>
		</div>

		<div class="change_pw">
			<div class="settings_change_pw">
				<input type="password" name="change_pw" placeholder="<?php echo PASSWORD; ?>">
			</div>
		</div>

		<div class="change_email">
			<div class="settings_change_mail">
				<input type="text" name="change_mail" placeholder="<?php echo MAIL; ?>">
			</div>
		</div>

		<?php
		
			// prepare data
			$insta = $_SESSION['user']['insta'];
			$facebook = $_SESSION['user']['facebook'];

			// if artist -> social media
			if ($_SESSION['user']['is_artist'] == TRUE) { ?>
				<div class="insta">
					<div class="settings_insta_profile">
						<input type="text" name="change_insta" value="<?php echo (!empty($insta) ? $insta : ''); ?>" placeholder="Instagram">
					</div>
				</div>

				<div class="facebook">
					<div class="settings_facebook_profile">
						<input type="text" name="change_facebook" value="<?php echo (!empty($facebook) ? $facebook : ''); ?>" placeholder="Facebook">
					</div>
				</div>
		<?php } ?>

		<input class="button" type="submit" name="basic_settings_save" value="Speichern">
	</form>
</div>


	<!-- form for deleting account -->
<div class="delete_account_wrapper">
	<div id="delete_account_form" style="display:none;">
		<h2><?php echo DELETE_ACCOUNT; ?></h2>

		<div class="delete_info">
			<p><?php echo DELETE_INFORMATION; ?></p>
		</div>

		<form action="classes/class.user.php" method="post">
			<input type="text" name="password_deletion" placeholder="<?php echo PASSWORD; ?>">
			<input type="hidden" name="delete_user_id" value="<?php echo $_SESSION['user']['id'];?>">
			<a class="follow_button"  href="javascript:;" onclick="parentNode.submit();"><?php echo DELETE_ACCOUNT; ?></a>
		</form>
	</div>

	<!-- open form with fancybox -->
	<a data-fancybox data-src="#delete_account_form" href="javascript:;" class="button error"><?php echo DELETE_ACCOUNT;?></a>
</div>

<!-- todo in next version -->
<!-- <div class="language">
	<h2 class="settings"><?php echo LANGUAGE; ?></h2>
	<div class="choose_language">
		<select name="change_language">
		<option value="deutsch"><?php echo DEUTSCH; ?></option>
		<option value="english"><?php echo ENGLISH; ?></option>
		</select>
	</div>
</div> -->

<div class="logout">
	<h2 class="settings"><?php echo LOGOUT; ?></h2>
	<div class="logout_button">
	<a class="submit-button-logout" href="logout.php"><?php echo LOGOUT; ?></a>
</div>

<script type="text/javascript">

	$('.darkmode').click(function() {
		$('body').toggleClass('dark');

		if ($('input[name="switch"]:checked').length) {
			var switch_value = 0;
		}
		else {
			var switch_value = 1;
		}

		$.ajax({
			url: 'classes/class.user.php',
			type: "POST",
			data: {
				switch: switch_value,
			},
			success: function(response) {
				console.log(response);
			}
		});
	});

</script>
