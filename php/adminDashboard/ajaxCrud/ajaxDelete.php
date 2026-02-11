<?php
include_once('../adminLteCrud/db.php');

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $result = mysqli_query($conn, "DELETE FROM ajax_users WHERE id=$id");

    if ($result) {
        echo "success"; 
    } else {
        echo "error";
    }
}
exit();
?>