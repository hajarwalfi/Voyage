<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'voyage';

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Error:" .mysqli_connect_error());
}
?>