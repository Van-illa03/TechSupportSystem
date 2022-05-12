<?php
session_start();
unset($_SESSION['id']);
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


<body class="loginBody" onload="check();">

    <div class="container" style="background-color: white; margin-top: 75px; width: 870px;height: 500px; padding:0px;border-radius: 20px">
        <div class="d-flex">
                <div class="p-0 d-flex justify-content-center" style="height:500px;width: 444px; padding:0px;">
                    <div style="text-align: center;">
                        <form action="login_process.php" method="POST" style="margin-top: 60px;">
                            <h4 style="text-align: center;">LOGIN</h4>
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger" style="width:320px; margin-top: 5px;height: 22px; font-size: 13px; padding: 0px;"><?php echo $_GET['error']; ?> </div>
                            <?php } ?>

                                <select class="form-select" aria-label="Default select example" id="selectlogin" name="usertype" onChange="check();" >
                                    <option value="Intern"  selected>Intern</option>
                                    <option value="Support Team" >Support Team</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" style="width:300px;">
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" style="width:300px;">

                                    <div class="d-flex flex-row justify-content-center">
                                        <div class="p-2">
                                            <input type="password" class="form-control" id="sc" placeholder="Support Code" name="sc" style="width:130px;">
                                            <input type="password" class="form-control" id="ac" placeholder="Admin Code" name="ac" style="width:130px;">
                                        </div>
                                    </div>
                                    </div>
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            <script>
                                function check() {
                                    var dropdown = document.getElementById('selectlogin');
                                    var current_value = dropdown.options[dropdown.selectedIndex].value;

                                    if (current_value == "Support Team") {
                                        document.getElementById('sc').style.display = 'block';
                                        document.getElementById('ac').style.display = 'none';
                                    }
                                    else if (current_value == "Administrator"){
                                        document.getElementById('sc').style.display = 'none';
                                        document.getElementById('ac').style.display = 'block';
                                    }
                                    else {
                                        document.getElementById('sc').style.display = 'none';
                                        document.getElementById('ac').style.display = 'none';
                                    }
                                }
                            </script>
                        </form>
                                <hr style="margin:9px;">
                                <p style="font-size: 12px; margin:6px;">Don't have an account? Register now!</p>
                                <a href="signup.php"><button name="login" class="btn btn-info">Register for an Account</button></a>
                    </div>
                    </div>
        <div class="align-self-center p-0">
            <img src="../images/croppedbg.jpg" style="height:500px; width:444px;margin:0px;border-bottom-right-radius: 20px;border-top-right-radius: 20px;">
        </div>
        </div>
    </div>

</body>
</html>