<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'sso';

$mysqli = new mysqli($host, $user, $password, $db_name);

if(!$mysqli){
	echo 'koneksi gagal';
}