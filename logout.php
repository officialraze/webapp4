<?php
session_start();
/*
// --------------------------
// Webprojekt 4.0
// Copyright Melvin Lauber & David Clausen
// --------------------------
*/

// destroy session for logging out user
session_destroy();

// redirect to index (call login form)
header("Location: login.php?message=logout_true");
?>
