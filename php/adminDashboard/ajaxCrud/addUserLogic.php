<?php
include_once('../adminLteCrud/db.php');

$errors = [];

$first = trim($_POST['firstName']);
$last = trim($_POST['lastName']);
$email = trim($_POST['email']);
$pass = $_POST['password'];
$confirm = $_POST['confirmPassword'];
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$gender = $_POST['gender'] ?? '';
$country = $_POST['country'];
$hobby = isset($_POST['hobby']) ? implode(",", $_POST['hobby']) : '';

if(empty($first)) $errors['firstName'] = "First name required";
if($last == "") $errors['lastName'] = "Last name required";
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Valid email required";
if(strlen($pass) < 6) $errors['password'] = "Min 6 characters";
if($pass != $confirm) $errors['confirmPassword'] = "Password mismatch";
if($address == "") $errors['address'] = "Address required";
if($hobby == "") $errors['hobby'] = "Select hobby";
if($gender == "") $errors['gender'] = "Select gender";
if($country == "") $errors['country'] = "Select country";
if($phone == "") $errors['phone'] = "phone required";

if($_FILES['profileImage']['name'] == ""){
    $errors['profileImage'] = "Image required";
}


if(!empty($errors)){
    echo json_encode(["status"=>"error","errors"=>$errors]);
    exit;
}

$profileImage = time().$_FILES['profileImage']['name'];
move_uploaded_file($_FILES['profileImage']['tmp_name'],"upload/".$profileImage);

$hash = password_hash($pass, PASSWORD_DEFAULT);

mysqli_query($conn,"INSERT INTO ajax_users 
(first_name,last_name,email,password,profile_image,address,phone,gender,hobby,country)
VALUES('$first','$last','$email','$hash','$profileImage','$address','$phone','$gender', '$hobby','$country')");

echo json_encode(["status"=>"success","message"=>"Data inserted successfully"]);
