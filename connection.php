<?php

header("Content-Type: application/json; charset=UTF-8");

$connect = mysqli_connect("localhost", "root", "","content_stc"); 


if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}


?>