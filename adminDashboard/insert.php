
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

    if (empty($fname) || empty($lname) || empty($email) || empty($pass)) {
        $generalErrors[] = "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $generalErrors[] = "Invalid email format.";
    }
    // Check if email already exists
    if (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE email='$email'")) > 0) {
        $generalErrors[] = "Email already exists.";
    }
    // Validate password strength
    if (empty($pass)) {
        $passwordErrors[] = "Password is required.";
    } else {
        // If the password is not empty, check individual constraints
        if (strlen($pass) < 8) {
            $passwordErrors[] = "Password must be at least 8 characters long.";
        }
        if (!preg_match("#[A-Z]+#", $pass)) {
            $passwordErrors[] = "Password must contain at least 1 uppercase letter.";
        }
        if (!preg_match("#[a-z]+#", $pass)) {
            $passwordErrors[] = "Password must contain at least 1 lowercase letter.";
        }
        if (!preg_match("#[0-9]+#", $pass)) {
            $passwordErrors[] = "Password must contain at least 1 number.";
        }
        if (!preg_match("/[\W]+/", $pass)) {
            $passwordErrors[] = "Password must contain at least 1 special character.";
        }
    }
    if (empty($passwordErrors) && !empty($pass) && !empty($cpass)) {
        if ($pass !== $cpass) {
            $confirmPasswordError = "Passwords do not match!";
        }
    }
    if (empty($passwordErrors) && empty($confirmPasswordError) && empty($generalErrors)) {
        $password = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users 
        (first_name,last_name,email,password)
        VALUES 
        ('$fname','$lname','$email','$password')";

        mysqli_query($conn, $sql);
        header("Location: login.php");
        exit();
        
    } else {
        if (!empty($generalErrors)) {
            $error = implode(" ", $generalErrors);
            $_SESSION['general_errors'] = $error;
        }

        if (!empty($passwordErrors)) {
            foreach ($passwordErrors as $error) {
                $_SESSION['password_errors'] = $error;
            }
        }
        if (!empty($confirmPasswordError)) {
            $_SESSION['confirm_password_error'] = $confirmPasswordError;
        }

        header("Location: create.php");
        exit();
    }
}
