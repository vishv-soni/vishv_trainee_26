
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

    if (empty($fname) || empty($lname) || empty($email) || empty($pass)) {
        $generalErrors[] = "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $generalErrors[] = "Invalid email format.";
    }
    if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $generalErrors[] = "Invalid Phone Number format.";
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
        (first_name,last_name,email,password,profile_image,address,phone,gender,hobby,country)
        VALUES 
        ('$fname','$lname','$email','$password','$img_name','$address','$phone','$gender','$hobby','$country')";
        mysqli_query($conn, $sql);

        header("Location: view.php");
    } else {
        if (!empty($generalErrors)) {
            foreach ($generalErrors as $error) {
                $_SESSION['general_errors'] = $error;
            }
        }
        if (!empty($passwordErrors)) {
            foreach ($passwordErrors as $error) {
                $_SESSION['password_errors'] = $error;
            }
        }
        if (!empty($confirmPasswordError)) {
            $_SESSION['confirm_password_error'] = $confirmPasswordError;
        }
        header("Location: addUser.php");
        exit();
    }
}
