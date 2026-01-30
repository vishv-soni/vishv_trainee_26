<?php
include_once('db.php');

$search = $_GET['search'] ?? '';
if ($search != '') {
    $search_safe = mysqli_real_escape_string($conn, $search);
    $sql = "SELECT * FROM users 
            WHERE first_name LIKE '%$search_safe%'
               OR last_name LIKE '%$search_safe%'
               OR email LIKE '%$search_safe%'
               OR country LIKE '%$search_safe%'";
} else {
    $sql = "SELECT * FROM users";
}

$result = mysqli_query($conn, $sql);
