<?php
include 'db.php';
include 'classes/Register.php';

$re = new Register();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $register = $re->addRegister($_POST, $_FILES);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD</title>
</head>
<body>

<h2>Add User</h2>
<form method="post" enctype="multipart/form-data">
    First Name: <input type="text" name="first_name" required><br><br>
    Last Name: <input type="text" name="last_name" required><br><br>
    Email: <input type="email" name="email" requried><br><br>
    Password: <input type="password" name="password" required><br><br>
    Confirm Password: <input type="password" name="confirm_password" requried><br><br>

    Profile Image: <input type="file" name="profile_image" ><br><br>

    Address: <textarea name="address"></textarea><br><br>
    Phone: <input type="number" name="phone"><br><br>

    Gender:
    <input type="radio" name="gender" value="Male">Male
    <input type="radio" name="gender" value="Female">Female<br><br>

    Hobby:
    <input type="checkbox" name="hobby[]" value="Reading">Reading
    <input type="checkbox" name="hobby[]" value="Music">Music
    <input type="checkbox" name="hobby[]" value="Sports">Sports<br><br>

    Country:
    <select name="country">
        <option>India</option>
        <option>USA</option>
        <option>UK</option>
    </select><br><br>

    <input type="submit" name="submit" value="Save">
</form>
<a href="index.php">View Users</a>

</body>
</html>
