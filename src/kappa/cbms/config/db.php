<?php

$host = getenv('MYSQL_HOST');
$database = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');

$mysqli = new mysqli($host, $user, $password, $database);