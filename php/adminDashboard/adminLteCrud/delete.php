​<?php
    require 'auth.php';
    include 'db.php';
    if (!isset($_GET['id'])) {
        header("Location: ../login.php");
    }
        $id = $_GET['id'];
        $result = mysqli_query($conn, "DELETE FROM users WHERE id=$id");
        if ($result) {
            if (isset($_SESSION['userId']) && $_SESSION['userId'] == $id) {
                session_unset();
                session_destroy();
                echo "<script>alert('Your account has been deleted. You are now logged out.'); window.location.href='../login.php';</script>";
                exit();
            } else {
                echo "<script>alert('Record deleted'); window.location.href='view.php';</script>";
                exit();
            }
            header("Location: view.php");
        } else {
            echo "Invalid item ID.";
        }
    
