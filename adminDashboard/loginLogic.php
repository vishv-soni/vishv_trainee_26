<?php
include 'adminLteCrud/db.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //feth user from db
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $user = mysqli_query($conn, $sql);

    if ($user->num_rows === 1) {
        while ($row = mysqli_fetch_assoc($user)) {
            //verify password
            if ($user && password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['userId'] = $row['id'];
                $_SESSION['userFname'] = $row['first_name'];
                $_SESSION['userLname'] = $row['last_name'];
                $_SESSION['userProfileImage'] = $row['profile_image'];
                header('Location: adminLteCrud/view.php');
                exit;
            } else {
                $wrongValue = "Invalid email or password.";
                $_SESSION['authLogin'] = $wrongValue;      
                header('Location: login.php');
                exit;
            }
        }
    } else {
        $wrongUser = "User not found. Please <span>Register</span>.";
        $_SESSION['authLogin'] = $wrongUser;
        header('Location: login.php');
        exit;
    }
}
