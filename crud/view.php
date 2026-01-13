<?php include 'db.php'; ?>

<h2>User List</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Gender</th>
    <th>Hobby</th>
    <th>Country</th>
    <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM users");

while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><img src="uploads/<?= $row['profile_image'] ?>" width="50"></td>
    <td><?= $row['first_name'] ?></td>
    <td><?= $row['last_name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['gender'] ?></td>
    <td><?= $row['hobby'] ?></td>
    <td><?= $row['country'] ?></td>
    <td>
        <button><a href="edit.php?id=<?= $row['id'] ?>">Edit</a></button>
        <button><a href="delete.php?id=<?= $row['id'] ?>">Delete</a></button>
    </td>
</tr>
<?php } ?>
</table>

<a href="create.php">Add New</a>
