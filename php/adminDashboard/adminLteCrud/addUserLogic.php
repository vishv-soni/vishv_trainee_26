
<?php
include 'db.php';
session_start();

unset($_SESSION['password_errors']);
unset($_SESSION['confirm_password_error']);

if (isset($_POST['submit'])) {
    $fname   = $_POST['first_name'];
    $lname   = $_POST['last_name'];
    $email   = $_POST['email'];
    $pass    = $_POST['password'];
    $cpass   = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone   = $_POST['phone'];
    $gender  = $_POST['gender'] ?? null;
    $hobby   = !empty($_POST["hobby"]) ? implode(",", $_POST['hobby']) : null;
    $country = $_POST['country'];
    $passwordErrors = [];
    $confirmPasswordError = '';
    $generalErrors = [];

    $img_name = $_FILES['profile_image']['name'];
    $tmp_name = $_FILES['profile_image']['tmp_name'];
    move_uploaded_file($tmp_name, "uploads/" . $img_name);

    if (empty($fname)) {
        $generalErrors['firstName'] = "First name is required.";
    }
    if (empty($lname)) {
        $generalErrors['lastName'] = "Last name is required.";
    }
    if (empty($address)) {
        $generalErrors['address'] = "address is required.";
    }
    if (empty($email)) {
        $generalErrors['email'] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $generalErrors['email'] = "Invalid email format.";
    }
    if (empty($phone)) {
        $generalErrors['phone'] = "Phone is required";
    } else if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $generalErrors['phone'] = "Invalid Phone Number format.";
    }
    if (!isset($_POST['hobby']) || empty($_POST['hobby'])) {
        $generalErrors['hobby'] = "please select at least one hobby.";
    }
    if (!isset($_POST['gender']) || empty($_POST['gender'])) {
        $generalErrors['gender'] = "please select at least one gender.";
    }
    if (!isset($_POST['country']) || empty($_POST['country'])) {
        $generalErrors['country'] = "please select at least one country.";
    }
    if ($_FILES['profile_image']['error'] === UPLOAD_ERR_NO_FILE) {
        $generalErrors['pImg'] = " No file selected. The file field is required.";
    }
    // Check if email already exists
    if (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE email='$email'")) > 0) {
        $generalErrors[] = "Email already exists.";
    }

    // Validate password strength
    if (!empty($pass)) {
        if (strlen($pass) < 8 || !preg_match("#[A-Z]+#", $pass) || !preg_match("#[a-z]+#", $pass) || !preg_match("#[0-9]+#", $pass) || !preg_match("/[\W]+/", $pass)) {
            $passwordErrors[] = "Password must be at least 8 characters long, 1 uppercase letter, 1 lowercase letter, 1 special character.";
        }else if (empty($cpass)) {
            $confirmPasswordError = "Confirm passwords is required!";
        } else if ($pass !== $cpass) {
            $confirmPasswordError = "Passwords do not match!";
        }
    } else {
         $passwordErrors[] = "Password is required.";
    }
    if (empty($passwordErrors) && empty($confirmPasswordError) && empty($generalErrors)) {
        $password = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users 
        (first_name,last_name,email,password,profile_image,address,phone,gender,hobby,country)
        VALUES 
        ('$fname','$lname','$email','$password','$img_name','$address','$phone','$gender','$hobby','$country')";
        mysqli_query($conn, $sql);

        header("Location: view.php");
        exit;
    } else {
        $_SESSION['errors'] = [
            'old' => $_POST,
            'general' => $generalErrors,
            'password' => $passwordErrors,
            'confirmPassword' => $confirmPasswordError
        ];
        header("Location: addUser.php");
        exit();
    }
}
