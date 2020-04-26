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
				<a class="site_load_button" data-url="genre_detail.php?genre_id=<?php echo $genre_key; ?>" href="#genre_detail.php?genre_id=<?php echo $genre_key; ?>"><h3><?php echo $genre; ?></h3></a>
			</div>
		</div>
	<?php } ?>
	<div class="cf"></div>
</div>

<script type="text/javascript">

	// load sites into div (enable crossplaying)
	$(function() {
		$('.site_load_button').click(function() {
			var link = $(this).data('url');
			$('.site_loader').load(link);
			event.preventDefault();
		});

		// load if url isset
		var url      = window.location.href;
		var urlsplit = url.split(".php#")[1];
		if (urlsplit) {
			$('.site_loader').load(urlsplit);
		}
	});

</script>
