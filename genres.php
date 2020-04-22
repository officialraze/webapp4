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
$_SESSION['active']				= 'discover';
$_SESSION['active_meta_nav']	= 'genres';

?>

<h3 class="short_title"><?php echo GENRES; ?></h3>
<div class="genres_overview">
	<?php foreach ($config['genres'] as $genre_key => $genre) { ?>
		<div class="genre_box">
			<div class="genre_box_inner">
				<a href="genre_detail.php?genre_id=<?php echo $genre_key; ?>"><h3><?php echo $genre; ?></h3></a>
			</div>
		</div>
	<?php } ?>
	<div class="cf"></div>
</div>
