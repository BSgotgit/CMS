<?php
$hostname = 'localhost';
$username = 'root';
$password = '1234';
$database = 'CMS';

$conn = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_errno()){
    printf('Failed to connect '.mysqli_connect_error());
}

