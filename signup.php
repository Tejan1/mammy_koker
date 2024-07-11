<?php

//reading data from the signup form
$email = $_POST["email"];
$FName = $_POST["FName"];
$Lname = $_POST["Lname"];
$phone = $_POST["phone"];
$bio = $_POST["bio"];
$password = $_POST["password"];
$university = $_POST["university"];
$major = $_POST["major"];

//setting the database access credentials

$dName = "mammy_koker";
$serverName = "localhost";
$databasePassword = "123456789";


//making a connection to the database
$conn = mysqli.connect($dName, $serverName, $databasePassword);
$cur = mysqli.query();



?>