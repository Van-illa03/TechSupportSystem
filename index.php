<?php
require ("createdbtable.php");

//database connection
$con=mysqli_connect("localhost","id19015714_techsupportadmin","rZf}z!K3@PZ^9Nt/","id19015714_techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}

session_start();
unset($_SESSION['id']);


if (isset($_POST['login'])){
    //getting the values from the forms
    $email = $_POST['email'];
    $password = $_POST['password'];s
    $FilteringResult = false;


    $Filtering = mysqli_query($con,"SELECT * FROM internuser WHERE Email='$email' LIMIT 1");
    $FilteringResult= mysqli_fetch_assoc($Filtering);

    if ($email == ""){
        header("Location: index.php?error=Enter your email.");
        exit();
    }
    //verification of email format
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=Invalid Email. Please check carefully.");
        exit();
    }
    else if ($FilteringResult == null) {
        header("Location: index.php?error=Your account does not exist.");
        exit();
    }
    //checking if passwords fields are not empty
    else if ($password != null) {
        //checking if the password inputted matches the one in the database
        if ($FilteringResult['Password'] != $password){
            header("Location: index.php?error=Incorrect password.");
            exit();
        }

        else { // if all verifications are passed, the registration will proceed

            echo '<script>alert("Login successful.")
                window.location.replace("internhomepage.php");
                </script>';
        }
    }
    else {
        header("Location: index.php?error=Input your password.");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/jpg" href="images/uiplogo.png"/>
    </style>
</head>


<body class="loginBody">

<div class="container" style="background-color: white; margin-top: 75px; width: 870px;height: 500px; padding:0px;border-radius: 20px">
    <div class="d-flex">
        <div class="p-0 d-flex justify-content-center" style="height:500px;width: 444px; padding:0px;">
            <div style="text-align: center;">
                <form method="POST" style="margin-top: 60px;">
                    <h4 style="text-align: center;">LOGIN</h4>
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger d-flex align-items-center d-flex justify-content-center" style="width:320px; margin-top: 5px;height: 35px; font-size: 13px; padding: 0px;"><?php echo $_GET['error']; ?> </div>
                    <?php } ?>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" style="width:300px;">
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" style="width:300px;">

                        </div>
                    </div>

                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
                <hr style="margin:9px;">
                <p style="font-size: 12px; margin:6px;">Don't have an account? Register now!</p>
                <a href="signupintern.php"><button name="login" class="btn btn-info">Register for an Account</button></a>
            </div>
        </div>
        <div class="align-self-center p-0">
            <img src="../images/croppedbg.jpg" style="height:500px; width:444px;margin:0px;border-bottom-right-radius: 20px;border-top-right-radius: 20px;">
        </div>
    </div>
</div>

</body>
</html>