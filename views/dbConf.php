<?php

$host = 'localhost';
$user = 'root';
$pass = 'osama';
$db = 'FitnessLab';

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die('connection was not established between database and server - ' . $con->connect_error);
}


?>