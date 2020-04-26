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
$_SESSION['active'] 			= 'my_songs';
$_SESSION['active_meta_nav']	= 'discover';

if (isset($_GET['genre_id']) && $_GET['genre_id'] != 0) {
	$genre_id = $_GET['genre_id'];
}

$genre_song_query = "SELECT * FROM `song` songs
					INNER JOIN `artist` artists ON artists.artist_id = songs.artist_id_link
					INNER JOIN `album` album ON album.album_id = songs.album_id_link
					WHERE `genre_id` = ".$genre_id;

?>
<a class="back_link site_load_button" data-url="genres.php" href="#genres.php"><?php echo BACK; ?></a>
<h3 class="short_title"><?php echo $config['genres'][$genre_id]; ?></h3>
<table class="saved_songs_list">
	<tbody>
		<?php
		$no_data = TRUE;

		foreach ($pdo->query($genre_song_query) as $genre_songs_data) {
			if (!empty($genre_songs_data)) {

				// check if song is liked
				$statement_song = $pdo->prepare("SELECT `song_id` FROM `saved_songs` WHERE `song_id` = :song_id");
				$statement_song->bindParam(':song_id', $genre_songs_data['song_id']);
				$statement_song->execute();

				if ($statement_song->rowCount() > 0) {
					$like_class = 'liked';
				}
				else {
					$like_class = '';
				}

				?>
				<tr>
					<td class="play"><span class="play_song_wrapper play_song_class" data-cover=<?php echo $genre_songs_data['path_to_image']; ?> data-artist_id=<?php echo $genre_songs_data['artist_id_link']; ?> data-album_id=<?php echo $genre_songs_data['album_id_link']; ?> data-song=<?php echo $genre_songs_data['song_id']; ?> data-song_name="<?php echo htmlspecialchars($genre_songs_data['song_name']);?>" data-artist_name="<?php echo htmlspecialchars($genre_songs_data['artist_firstname']).' '.htmlspecialchars($genre_songs_data['artist_lastname']); ?>">
							<img src="img/assets/play.svg" alt="Play" class="svg play_song">
						</span></td>
					<td class="song_name"><?php echo htmlspecialchars($genre_songs_data['song_name']); ?></td>
					<td class="artist_name"><a href="artist_detail.php?artist_id=<?php echo $genre_songs_data['artist_id']; ?>"><?php echo htmlspecialchars($genre_songs_data['artist_firstname']).' '.htmlspecialchars($genre_songs_data['artist_lastname']); ?></a></td>
					<td class="actions"><span class="like_wrapper like_song like <?php echo $like_class; ?>" data-song=<?php echo $genre_songs_data['song_id']; ?>><img src="img/assets/like.svg" alt="Like" class="svg"></span><img src="img/assets/show_more.svg" class="svg more" alt="show_more"></td>
					<td class="length"><?php echo $genre_songs_data['length']; ?></td>
				</tr>
		<?php
			}
			$no_data = FALSE;
		} ?>

	</tbody>
</table>
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