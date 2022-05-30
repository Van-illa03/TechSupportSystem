<?php
    //database connection
$con=mysqli_connect("localhost","id19015714_techsupportadmin","rZf}z!K3@PZ^9Nt/","id19015714_techsupportsystem");
if (!$con){
        echo "failed to connect";
        die();
    }
    //session is used for saving global values and can be used on different webpages
    session_start();
    //unsetting the session for the next user
    unset($_SESSION['id']);


    //getting the values from the forms
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];
    $admincode = $_POST['ac'];
    $supportcode = $_POST['sc'];
    $FilteringResult = false;

    $codequery = mysqli_query($con,"SELECT * FROM codes");
    $getcodes = mysqli_fetch_assoc($codequery);


    //verification of email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=Invalid Email. Check the format.");
        exit();
    }


    //checking the user type and getting the account data of the user
    if ($usertype == "Intern") {
        $Filtering = mysqli_query($con,"SELECT * FROM internuser WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);
    }
    else if ($usertype == "Support Team") {
        $Filtering = mysqli_query($con,"SELECT * FROM supportteam WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);
    }
    else if ($usertype == "Administrator") {
        $Filtering = mysqli_query($con,"SELECT * FROM administrator WHERE Email='$email' LIMIT 1");
        $FilteringResult = mysqli_fetch_assoc($Filtering);
    }


    //verification of account
    if ($FilteringResult)  { //if there is a fetched account data in the database
        if ($FilteringResult['Password'] != $password) { //checking if the passwords matched
            header("Location: index.php?error=Incorrect Password.");
            exit();
        }
        else {
            if ($usertype == "Intern"){ //if user type is intern
                //setting the session variable to the unique id of the current user. This $_SESSION variable will be used althroughout the pages
                $_SESSION['id'] = $FilteringResult['UID'];
                header("location: internhomepage.php");
            }
            else if ($usertype == "Administrator") { //if user type is administrator
                if (isset($admincode)){
                    if ($getcodes['AdminCode'] == $admincode){ //checking if the inputted admin code is correct
                        //setting the session variable to the unique id of the current user. This $_SESSION variable will be used althroughout the pages
                        $_SESSION['id'] = $FilteringResult['UID'];
                        header("location: adminhomepage.php");
                    }
                    else {
                        header("Location: index.php?error=Incorrect Admin Code.");
                    }
            }

            }
            else if ($usertype == "Support Team") { //if usertype is support personnel
                if (isset($supportcode)){
                    if ($getcodes['SupportCode'] == $supportcode){ //checking if the inputted admin code is correct
                        //setting the session variable to the unique id of the current user. This $_SESSION variable will be used althroughout the pages
                        $_SESSION['id'] = $FilteringResult['UID'];
                        header("location: supporthomepage.php");
                    }
                    else {
                        header("Location: index.php?error=Incorrect Support Code.");
                    }
                }
            }
         }
    }
    else {
        header("Location: index.php?error=The email you entered does not match any accounts.");
        exit();
    }

?>
