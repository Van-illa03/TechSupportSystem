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


<body>
<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <a class ="navbar-brand" href="LandingPage.html"> <img id="logo" src="images/uiplogo.png" alt="MAV Logo" class ="logo px-auto">Automated Technical Support System</a>
        <ul class="navbar-nav">
            <li class="nav-item">
            </li>
            <li class="nav-item">
                <a class="nav-link  "href="login.php">LOGIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signup.php">SIGN UP</a>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container" id="logincontainer">
    <center>
        <h2>LOGIN</h2>

        <form action="login_process.php" method="POST">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?> </p>
            <?php } ?>
            <select class="form-select" aria-label="Default select example" id="selectlogin" name="usertype">
                <option value="Administrator" selected>Administrator</option>
                <option value="Support Team">Support Team</option>
                <option value="Intern">Intern</option>
            </select>
            <div class="form-group">
                <label for="email"></label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                <label for="pwd"></label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>

    </center>
</div>

</body>
</html>