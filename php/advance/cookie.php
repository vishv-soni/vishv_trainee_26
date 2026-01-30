<?php

setcookie("username". "vishv", time() + (86400*30), "/");

if(isset($_COOKIE["username"])){
    echo "welcome";
}