<?php
include_once('db.php');
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
