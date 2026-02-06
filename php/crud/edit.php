<?php
include_once('editLogic.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form method="post" enctype="multipart/form-data">

    First Name:
    <input type="text" name="first_name" value="<?= htmlspecialchars($data['first_name']) ?>"><br><br>

    Last Name:
    <input type="text" name="last_name" value="<?= htmlspecialchars($data['last_name']) ?>"><br><br>

    Email:
    <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>"><br><br>

    Password:
    <input type="password" name="password"><br><br>

    Confirm Password:
    <input type="password" name="cpass"><br><br>

    <!-- Profile Image -->
    Current Image:<br>
    <img src="uploads/<?= $data['profile_image'] ?>" width="80"><br><br>

    Change Image:
    <input type="file" name="profile_image"><br><br>

    Address:
    <textarea name="address"><?= htmlspecialchars($data['address']) ?></textarea><br><br>

    Phone:
    <input type="number" name="phone" value="<?= htmlspecialchars($data['phone']) ?>"><br><br>

    Gender:
    <input type="radio" name="gender" value="Male" <?= ($data['gender']=='Male')?'checked':'' ?>> Male
    <input type="radio" name="gender" value="Female" <?= ($data['gender']=='Female')?'checked':'' ?>> Female
    <br><br>

    Hobby:
    <?php $h = explode(',', $data['hobby']); ?>
    <input type="checkbox" name="hobby[]" value="Reading" <?= in_array('Reading',$h)?'checked':'' ?>> Reading
    <input type="checkbox" name="hobby[]" value="Music" <?= in_array('Music',$h)?'checked':'' ?>> Music
    <input type="checkbox" name="hobby[]" value="Sports" <?= in_array('Sports',$h)?'checked':'' ?>> Sports
    <br><br>

    Country:
    <select name="country">
        <option value="India" <?= ($data['country']=='India')?'selected':'' ?>>India</option>
        <option value="USA" <?= ($data['country']=='USA')?'selected':'' ?>>USA</option>
        <option value="UK" <?= ($data['country']=='UK')?'selected':'' ?>>UK</option>
    </select><br><br>

    <input type="submit" name="update" value="Update">

</form>
</body>
</html>
