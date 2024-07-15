<?php
session_start();
//getting login details entered
$email = $_POST["email"];
$password = $_POST["password"];
$remember_me_flag = $_POST["remember_me"];


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

    $sql = "SELECT EMAIL FROM credential WHERE EMAIL =" . $email;

    $fetch_query = mysqli_query($connection, $sql);
    
    //trying to see if the user has credential already on the database 
    echo $fetch_query;

    if ($fetch_query != ""){
      $sql = "SELECT PASSWORD FROM credential WHERE EMAIL =" . $email;

      if (mysqli_query($connection, $sql) == $password){
         //the user login credent
          ial is correct
         //redirecting user to the personalized home page
         $_SESSION["email"] = $email;

          //checking if the user wants the device to remember his/her login details, so that the sign in process will be automatically done for them
          //Note: the system will only remember you for 30 days, after 30 days, you will need to sign in again
          if ($remember_me_flag != ""){
              setcookie("email", $email, (30 * 86400), "/");
              setcookie("password", $password, (30 * 86400), "/");
          }
         
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
