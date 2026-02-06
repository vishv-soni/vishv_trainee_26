<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['userId'])){
    ?>
                <script>
                    window.location.href = "../login.php";
                </script>
            <?php
    //  header("Location: ../login.php");
     exit();
}