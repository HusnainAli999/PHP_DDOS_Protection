<?php
$conn = new mysqli("localhost", "root", "", "ddos_database");

if (!$conn) {
    echo "Connection failed" . mysqli_connect_error();
    exit;
}
