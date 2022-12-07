<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cmaisvc";

$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);