​<?php
include 'db.php';
include 'classes/Register.php';
$id = $_GET['id'];

$register = new Register();
$register->deleteUser($id);
header("Location: index.php");