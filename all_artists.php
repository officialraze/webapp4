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
$_SESSION['active_meta_nav']	= 'all_artists';

$all_artists = "SELECT * FROM `artist`";

?>
<h3 class="short_title"><?php echo ALL_ARTISTS; ?></h3>

<div class="artists_overview">
	<?php foreach ($pdo->query($all_artists) as $artist) {
	?>
	<a class="site_load_button" data-url="artist_detail.php?artist_id=<?php echo $artist['artist_id']; ?>" href="#artist_detail.php?artist_id=<?php echo $artist['artist_id']; ?>">
		<div class="artist_box">
			<img src="img/artists/artist_<?php echo $artist['artist_id'];?>.jpg">
			<h3 class="artist_name"><?php echo $artist['artist_firstname'].' '.$artist['artist_lastname']; ?></h3>
		</div>
	</a>
	<?php } ?>
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