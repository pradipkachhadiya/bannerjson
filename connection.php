<?php

header("Content-Type: application/json; charset=UTF-8");

$connect = mysqli_connect("localhost", "root", "vktCcPUTLaCxiqVPmvLw","content_stc"); 


if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
define('BASE_URL', 'http://49.12.47.116/');


?>
