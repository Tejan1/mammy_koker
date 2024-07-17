<?php
session_start();
//getting login details entered
$email = $_POST["email"];
$password = $_POST["password"];
//$remember_me_flag = $_POST["remember_me"];


// These are info needed to connect to the database


$databaseServerName = "localhost";
$databaseUserName = "root";
$databaseUserPassword = "";
$dbname = "mammy_koker";


//These code below is use to create connection to our users database

$connection = mysqli_connect($databaseServerName, $databaseUserName, $databaseUserPassword, $dbname);

//echo strval($connection);

//the code below is use to check if we have successfull connected to the database
if (!$connection){
    die("Cannot connect to the database" . mysqli_error);
 
 } else{

   //echo mysqli_query($connection, "SELECT * FROM credential");

    $sql = "SELECT EMAIL FROM credential WHERE EMAIL ='" . $email . "'";

    $fetch_query = mysqli_query($connection, $sql);
   
   
   
   // print $fetch_query;
    
    //trying to see if the user has credential already on the database 
    //echo $fetch_query;

    if ($fetch_query == ""){
      
      echo "no account found for this Email:" . $email;
      
    }

    if ($fetch_query != ""){
       
      $sql = "SELECT PASSWORD FROM credential WHERE EMAIL ='" . $email . "'";

      if (mysqli_query($connection, $sql) == $password){
         //the user login credential
         //checking if the user wants the device to remember his/her login details, so that the sign in process will be automatically done for them
          //Note: the system will only remember you for 30 days, after 30 days, you will need to login in again
          if ($remember_me_flag != ""){
            setcookie("email", $email, (30 * 86400), "/");
            setcookie("password", $password, (30 * 86400), "/");
        }

         $_SESSION["email"] = $email;

         //redirecting user to the personalized home page
         header('Location: https://mammykoker/home.html');
         exit;
          
         
        
      }
      else {
         echo "USER LOGIN PASSWORD IS INCORRECT";
      }
      

    }

    
 }
?>
