<?php
session_start();
$code1 = $_POST["digit1"];
$code2 = $_POST["digit2"];
$code3 = $_POST["digit3"];
$code4 = $_POST["digit4"];
$code5 = $_POST["digit5"];
$code = strval($code1) . strval($code2) . strval($code3) . strval($code4) , strval($code5);
//$code = $_POST["code"];
$email = $_SESSION["email"];

// These are info needed to connect to the database
$databaseServerName = "localhost";
$databaseUserName = "root";
$databaseUserPassword = "";
$dbname = "mammy_koker";


//These code below is use to create connection to our users database
$connection = mysqli_connect($databaseServerName, $databaseUserName, $databaseUserPassword)

//the code below is use to check if we have successfull connected to the database
if (!$connection){
    die("Cannot connect to the database" . mysqli_connection _error);
 
 }else {
    $sql = "SELECT OTP FROM otpholder WHERE EMAIL ='" . $email . "'";

    $fetch_query = mysqli_query($connection, $sql);

    if ($code == $fetch_query){
        //take the data that has the primary key $email from the TEMPORAL_USER table to the user USER
        $sql = "SELECT * FROM temporal_use WHERE EMAIL ='" . $email . "'";
        $query_result = mysqli_query($connection, $sql);

        //setting the user login details on the user table
        $putting_sql = "INSERT INTO user (EMAIL, FIRSTNAME,LASTNAME, USERNAME, BIO, PASSWORD, PROFILEPIC, PHONE) VALUES('" . $query_result[0] ."','"$query_result[1] ."','". $query_result[2] ."', '"$query_result[3] ."', '"$query_result[4] ."',"$query_result[5] . "', " . $query_result[6] . "', '"$query_result[7] . "')";
        $query_result_2 = mysqli_query($connection, $putting_sql);

        //and redirect the user to the login page
        if ($query_result_2){
            header('Location: login.html');
            exit;
        }
        
        
        
        
        
    } else {
        echo "invalid one time code";
        //redirect you to the email confirmation page so that you can confirm your email
        header('Location: confirmationCode.html');
        exit;
    }

 }
?>
