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

<div class="container-md" id="signupcontainer">
    <br>
    <center>
        <h2>SIGN UP</h2>

        <form action="signup_process.php" method="POST">
            <select class="form-select" aria-label="Default select example" id="selectsignup" name="usertype">
                <center>
                    <option value="Administrator">Administrator</option>
                    <option value="Support Team">Support Team</option>
                    <option value="Intern" selected>Intern</option>
                </center>
            </select>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger"><?php echo $_GET['error']; ?> </div>
            <?php } ?>
            <div class="form-group" id="">
                <label for="name"></label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">

                <label for="email"></label>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">

                <label for="pwd"></label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password1">

                <label for="cnfrmpwd"></label>
                <input type="password" class="form-control" id="cnfrmpwd" placeholder="Confirm password" name="password2">

                <select class="form-select my-4 py-2 rounded" id="companyselect" aria-label="Default select example" name="companydrp">
                    <center>
                        <option value="Melham Construction Corporation">Melham Construction Company</option>
                        <option value="Anafara">Anafara</option>
                        <option value="Visvis Logistics" selected>Visvis Logistics</option>
                    </center>
                </select>
                </div>

            <button type="submit" class="btn btn-primary" name="registerbtn">Register</button>
        </form>
    </center>
    <br>
</div>

</body>
</html>