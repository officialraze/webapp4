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
$_SESSION['active'] 			= 'artists';
$_SESSION['active_meta_nav']	= 'discover';

$following_artists = "SELECT artists.* FROM `following_artist` following_artist
						LEFT JOIN `artist` artists ON artists.artist_id = following_artist.artist_id
						WHERE `user_id_link` = ".$_SESSION['user']['id'];

?>
<h3 class="short_title"><?php echo ARTISTS_FOLLOW; ?></h3>

<div class="artists_overview">
	<?php
	$no_data = TRUE;

	foreach ($pdo->query($following_artists) as $artist) {
		if (!empty($artist)) { ?>
			<a class="site_load_button" data-url="artist_detail.php?artist_id=<?php echo $artist['artist_id']; ?>" href="#artist_detail.php?artist_id=<?php echo $artist['artist_id']; ?>">
				<div class="artist_box">
					<img src="img/artists/artist_<?php echo $artist['user_id'];?>.jpg">
					<h3 class="artist_name"><?php echo htmlspecialchars($artist['artist_firstname']).' '.htmlspecialchars($artist['artist_lastname']); ?></h3>
				</div>
			</a>
		<?php }
		$no_data = FALSE;
	} ?>
</div>
<?php
if ($no_data == TRUE) {
	echo NO_DATA;
}
?>

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
