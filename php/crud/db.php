<?php
$conn = mysqli_connect("localhost", "root", "admin123", "crud_demo");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

