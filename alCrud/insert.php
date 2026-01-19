
<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $fname   = trim($_POST['first_name']);
    $lname   = trim($_POST['last_name']);
    $email   = trim($_POST['email']);
    $pass    = $_POST['password'];
    $cpass   = $_POST['confirm_password'];

     if (empty($fname) || empty($lname) || empty($email) || empty($pass)) {
        die("All fields are required.");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Invalid email format.");
    }
    

    if ($pass !== $cpass) {
        die("Password do not match!");
    }
    $password = password_hash($pass, PASSWORD_DEFAULT);

  
        $sql = "INSERT INTO users 
        (first_name,last_name,email,password)
        VALUES 
        ('$fname','$lname','$email','$password')";

    mysqli_query($conn, $sql);

    header("Location: view.php");
}

