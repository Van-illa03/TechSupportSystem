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


<body class="loginBody">

    <div class="container" style="background-color: white; margin-top: 100px; width: 870px;height: 444px; padding:0px;">
        <div class="d-flex">
                <div class="p-0 d-flex justify-content-center d-flex align-items-center" style="height:444px;width: 444px; padding:0px;">
                        <br>
                        <form action="login_process.php" method="POST">
                            <h2>LOGIN</h2>
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger" style="width:300px;"><?php echo $_GET['error']; ?> </div>
                            <?php } ?>
                            <select class="form-select" aria-label="Default select example" id="selectlogin" name="usertype">
                                <option value="Administrator" selected>Administrator</option>
                                <option value="Support Team">Support Team</option>
                                <option value="Intern">Intern</option>
                            </select>
                            <div class="form-group">
                                <label for="email"></label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" style="width:300px;">
                                <label for="pwd"></label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" style="width:300px;">
                            </div>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </form>
                        <br>
                </div>
                <div class="align-self-center p-0">
                    <img src="../images/croppedbg.jpg" style="height:444px; width:444px;margin:0px;">
                </div>
            </div>


        </div>
    </div>



</body>
</html>