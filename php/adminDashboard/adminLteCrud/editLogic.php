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

    if (empty($fname)) {
        $editGeneralErrors['firstName'] = "First name is required.";
    }
    if (empty($lname)) {
        $editGeneralErrors['lastName'] = "Last name is required.";
    }
    if (empty($address)) {
        $editGeneralErrors['address'] = "address is required.";
    }
    if (empty($email)) {
        $editGeneralErrors['email'] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $editGeneralErrors['email'] = "Invalid email format.";
    }
    if (!isset($_POST['hobby']) || empty($_POST['hobby'])) {
        $_SESSION["hobbies"]="hobbies";
        $editGeneralErrors['hobby'] = "please select at least one hobby.";
    }
    if (!isset($_POST['gender']) || empty($_POST['gender'])) {
        $editGeneralErrors['gender'] = "please select at least one gender.";
    }
    if (!isset($_POST['country']) || empty($_POST['country'])) {
        $editGeneralErrors['country'] = "please select at least one country.";
    }
    if (empty($phone)) {
        $editGeneralErrors['phone'] = "Phone is required";
    } else if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $editGeneralErrors['phone'] = "Invalid Phone Number format.";
    }
    if (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE email='$email' AND id != $id")) > 0) {
        $editGeneralErrors['email'] = "Email already exists.";
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
    //password validation
    if (!empty($pass)) {
        if (empty($cpass)) {
            $editConfirmPasswordError = "Confirm passwords is required!";
        } else if ($pass !== $cpass) {
            $editConfirmPasswordError = "Passwords do not match!";
        }
        if (strlen($pass) < 8 || !preg_match("#[A-Z]+#", $pass) || !preg_match("#[a-z]+#", $pass) || !preg_match("#[0-9]+#", $pass) || !preg_match("/[\W]+/", $pass)) {
            $editPasswordErrors[] = "Password must be at least 8 characters long, 1 uppercase letter, 1 lowercase letter, 1 special character.";
        }
        if (empty($editPasswordErrors) && empty($editConfirmPasswordError)) {
            $password = password_hash($pass, PASSWORD_DEFAULT);
            $query .= ", password='$password'";
        }
    }
    if (!empty($editPasswordErrors) || !empty($editConfirmPasswordError) || !empty($editGeneralErrors)) {
        $_SESSION['flash'] = [
            'editOld' => $_POST,
            'editGeneralError' => $editGeneralErrors,
            'editErrors' => [
                'password' => $editPasswordErrors,
                'confirmPassword' => $editConfirmPasswordError
            ]
        ];
         $_SESSION["hobbies"];
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
