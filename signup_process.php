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
    $FilteringResult = false;

    //verification of email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=Invalid Email. Check the format.");
        exit();
    }

    //verification of password
    if ($password1 != $password2){
        header("Location: signup.php?error=Passwords does not match.");
        exit();
    }

    if ($usertype === "Intern") {
        //filtering of duplicate emails
        $Filtering = mysqli_query($con,"SELECT * FROM internuser WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);
    }
    else if ($usertype === "Support Team") {
        //filtering of duplicate emails
        $Filtering = mysqli_query($con,"SELECT * FROM supportteam WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);
    }
    else if ($usertype === "Admin") {
        //filtering of duplicate emails
        $Filtering = mysqli_query($con,"SELECT * FROM administrator WHERE Email='$email' LIMIT 1");
        $FilteringResult = mysqli_fetch_assoc($Filtering);
    }


    if ($FilteringResult)  {
        if ($FilteringResult['Email'] === $email) {
            header("Location: signup.php?error=The Email you entered is already in use.");
            exit();
        }
    }

    if ($usertype === "Intern"){
        $RegisterUser = "INSERT INTO internuser (Name, Email, Password, Company) 
                      VALUES('$name','$email','$password1','$company')";
        mysqli_query($con, $RegisterUser);
    }
    else if ($usertype === "Support Team") {
    $RegisterUser = "INSERT INTO supportteam (Name, Email, Password, Company)
    VALUES('$name','$email','$password1','$company')";
    mysqli_query($con, $RegisterUser);
    }
    else if ($usertype === "Admin") {
    $RegisterUser = "INSERT INTO administrator (Name, Email, Password, Company) 
                      VALUES('$name','$email','$password1','$company')";
    mysqli_query($con, $RegisterUser);
    }

    ?>
<script type="text/javascript">
    alert('Registration Successful');
    window.location="login.php";
</script>
