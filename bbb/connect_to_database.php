<?php

$user = 'root';
$pass = '';
$db = 'bbb_database';

$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
echo "Test: Connected to db"; 