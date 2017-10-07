<?php
session_start();
// Extend cookie life time by an amount of your liking
$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
setcookie(session_name(),session_id(),time()+$cookieLifetime);
require_once 'vendor/autoload.php';
require_once 'classes/DB.php';
require_once 'classes/GoogleAuth.php';
