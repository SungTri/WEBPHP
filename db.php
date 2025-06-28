<?php
$servername = "sql303.infinityfree.com";
$username = "if0_38526321";
$password = "ltfUCyQxoP5Hfw";
$dbname = "if0_38526321_Webbanquanaonam";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>