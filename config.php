<?php
$host = "127.0.0.1";
$user = "root";    // change if needed
$pass = "";        // set your MySQL password
$db   = "daily_news_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>