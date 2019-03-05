<?php
session_start();

if (!defined('IN_CRONLITE')) exit();

$my = isset($_GET['my']) ? $_GET['my'] : null;

$clientip = real_ip();

if (isset($_COOKIE["admin_token"])) {
    $islogin = 1;
}

