<?php
session_start();
//getting login details entered
$email = $_POST["email"];
$password = $_POST["password"];


// These are info needed to connect to the database
$databaseServerName = "";
$databaseUserName = "";
$databaseUserPassword = "";

//These code below is use to create connection to our users database
$connection = mysqli_connect($databaseServerName, $databaseUserName, $databaseUserPassword)

//the code below is use to check if we have successfull connected to the database
if (!$connection){
    die("Cannot connect to the database" . mysqli_connection _error);
 
 } else{

    $sql = "SELECT EMAIL FROM CREDENTIAL WHERE EMAIL =" . $email;

    $fetch_query = mysqli_query($connection, $sql);
    
    //trying to see if the user has credential already on the database 
    echo $fetch_query;

    if ($fetch_query != ""){
      $sql = "SELECT PASSWORD FROM CREDENTIAL WHERE EMAIL =" . $email;

      if (mysqli_query($connection, $sql) == $password){
         //the user login credentyial is correct
         //redirecting user to the personalized home page
         $_SESSION["email"] = $email;
         
         header('Location: https://mammy-koker/home.html');
         exit;
      }else {
         echo "USER LOGIN PASSWORD IS INCORRECT";
      }else {
         echo "No account found for the user email";
      }

    }

    
 }
?>