<?php
include 'adminLteCrud/db.php';
session_start();
$errors = [];

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == "") {
        $errors['email'] = "Email required!";
    }
    if ($password == "") {
        $errors['pass'] = "Password required!";
    }
    if (!empty($errors)) {
        $_SESSION["oldData"] = $_POST;
        $_SESSION["errors"] = $errors;
        header("Location:login.php");
    } else {
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
                    $errors['pass'] = "Email or Password invalid!";
                    $_SESSION["errors"] = $errors;
                    $_SESSION["oldData"] = $_POST;
                    // $_SESSION['authLogin'] = $wrongValue;
                    header('Location: login.php');
                    exit;
                }
            }
        } else {
            $errors['pass'] = " User not found. Please <span>Register</span>.";
            $_SESSION["errors"] = $errors;
            $_SESSION["oldData"] = $_POST;
            // $_SESSION['authLogin'] = $wrongUser;
            header('Location: login.php');
            exit;
        }
    }
}
