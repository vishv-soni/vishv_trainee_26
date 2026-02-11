<?php
include_once('../adminLteCrud/db.php');

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $query = "SELECT * FROM ajax_users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "User not found"]);
    }
}
exit();
?>
