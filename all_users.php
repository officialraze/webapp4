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
$_SESSION['active']				= 'discover';
$_SESSION['active_meta_nav']	= 'all_users';

$all_users = "SELECT * FROM `users` WHERE id != ".$_SESSION['user']['id'];

?>

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
