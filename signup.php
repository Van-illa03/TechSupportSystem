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


<body>
<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <a class ="navbar-brand" href="LandingPage.html"> <img id="logo" src="images/uiplogo.png" alt="MAV Logo" class ="logo px-auto">Automated Technical Support System</a>
        <ul class="navbar-nav">
            <li class="nav-item">
            </li>
            <li class="nav-item">
                <a class="nav-link  "href="login.html">LOGIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">SIGN UP</a>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container" id="signupcontainer">
    <center>
        <h2>SIGN UP</h2>
        <select class="form-select" aria-label="Default select example" id="selectsignup">
            <center>
                <option selected>Select User</option>
                <option value="1">Admin</option>
                <option value="2">Support Team</option>
            </center>
        </select>
        <form action="" method="POST">

            <div class="form-group" id="">
                <label for="name"></label>
                <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">

                <label for="email"></label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">

                <label for="pwd"></label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">

                <label for="dsgntn"></label>
                <input type="designation" class="form-control" id="dsgntn" placeholder="Enter designation" name="dsgntn">

                <label for="cnfrmpwd"></label>
                <input type="password" class="form-control" id="cnfrmpwd" placeholder="Confirm password" name="cnfrmpswd">
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </center>
</div>

</body>
</html>