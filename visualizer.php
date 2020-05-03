<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Web Player | Visualizer</title>

    <!-- load jquery & session plugin -->
    <script src="addons/jquery.min.js" charset="utf-8"></script>
    <script src="addons/jquerysession.js" charset="utf-8"></script>
</head>
<body>

    <!-- setup content -->
    <a href="index.php" class="back">Zurück zur Seite</a>
    <button onclick="wave.play()">Play</button>
    <div id="chart-container" style="width: 100%; height: 100%;"></div>

    <!-- scripts -->
    <script src="js/audio-wave.js"></script>
    <script>
            song_id = jQuery.session.get('song_id');
            console.log(song_id);

            var wave = new CircularAudioWave(document.getElementById('chart-container'));
            wave.loadAudio('music/song_'+song_id+'.mp3');
    </script>
</body>
</html>