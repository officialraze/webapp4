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
$_SESSION['active']				= 'friends';
$_SESSION['active_meta_nav']	= 'discover';

// get linked friends
$friends_link = "SELECT * FROM `friends` Friends WHERE Friends.user_id = ".$_SESSION['user']['id'];

// prepare friends array
$get_friends = array();
foreach ($pdo->query($friends_link) as $friend) {
	$get_friends_data = "SELECT * FROM `users` User WHERE User.id = ".$friend['friends_id'];
	foreach ($pdo->query($get_friends_data) as $friend_data) {
		$get_friends[] = array(
			'id' => $friend_data['id'],
			'firstname' => $friend_data['firstname'],
			'lastname' => $friend_data['lastname'],
		);
	}
}

?>
<h3 class="short_title"><?php echo MY_FRIENDS; ?></h3>
<?php if (!empty($get_friends)) { ?>
	<div class="artists_overview">
		<?php foreach ($get_friends as $user) { ?>
			<a href="classes/class.user.php?action=friend_function&user_id=<?php echo $user['id']; ?>">
				<div class="artist_box">
					<img src="img/profiles/user_<?php echo $user['id'];?>.jpg">
					<h3 class="artist_name"><?php echo $user['firstname'].' '.$user['lastname']; ?></h3>
				</div>
			</a>
		<?php } ?>

	</div>
<?php } else {
	echo NO_DATA;
} ?>
