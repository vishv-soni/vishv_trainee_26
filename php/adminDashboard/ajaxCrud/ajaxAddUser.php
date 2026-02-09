<?php
include_once('../adminLteCrud/db.php');

$errors = [];

$first = $_POST['firstName'];
$last  = $_POST['lastName'];
$email = $_POST['email'];
// $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);
$pass = $_POST['password'];
$cpass = $_POST['confirmPassword'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$hobby = implode(",", $_POST['hobby']);

$imageName = $_FILES['profileImage']['name'];
$tmpName = $_FILES['profileImage']['tmp_name'];

move_uploaded_file($tmpName, "upload/" . $imageName);


if (empty($fname)) {
  $errors['firstName'] = "First name is required.";
}
if (empty($lname)) {
  $errors['lastName'] = "Last name is required.";
}
if (empty($address)) {
  $errors['address'] = "address is required.";
}
if (empty($email)) {
  $errors['email'] = "Email is required";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors['email'] = "Invalid email format.";
}
if (empty($phone)) {
  $errors['phone'] = "Phone is required";
} else if (!preg_match('/^[0-9]{10}+$/', $phone)) {
  $errors['phone'] = "Invalid Phone Number format.";
}
if (!isset($_POST['hobby']) || empty($_POST['hobby'])) {
  $errors['hobby'] = "please select at least one hobby.";
}
if (!isset($_POST['gender']) || empty($_POST['gender'])) {
  $errors['gender'] = "please select at least one gender.";
}
if (!isset($_POST['country']) || empty($_POST['country'])) {
  $errors['country'] = "please select at least one country.";
}
if ($_FILES['profileImage']['error'] === UPLOAD_ERR_NO_FILE) {
  $errors['pImg'] = " No file selected. The file field is required.";
}
// Check if email already exists
if (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE email='$email'")) > 0) {
  $errors['email'] = "Email already exists.";
}

// Validate password strength
if (!empty($pass)) {
  if (strlen($pass) < 8 || !preg_match("#[A-Z]+#", $pass) || !preg_match("#[a-z]+#", $pass) || !preg_match("#[0-9]+#", $pass) || !preg_match("/[\W]+/", $pass)) {
    $passwordErrors[] = "Password must be at least 8 characters long, 1 uppercase letter, 1 lowercase letter, 1 special character.";
  } else if (empty($cpass)) {
    $confirmPasswordError = "Confirm passwords is required!";
  } else if ($pass !== $cpass) {
    $confirmPasswordError = "Passwords do not match!";
  }
} else {
  $errors['password'] = "Password is required.";
}


$password = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO ajax_users 
(first_name,last_name,email,password,gender,hobby,country,address,phone,profile_image)
VALUES
('$first','$last','$email','$pass','$gender','$hobby','$country','$address', '$phone ', '$imageName')";

if (mysqli_query($conn, $sql)) {
  echo "<span style='color:green'>User added successfully</span>";
} else {
  echo "<span style='color:red'>Error!</span>";
}