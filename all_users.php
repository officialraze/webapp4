<?php
session_start();
/*
// --------------------------
// Webprojekt 3.0
// Copyright Melvin Lauber & David Clausen
// --------------------------
*/

include 'includes/start.php';
include 'includes/check_login.php';

// unset session and set new active element
unset($_SESSION['active']);
$_SESSION['active']				= 'discover';
$_SESSION['active_meta_nav']	= 'all_users';

$all_users = "SELECT * FROM `users` WHERE id != ".$_SESSION['user']['id'];

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Web Player | <?php echo ALL_USERS; ?></title>

		<?php include 'includes/meta_data.php'; ?>
	</head>

	<body class="<?php echo $body_class; ?>">
		<?php include 'includes/navigation_left.php'; ?>
		<?php include 'includes/cookie_banner.php'; ?>
		<div id="playbar_wrapper_loader"></div>

		<div class="main_content_wrapper">
			<div class="main_content_inner">
				<!-- search and main nav -->
				<?php include 'includes/search_navi.php'; ?>
				<h3 class="short_title"><?php echo ALL_USERS; ?></h3>

				<div class="artists_overview">
					<?php foreach ($pdo->query($all_users) as $user) { ?>
						<a href="classes/class.user.php?action=friend_function&user_id=<?php echo $user['id']; ?>">
							<div class="artist_box">
								<img src="img/profiles/user_<?php echo $user['id'];?>.jpg">
								<h3 class="artist_name"><?php echo $user['firstname'].' '.$user['lastname']; ?></h3>
							</div>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</body>
