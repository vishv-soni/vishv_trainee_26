
<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $fname   = trim($_POST['first_name']);
    $lname   = trim($_POST['last_name']);
    $email   = trim($_POST['email']);
    $pass    = $_POST['password'];
    $cpass   = $_POST['confirm_password'];
    $errors = [];

    if (empty($fname) || empty($lname) || empty($email) || empty($pass)) {
        die("All fields are required.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }
    if ($pass !== $cpass) {
        $errors[] = "Passwords do not match!";
    }
    if (strlen($pass) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if (!preg_match("#[A-Z]+#", $pass)) {
        $errors[] = "Password must contain at least 1 uppercase letter.";
    }
    if (!preg_match("#[a-z]+#", $pass)) {
        $errors[] = "Password must contain at least 1 lowercase letter.";
    }
    if (!preg_match("#[0-9]+#", $pass)) {
        $errors[] = "Password must contain at least 1 number.";
    }
    if (!preg_match("/[\W]+/", $pass)) {
        $errors[] = "Password must contain at least 1 special character.";
    }
    if (empty($errors)) {
        $password = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users 
        (first_name,last_name,email,password)
        VALUES 
        ('$fname','$lname','$email','$password')";

        mysqli_query($conn, $sql);
        header("Location: view.php");
    } else {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
