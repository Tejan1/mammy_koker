<?php
session();
//reading data from the signup form
$email = $_POST["email"];
$FName = $_POST["first_name"];
$Lname = $_POST["last_name"];
$phone = $_POST["phone_number"];
$bio = $_POST["bio"];
$password = $_POST["password"];
$username = $_POST["username"];
$profilepic = $_FILES["profile_pic"];

//reading the date
$Fdate = date("h_m_s") . "_" . str_replace(".", "_", strval(round(date("s") / 60, 2)));


// These are info needed to connect to the database
$databaseServerName = "localhost";
$databaseUserName = "root";
$databaseUserPassword = "";
$dbname = "mammy_koker";


//setting the path for the image
$image_path = "assets/images/uploaded/";

//checking if the person selects a profile pic
if ($profilepic["name"] != ""){
    $name = $FName . "_" . $Lname . "_" . $Fdate . "." . substr($profilepic["type"], 6);
    //print $name;
    $profilepic_name = $name;
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $image_path . $name);
}

elseif($profilepic["name"] == ""){
    $profilepic_name = "placeholder.jpg";
    //print $profilepic_name;
    
}


//These code below is use to create connection to our users database

$connection = mysqli_connect($databaseServerName, $databaseUserName, $databaseUserPassword, $dbname);

//the code below is use to check if we have successfull connected to the database
if (!$connection){
    die("Cannot connect to the database" . mysqli_error);
 
 } else{

    //setting the sql query to write on the TEMPORAL_USER table
    //the user credntials will be held at this table until the email is confirmed

    $sql = "INSERT INTO temporal_use (EMAIL, FIRSTNAME, LASTNAME, USERNAME, BIO, PASSWORD, PROFILEPIC, PHONE)  VALUES ('" . $email . "', '" . $FName . "', '" . $Lname . "', '" . $username . "', '" . $bio . "', '" . $password . "', '" . $profilepic_name ."', " . $phone .')';
    //print $sql;
    //mysqli_autocommit($connection, FALSE);

    // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    //VALUES ('John', 'Doe', 'john@example.com')";
    

    //attempting to write on the TEMPORAL_USER table
    if (mysqli_query($connection,$sql)){
        //print "wrote on the table";
        $_SESSION["email" = $email;]

        

        //echo "new data insert into table successfully";
        //now we send a confirmation email to the user that will hold randomly generated five digits for email verification
        $receiverEmail = $email;

        $message = rand(10000, 99999);
        $mess = "Enter the numbers below to confirm Email\n";

        // send email
        $email_sent = mail($email,"Mammy Koker",$mess . strval($message));

        if ($email_sent){

            //writing the otp and the email to a table for validation
            $sql_query = "INSERT INTO otpholder (EMAIL, OTP)  VALUES ('" . $email . "', " . $message . ")";
            if (mysqli_query($connection, $sql_query)){
                //redirecting user to the enter email confirmation code page
                
                header('Location: confirmationCode.html');
                exit;
            }else{
                echo "error saving otp or password";
            }
        }


    } else{
        
        echo "Error:" . $sql . mysqli_error($connection);
    }

    
 }


?>
