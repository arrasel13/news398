<?php

$hostname = "localhost";
$user = "root";
$pass = "root";
$dbname = "news98";

$conn = new mysqli($hostname , $user, $pass, $dbname);

if($conn -> connect_error){
    die($conn->error);
}else{
    // echo "Success";
}