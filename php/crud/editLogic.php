<?php
include('db.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID not found");
}

/* Fetch old data */
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$data = mysqli_fetch_assoc($result);

/* Update */
if (isset($_POST['update'])) {

    $fname   = $_POST['first_name'];
    $lname   = $_POST['last_name'];
    $email   = $_POST['email'];
    $address = $_POST['address'];
    $phone   = $_POST['phone'];
    $gender  = $_POST['gender'];
    $hobby   = implode(',', $_POST['hobby'] ?? []);
    $country = $_POST['country'];

    /* Password */
    if (!empty($_POST['password'])) {
        if ($_POST['password'] !== $_POST['cpass']) {
            die("Password not match");
        }
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $password = $data['password']; // old password
    }

    /* Image logic */
    if (!empty($_FILES['profile_image']['name'])) {
        $img_name = time().'_'.$_FILES['profile_image']['name'];
        $tmp_name = $_FILES['profile_image']['tmp_name'];

        move_uploaded_file($tmp_name, "uploads/".$img_name);
    } else {
        $img_name = $data['profile_image']; // old image
    }

    $sql = "UPDATE users SET
        first_name='$fname',
        last_name='$lname',
        email='$email',
        password='$password',
        profile_image='$img_name',
        address='$address',
        phone='$phone',
        gender='$gender',
        hobby='$hobby',
        country='$country'
        WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: view.php");
    exit;
}
