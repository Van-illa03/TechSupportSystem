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


<body class="loginBody" onload="check()">


<div class="container" style="background-color: white; margin-top: 75px; width: 870px;height: 500px; padding:0px;border-radius: 20px;">
    <div class="d-flex">
        <div class="p-0 d-flex justify-content-center" style="height:500px;width: 444px; padding:0px;">
         <div class="text-center">
        <form action="signup_process.php" method="POST" style="margin-top: 10px;">
            <h4>SIGN UP</h4>

            <select class="form-select" aria-label="Default select example" id="selectsignup" name="usertype" onChange="check();">
                <center>
                    <option value="Intern" selected>Intern</option>
                    <option value="Support Team">Support Team</option>
                    <option value="Administrator">Administrator</option>
                </center>
            </select>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" style="width:300px; margin-top: 5px;height: 22px; font-size: 14px; padding: 0px;"><?php echo $_GET['error']; ?> </div>
                <?php } ?>

                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" style="width:300px;height: 30px;">

                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" style="width:300px;height: 30px;">

                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password1" style="width:300px;height: 30px;">

                    <input type="password" class="form-control" id="cnfrmpwd" placeholder="Confirm password" name="password2" style="width:300px;height: 30px;">

                    <select class="form-select my-2 py-1 rounded" id="companyselect" aria-label="Default select example" name="companydrp">
                        <center>
                            <option value="Melham Construction Corporation">Melham Construction Company</option>
                            <option value="Anafara">Anafara</option>
                            <option value="Visvis Logistics" selected>Visvis Logistics</option>
                        </center>
                    </select>
            <div class="d-flex flex-row justify-content-center">
                <div class="p-2">
                    <input type="password" class="form-control" id="susc" placeholder="Support Code" name="susc" style="width:130px;">
                    <input type="password" class="form-control" id="suac" placeholder="Admin Code" name="suac" style="width:130px;">
                </div>
            </div>
                <button type="submit" class="btn btn-primary" name="registerbtn">Register</button>
            <script>
                function check() {
                    var dropdown = document.getElementById('selectsignup');
                    var current_value = dropdown.options[dropdown.selectedIndex].value;

                    if (current_value == "Support Team") {
                        document.getElementById('susc').style.display = 'block';
                        document.getElementById('suac').style.display = 'none';
                    }
                    else if (current_value == "Administrator"){
                        document.getElementById('susc').style.display = 'none';
                        document.getElementById('suac').style.display = 'block';
                    }
                    else {
                        document.getElementById('susc').style.display = 'none';
                        document.getElementById('suac').style.display = 'none';
                    }
                }
            </script>
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