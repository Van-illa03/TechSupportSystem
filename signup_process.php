<?php
    //database connection
    $con=mysqli_connect("localhost","root","","TechSupportSystem");
    if (!$con){
        echo "failed to connect";
        die();
    }

    //getting the values from the forms
    $usertype = $_POST['usertype'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $company = $_POST['companydrp'];
    $admincodesu = $_POST['suac'];
    $supportcodesu = $_POST['susc'];
    $FilteringResult = false;

    //fetching the admin/support code
    $codequery = mysqli_query($con,"SELECT * FROM codes");
    $getcodes = mysqli_fetch_assoc($codequery);

    //verification of email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=Invalid Email. Check the format.");
        exit();
    }

    //checking if passwords matched
    if ($password1 != $password2){
        header("Location: signup.php?error=Passwords does not match.");
        exit();
    }

    if ($usertype == "Intern") {
                // no arg
    }
    else if ($usertype == "Support Team") {
        if (isset($supportcodesu)){
            if ($getcodes['SupportCode'] == $supportcodesu){
                // it means that the support code inputted is correct
            }
            else {
                header("Location: signup.php?error=Incorrect Support Code.");
                exit();
            }
        }
    }
    else if ($usertype == "Administrator") {
        if (isset($admincodesu)){
            if ($getcodes['AdminCode'] == $admincodesu){
                // it means that the admin code inputted is correct
            }
            else {
                header("Location: signup.php?error=Incorrect Admin Code.");
                exit();
            }
        }
    }


    if ($usertype == "Intern") {
        //filtering of duplicate emails
        $Filtering = mysqli_query($con,"SELECT * FROM internuser WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);
    }
    else if ($usertype == "Support Team") {
        //filtering of duplicate emails
        $Filtering = mysqli_query($con,"SELECT * FROM supportteam WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);
    }
    else if ($usertype == "Administrator") {
        //filtering of duplicate emails
        $Filtering = mysqli_query($con,"SELECT * FROM administrator WHERE Email='$email' LIMIT 1");
        $FilteringResult = mysqli_fetch_assoc($Filtering);
    }

    //if there's a fetch data here, it means that the email inputted has a duplicated in the database
    if ($FilteringResult)  {
        if ($FilteringResult['Email'] == $email) {
            header("Location: signup.php?error=The Email you entered is already in use.");
            exit();
        }
    }


    //if there are no errors, the signup process will continue
    if ($usertype == "Intern"){
        $RegisterUser = "INSERT INTO internuser (Name, Email, Password, Company) 
                      VALUES('$name','$email','$password1','$company')";
        mysqli_query($con, $RegisterUser);
        echo '<script>alert("Sign up successful.")
        window.location.replace("login.php");
        </script>';
    }
    else if ($usertype == "Support Team") {
        $RegisterUser = "INSERT INTO supportteam (Name, Email, Password, Company)
        VALUES('$name','$email','$password1','$company')";
        mysqli_query($con, $RegisterUser);
        echo '<script>alert("Sign up successful.")
        window.location.replace("login.php");
        </script>';
    }
    else if ($usertype == "Administrator") {
        $RegisterUser = "INSERT INTO administrator (Name, Email, Password, Company) 
                          VALUES('$name','$email','$password1','$company')";
        mysqli_query($con, $RegisterUser);
        echo '<script>alert("Sign up successful.")
        window.location.replace("login.php");
        </script>';
    }
    ?>