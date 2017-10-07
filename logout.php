<?php

require_once'app/init.php';
$auth = new GoogleAuth();
$auth->logout();
session_destroy();
header('Location: index.php');