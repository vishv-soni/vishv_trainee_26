<?php
require 'auth.php';
include 'db.php';

$id = $_GET['id'] ?? 0;
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));
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

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }
    if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        die("Invalid Phone Number format.");
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

    if (!empty($pass)) {
        if ($pass !== $cpass) {
            die("Password does not match!");
        }
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $query .= ", password='$password'";
    }

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

    $query .= " WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        session_start();
        $_SESSION['userProfileImage'] = $finalImg;
        $_SESSION['userFname'] = $fname;
        $_SESSION['userLname'] = $lname;

        header('Location: view.php');
        exit;
    }
}
include_once('./includes/header.php');
include_once('./includes/sidebar.php');
