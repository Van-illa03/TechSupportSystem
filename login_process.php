<?php
    //database connection
    $con=mysqli_connect("localhost","root","","techsupportsystem");
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
    $FilteringResult = false;

    //verification of email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?error=Invalid Email. Check the format.");
        exit();
    }

    if ($usertype === "Intern") {
        $Filtering = mysqli_query($con,"SELECT * FROM internuser WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);
    }
    else if ($usertype === "Support Team") {
        $Filtering = mysqli_query($con,"SELECT * FROM supportteam WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);
    }
    else if ($usertype === "Admin") {
        $Filtering = mysqli_query($con,"SELECT * FROM administrator WHERE Email='$email' LIMIT 1");
        $FilteringResult = mysqli_fetch_assoc($Filtering);
    }


    //verification of account
    if ($FilteringResult)  {
        if ($FilteringResult['Password'] != $password) {
            header("Location: login.php?error=Incorrect Password.");
            exit();
        }
    }
    else {
        header("Location: login.php?error=The email you entered does not match any accounts.");
        exit();
    }

    //setting the session variable to the unique id of the current user. This $_SESSION variable will be used althroughout the pages
    $_SESSION['id'] = $FilteringResult['id'];
?>

<script type="text/javascript">
    alert('Registration Successful');
    window.location="LandingPage.html";
</script>
