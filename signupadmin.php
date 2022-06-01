<?php
//database connection
$con=mysqli_connect("localhost","id19015714_techsupportadmin","rZf}z!K3@PZ^9Nt/","id19015714_techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}

    if (isset($_POST['registerbtn'])){
        //getting the values from the forms
        $email = $_POST['email'];
        $name = (mysqli_real_escape_string($con, $_POST['name']));
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $supportcode = $_POST['suac']; // sign up admin code

        //fetching the admin/support code
        $codequery = mysqli_query($con,"SELECT * FROM codes");
        $getcodes = mysqli_fetch_assoc($codequery);
        
        $company = (mysqli_real_escape_string($con, $_POST['companydrp']));
        $FilteringResult = false;
        $pattern = preg_quote('#$%^&*()+=-[]\';,./{}|\":<>?~', '@');

        $Filtering = mysqli_query($con,"SELECT * FROM administrator WHERE Email='$email' LIMIT 1");
        $FilteringResult= mysqli_fetch_assoc($Filtering);

        //checking if email field is empty
        if ($name == ""){
            header("Location: signupadmin.php?error=Enter your name.");
            exit();
        }
        //checking if name field is empty
        else if ($email == ""){
            header("Location: signupadmin.php?error=Enter your email.");
            exit();
        }
        //verification of email format
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: signupadmin.php?error=Invalid Email. Please check carefully.");
            exit();
        }
        //checking for duplicate emails
        else if ($FilteringResult['Email']){
            header("Location: signupadmin.php?error=Email has already been taken by another user.");
            exit();
        }
        //filtering of characters in name (must not have numbers/special characters
        else if (preg_match('@[0-9]@',$name) || preg_match("@[{$pattern}]@",$name)){
            header("Location: signupadmin.php?error=Name must not contain numbers and special characters.");
            exit();
            }
        //checking if passwords fields are not empty
        else if ($password1 != null && $password2 != null) {

            //checking if the 2 passwords are the same
            if ($password1 != $password2){
                    header("Location: signupadmin.php?error=Passwords does not match.");
                    exit();
                }
                //checking if the 2 passwords are 8 characters long or above
                else if (strlen($password1) < 8 && strlen($password2) < 8 ){
                    header("Location: signupadmin.php?error=Passwords must be at least 8 characters long.");
                    exit();
                }
                //checking if the 2 passwords have numbers/special characters (must have)
                else if (!preg_match('@[0-9]@',$password1) || !preg_match('@[0-9]@',$password2) && !preg_match('@[^\w]@',$password1) || !preg_match('@[^\w]@',$password2) ) {
                    header("Location: signupadmin.php?error=Passwords must contain numbers and special characters.");
                    exit();
                }
                else if ($supportcode != $getcodes['AdminCode']){
                    header("Location: signupadmin.php?error=Incorrect admin code.");
                    exit();
                }
                else { // if all verifications are passed, the registration will proceed

                    $RegisterUser = "INSERT INTO administrator (Name, Email, Password, Company) 
                              VALUES('$name','$email','$password1','$company')";
                    mysqli_query($con, $RegisterUser);
                    echo '<script>alert("Sign up successful.")
                window.location.replace("adminlogin.php");
                </script>';
                }
        }
        else {
            header("Location: signupadmin.php?error=Input your password.");
            exit();
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
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


<div class="container" style="background-color: white; margin-top: 75px; width: 870px;height: 500px; padding:0px;border-radius: 20px;">
    <div class="d-flex">
        <div class="p-0 d-flex justify-content-center" style="height:500px;width: 444px; padding:0px;">
         <div class="text-center">
        <form method="POST" style="margin-top: 15px;">
            <h4>SIGN UP</h4>

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger d-flex align-items-center d-flex justify-content-center" style="width:300px; margin-top: 5px;height: 35px; font-size: 13px; padding: 0px;"><?php echo $_GET['error']; ?> </div>
                <?php } ?>

                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" style="width:300px;height: 30px;">

                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" style="width:300px;height: 30px;">

                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password1" style="width:300px;height: 30px;">

                    <input type="password" class="form-control" id="cnfrmpwd" placeholder="Confirm password" name="password2" style="width:300px;height: 30px;">

                    <p style="margin-bottom:0px;margin-top: 10px;font-size: 13px;">Your Company:</p>
                    <select class="form-select my-1 py-1 rounded" id="companyselect" aria-label="Default select example" name="companydrp">
                        <center>
                            <option value="Melham Construction Corporation">Melham Construction Company</option>
                            <option value="Anafara">Anafara</option>
                            <option value="Visvis Logistics" selected>Visvis Logistics</option>
                        </center>
                    </select>
            <div class="d-flex flex-row justify-content-center">
                <input type="password" class="form-control" id="susc" placeholder="Admin Code" name="suac" style="width:130px; margin:10px;">
            </div>
                <button type="submit" class="btn btn-primary" name="registerbtn">Register</button>
        </form>
            <hr style="margin:9px;">
            <p style="font-size: 12px; margin:6px;">Already have an account? Login now!</p>
            <a href="index.php"><button class="btn btn-info">Account Login</button></a>
        </div>
            </div>
        <div class="align-self-center p-0">
            <img src="../images/croppedbg.jpg" style="height:500px; width:444px;margin:0px;border-bottom-right-radius: 20px;border-top-right-radius: 20px;">
        </div>
</div>
</div>
</div>


</body>
</html>