<?php
$conn = mysqli_connect("localhost", "root", "admin123", "al_crud_demo");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

