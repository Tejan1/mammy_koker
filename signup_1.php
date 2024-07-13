<?php
//reading data from the signup form
$email = $_POST["email"];
$FName = $_POST["FName"];
$Lname = $_POST["Lname"];
$phone = $_POST["phone"];
$bio = $_POST["bio"];
$password = $_POST["password"];

//$university = $_POST["university"];
//$major = $_POST["major"];

// These are info needed to connect to the database
$databaseServerName = "";
$databaseUserName = "";
$databaseUserPassword = "";

//These code below is use to create connection to our mammy koker database
$connection = mysqli_connect($databaseServerName, $databaseUserName, $databaseUserPassword)

//the code below is use to check if we have successfull connected to the database
if (!$connection){
    die("Cannot connect to the database" . mysqli_connection _error);
 
 } else{

    echo  "connected to database successfully";

    //setting the sql query to write on the TEMPORAL_USER table
    //the user credntials will be held at this table until the email is confirmed
    sql="INSERT INTO TEMPORAL_USER VALUES(" . $userFirsName .","$userLastName .",". $password .","$email .","$id .","$phonenumber .")";

    //attempting to write on the TEMPORAL_USER table
    if(mysqli_query($conn,$sql)){

        echo "new data insert into table successfully";
        //now we send a confirmation email to the user that will hold randomly generated five digits for email verification
        $receiverEmail = $email;

        $message = rand(10000, 99999);
        $mess = "Enter the numbers below to confirm Email";

        // send email
        $email_sent = mail($email,"Mammy Koker",$msg . $mess);

        if ($email_sent){

            //writing the otp and the email to a table for validation
            $sql_query = "INSERT INTO OTPHOLDER VALUES(" . $email . "," . $message . "," . date("h:m") .")";
            if (mysqli_query($conn, $sql_query)){
                //redirecting user to the enter email confirmation code page
                
                header('Location: https://mammy-koker/email-confirmation.html');
                exit;
            }else{
                echo "error saving otp or password";
            }
        }


    } else{
        echo "Error:" .$sql .mysqli_error($conn);
    }

    
 }


?>
