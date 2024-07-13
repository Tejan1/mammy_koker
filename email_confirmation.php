<?php
session_start();
$code = $_POST["code"];
$email = $_SESSION["email"];

//database connection details requirements
// These are info needed to connect to the database
$databaseServerName = "";
$databaseUserName = "";
$databaseUserPassword = "";

//These code below is use to create connection to our users database
$connection = mysqli_connect($databaseServerName, $databaseUserName, $databaseUserPassword)

//the code below is use to check if we have successfull connected to the database
if (!$connection){
    die("Cannot connect to the database" . mysqli_connection _error);
 
 }else {
    $sql = "SELECT OTP FROM OTPHOLDER WHERE EMAIL =" . $email;

    $fetch_query = mysqli_query($connection, $sql);

    if ($fetch_query == $code){
        //take the data that has the primary key $email from the TEMPORAL_USER table to the user USER
        $sql = "SELECT * FROM TEMPORAL_USER WHERE EMAIL =" . $email;
        $query_result = mysqli_query($connection, $sql);
        //setting the user login details on the user table
        $putting_sql = "INSERT INTO USER VALUES(" . $query_result[0] .","$$query_result[1] .",". $$query_result[2] .","$$query_result[3] .","$$query_result[4] .","$$query_result[5] . ")";
        $query_result_2 = mysqli_query($connection, $putting_sql);
        //and redirect the user to the login page
        header('Location: https://mammy-koker/login.html');
        exit;
    } else {
        echo "invalid one time code";
        //redirect you to the email confirmation page so that you can confirm your email
        header('Location: https://mammy-koker/email_confirmation.html');
        exit;
    }

 }
?>