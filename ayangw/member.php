<?php

if (!defined('IN_CRONLITE')) exit();

$my = isset($_GET['my']) ? $_GET['my'] : null;

$clientip = real_ip();
$islogin = 1;
if (isset($_COOKIE["admin_token"])) {
    $islogin = 1;
}

