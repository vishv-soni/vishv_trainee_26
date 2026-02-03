
<?php
include 'adminLteCrud/db.php';
session_start();

unset($_SESSION['password_errors']);
unset($_SESSION['confirm_password_error']);
unset($_SESSION['general_errors']);

if (isset($_POST['submit'])) {
    $fname   = trim($_POST['first_name']);
    $lname   = trim($_POST['last_name']);
    $email   = trim($_POST['email']);
    $pass    = $_POST['password'];
    $cpass   = $_POST['confirm_password'];
    $passwordErrors = [];
    $confirmPasswordError = '';
    $generalErrors = [];

    if (empty($fname)) {
        $generalErrors['firstName'] = "First name is required.";
    }
    if (empty($lname)) {
        $generalErrors['lastName'] = "Last name is required.";
    }
    if (empty($email)) {
        $generalErrors['email'] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $generalErrors['email'] = "Invalid email format.";
    }
    // Check if email already exists
    if (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE email='$email'")) > 0) {
        $generalErrors['email'] = "Email already exists.";
    }
    // Validate password strength
    if (empty($pass)) {
        $passwordErrors[] = "Password is required.";
    } else {
        // If the password is not empty, check individual constraints
        if (strlen($pass) < 8 || !preg_match("#[A-Z]+#", $pass) || !preg_match("#[a-z]+#", $pass) || !preg_match("#[0-9]+#", $pass) || !preg_match("/[\W]+/", $pass)) {
            $passwordErrors[] = "Password must be at least 8 characters long, 1 uppercase letter, 1 lowercase letter, 1 special character.";
        }
    }
     if (!empty($pass)) {
            if (empty($cpass)) {
                $confirmPasswordError = "Confirm passwords is required!";
            } else if ($pass !== $cpass) {
                $confirmPasswordError = "Passwords do not match!";
            }
        }
    if (empty($passwordErrors) && empty($confirmPasswordError) && empty($generalErrors)) {
        $password = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users 
        (first_name,last_name,email,password)
        VALUES 
        ('$fname','$lname','$email','$password')";

        $registerMsg = "Registered Successfullly!";
        $_SESSION['registerMsg'] = $registerMsg;
        mysqli_query($conn, $sql);
        header("Location: login.php");
        exit();
    } else {
         $_SESSION['errors'] = [
                'old' => $_POST,
                'general' => $generalErrors,
                'password' => $passwordErrors,
                'confirmPassword' => $confirmPasswordError
            ];

        header("Location: create.php");
        exit();
    }
}
