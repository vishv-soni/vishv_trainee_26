<?php
require 'auth.php';
include 'db.php';

$id = $_GET['id'] ?? 0;
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if (!$data) {
    die("User not found.");
}

$currentImg = $data['profile_image'];

if (isset($_POST['update'])) {
    $fname   = $_POST['first_name'];
    $lname   = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone   = $_POST['phone'];
    $gender  = $_POST['gender'];
    $hobby   = isset($_POST['hobby']) ? implode(",", $_POST['hobby']) : "";
    $country = $_POST['country'];
    $editPasswordErrors = [];
    $editConfirmPasswordError = '';
    $editGeneralErrors = [];

    if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $editGeneralErrors[] = "Invalid Phone Number format.";
    }
    // Validate password strength
    if (!empty($pass)) {
        // If the password is not empty, check individual constraints
        if (strlen($pass) < 8) {
            $editPasswordErrors[] = "Password must be at least 8 characters long.";
        }
        if (!preg_match("#[A-Z]+#", $pass)) {
            $editPasswordErrors[] = "Password must contain at least 1 uppercase letter.";
        }
        if (!preg_match("#[a-z]+#", $pass)) {
            $editPasswordErrors[] = "Password must contain at least 1 lowercase letter.";
        }
        if (!preg_match("#[0-9]+#", $pass)) {
            $editPasswordErrors[] = "Password must contain at least 1 number.";
        }
        if (!preg_match("/[\W]+/", $pass)) {
            $editPasswordErrors[] = "Password must contain at least 1 special character.";
        }
    }

    $query = "UPDATE users SET 
        first_name='$fname',
        last_name='$lname',
        email='$email',
        address='$address',
        phone='$phone',
        gender='$gender',
        hobby='$hobby',
        country='$country'";

    $finalImg = $currentImg; //default old image
    if (!empty($_FILES['profile_image']['name'])) {
        $img_name = $_FILES['profile_image']['name'];
        $tmp_name = $_FILES['profile_image']['tmp_name'];

        if (move_uploaded_file($tmp_name, "uploads/" . $img_name)) {
            $query .= ", profile_image='$img_name'";
            $finalImg = $img_name; //new image set
        } else {
            echo "Error uploading file.";
        }
    }

    if (empty($editPasswordErrors) && !empty($pass) && !empty($cpass)) {
        if ($pass !== $cpass) {
            $editConfirmPasswordError = "Passwords do not match!";
        }
    }
    if (empty($editPasswordErrors) && empty($editConfirmPasswordError) && empty($editGeneralErrors)) {
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $query .= ", password='$password'";
    } else {
        if (!empty($editGeneralErrors)) {
            foreach ($editGeneralErrors as $error) {
                $_SESSION['general_errors'] = $error;
            }
        }
        if (!empty($editPasswordErrors)) {
            foreach ($editPasswordErrors as $error) {
                $_SESSION['password_errors'] = $error;
            }
        }
        if (!empty($editConfirmPasswordError)) {
            $_SESSION['confirm_password_error'] = $editConfirmPasswordError;
        }
        $_SESSION['old'] = $_POST;
        header("Location: edit.php?id=" . $id);
        exit();
    }

    $query .= " WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // session_start();
        if (isset($_SESSION['userId']) && $_SESSION['userId'] == $id) {
            $_SESSION['userProfileImage'] = $finalImg;
            $_SESSION['userFname'] = $fname;
            $_SESSION['userLname'] = $lname;
        }
        header('Location: view.php');
        exit;
    }
}
