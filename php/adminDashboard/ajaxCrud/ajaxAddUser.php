<?php
include_once('../adminLteCrud/db.php');

$errors = [];

$first = $_POST['firstName'];
$last  = $_POST['lastName'];
$email = $_POST['email'];
$pass = $_POST['password'];
$cpass = $_POST['confirmPassword'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$hobby = implode(",", $_POST['hobby']);

if ($_FILES['profileImage']['error'] === UPLOAD_ERR_NO_FILE) {
  // If no new file is uploaded, retain the old image
  if (isset($_POST['id'])) {
    // Fetch the old image name from the database if updating
    $id = $_POST['id'];
    $result = mysqli_query($conn, "SELECT profile_image FROM ajax_users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $imageName = $row['profile_image'];  // Use the existing image name
  }
} else {
  // If a new file is uploaded, move it to the server
  $imageName = $_FILES['profileImage']['name'];
  $tmpName = $_FILES['profileImage']['tmp_name'];
  move_uploaded_file($tmpName, "upload/" . $imageName);
}


if (empty($first)) {
  $errors['firstName'] = "First name is required.";
}
if (empty($last)) {
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
    $errors['pass'] = "Password must be at least 8 characters long, 1 uppercase letter, 1 lowercase letter, 1 special character.";
  } else if (empty($cpass)) {
    $errors['cpass'] = "Confirm passwords is required!";
  } else if ($pass !== $cpass) {
    $errors['cpass'] = "Passwords do not match!";
  }
} else {
  $errors['pass'] = "Password is required.";
}

$password = password_hash($pass, PASSWORD_DEFAULT);

if (isset($_POST['id']) && !empty($_POST['id'])) {
  // Update
  $id = $_POST['id'];

  $sql = "UPDATE ajax_users SET first_name='$first', last_name='$last', email='$email', password='$pass', gender='$gender', hobby='$hobby', country='$country', address='$address', phone='$phone', profile_image='$imageName' WHERE id=$id";

  if (mysqli_query($conn, $sql)) {

    $updatedUser = [
      'id' => $id,
      'firstName' => $first,
      'lastName' => $last,
      'email' => $email,
      'phone' => $phone,
      'gender' => $gender,
      'hobby' => $hobby,
      'country' => $country,
      'address' => $address,
      'profileImage' => $imageName,
    ];

    echo json_encode(['success' => true, 'type' => 'update', 'user' => $updatedUser]);
  } else {
    echo json_encode(['success' => false, 'message' => "Error updating user: " . mysqli_error($conn)]);
  }
  exit();
} else {
  // Insert
  $sql = "INSERT INTO ajax_users (first_name, last_name, email, password, gender, hobby, country, address, phone, profile_image) VALUES ('$first', '$last', '$email', '$pass', '$gender', '$hobby', '$country', '$address', '$phone', '$imageName')";
  if (mysqli_query($conn, $sql)) {
    // Get the last inserted user data
    $lastId = mysqli_insert_id($conn);
    $newUser = [
      'id' => $lastId,
      'firstName' => $first,
      'lastName' => $last,
      'email' => $email,
      'phone' => $phone,
      'gender' => $gender,
      'hobby' => $hobby,
      'country' => $country,
      'address' => $address,
      'profileImage' => $imageName,
    ];
    echo json_encode(['success' => true, 'user' => $newUser]);
  } else {
    echo json_encode(['success' => false, 'message' => 'Error adding user: ' . mysqli_error($conn)]);
  }
}
