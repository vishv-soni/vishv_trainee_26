 <form method="post">
    First Name: <input type="text" name="first_name" value="<?php echo $data['first_name']; ?>"><br><br>
    Last Name: <input type="text" name="last_name" value="<?php echo $data['last_name']; ?>"><br><br>
    Email: <input type="email" name="email" value="<?php echo $data['email']; ?>"><br><br>
    Password: <input type="password" name="password" value="<?php echo $data['password']; ?>"><br><br>
    Confirm Password: <input type="password" name="cpass" value="<?php echo $data['password']; ?>"><br><br>

    Address: <textarea name="address"><?php echo $data['address']; ?></textarea><br><br>
    Phone: <input type="number" name="phone" value="<?php echo $data['phone']; ?>"><br><br>

    Gender:
    <input type="radio" name="gender" value="Male" <?php if($data['gender']=="Male") echo "checked"; ?>>Male
    <input type="radio" name="gender" value="Female" <?php if($data['gender']=="Female") echo "checked"; ?>>Female<br><br>

    Hobby:
    <?php $h = explode(",", $data['hobby']); ?>
    <input type="checkbox" name="hobby[]" value="Reading" <?php if(in_array("Reading",$h)) echo "checked"; ?>>Reading
    <input type="checkbox" name="hobby[]" value="Music" <?php if(in_array("Music",$h)) echo "checked"; ?>>Music
    <input type="checkbox" name="hobby[]" value="Sports" <?php if(in_array("Sports",$h)) echo "checked"; ?>>Sports<br><br>

    Country:
    <select name="country">
        <option <?php if($data['country']=="India") echo "selected"; ?>>India</option>
        <option <?php if($data['country']=="USA") echo "selected"; ?>>USA</option>
        <option <?php if($data['country']=="UK") echo "selected"; ?>>UK</option>
    </select><br><br>

    <input type="submit" name="update" value="Update">
</form>

<?php
include 'db.php';
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if (isset($_POST['update'])) {
    $fname   = $_POST['first_name'];
    $lname   = $_POST['last_name'];
    $address = $_POST['address'];
    $phone   = $_POST['phone'];
    $gender  = $_POST['gender'];
    $hobby   = implode(",", $_POST['hobby']);
    $country = $_POST['country'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpass'];
    $email = $_POST['email'];

     if ($pass !== $cpass) {
        die("Password do not match!");
    }
    $password = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_query($conn, "UPDATE users SET 
        first_name='$fname',
        last_name='$lname',
        email='$email',
        password='$password',
        address='$address',
        phone='$phone',
        gender='$gender',
        hobby='$hobby',
        country='$country'
        WHERE id=$id");

    header("Location: view.php");
}
?>



