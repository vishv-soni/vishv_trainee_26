​<?php
    include 'db.php';
    include 'classes/Register.php';
    if (!isset($_GET['id'])) {
        header("Location: ../login.php");
    }
    $id = $_GET['id'];

    $register = new Register();
    $register->deleteUser($id);
    if ($register) {
        echo "<script>alert('Record deleted'); window.location.href='index.php';</script>";
        exit;
        // header("Location: index.php");
    }
