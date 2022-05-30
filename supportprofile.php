<?php
//database connection
$con=mysqli_connect("localhost","id19015714_techsupportadmin","rZf}z!K3@PZ^9Nt/","id19015714_techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}
session_start();
//getting the id of the current user from session and assigning it to $currentuser variable
$currentuser = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UIP</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/jpg" href="images/uiplogo.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!--CDN for data tables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
    <sript type="text/javascript" src ="//cdn.datatables.net/plug-ins/1.11.5/dataRender/ellipsis.js"></sript>
</head>

<body>
<?php
//query on getting the information of the current user that matches the id on the $currentuser variable
$userquery = mysqli_query($con,"SELECT Name,Email,UID,Company FROM supportteam WHERE UID='$currentuser'");
$getcurrentuser = mysqli_fetch_assoc($userquery);
?>
<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <div class="d-flex flex-row">
            <div class="p-2">
                <!-- Button to open the offcanvas sidebar -->
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" id="hamburgerbutton">
                    <i class="bi bi-list" id="hamburgericon"></i>
                </button>
            </div>
            <div class="p-2">
                <a class ="navbar-brand" disabled> <img id="logo" src="images/uiplogo.png" alt="MAV Logo" class ="logo">Automated Technical Support System</a>
            </div>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <h6 class="nav-link" disabled><?php echo $getcurrentuser['Name']?></h6>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn dropdown-toggle bi bi-person-circle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item "href="supportprofile.php" id="profile">Profile</a></li>
                        <li><a class="dropdown-item " href="index.php" id="logout">Log Out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div id="viewport">

    <div class="offcanvas offcanvas-start" id="demo">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Menu</h1>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">

            <!-- Sidebar -->
            <div class id="sidebar">
                <header>
                    <p></p>
                </header>
                <ul class="nav flex-column">
                    <li class="nav-item" id="navwhite">
                        <a class="nav-link bi bi-ticket-detailed-fill" href="supporthomepage.php"> All Tickets</a>
                    </li>
                    <li class="nav-item" id="navblue">
                        <a class="nav-link bi bi-envelope-open-fill" href="supportopenticket.php"> Open</a>
                    </li>
                    <li class="nav-item" id="navwhite">
                        <a class="nav-link bi bi-hourglass-split" href="supportpendingticket.php"> Pending</a>
                    </li>
                    <li class="nav-item" id="navblue" >
                        <a class="nav-link bi bi-bookmark-check-fill" href="supportclosedticket.php"> Closed</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div id="content" class="container">
        <br>
        <div class="container" id="content-container">
            <h2>User Profile</h2>
            <form action="updatesupportinfo.php?id=<?php echo $getcurrentuser['UID']?>" method="POST">
                <div class="container" style="background-color: white;padding:10px; width: 500px; margin-bottom: 60px;" id="profilecontainer">
                    <i class="bi bi-person-fill d-flex justify-content-center" id="profileicon"></i>
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="d-flex justify-content-center">
                            <div class="alert alert-danger d-flex justify-content-center" style="width:320px; margin-top: 5px;height: 22px; font-size: 13px; padding: 0px;"><?php echo $_GET['error']; ?> </div>
                        </div>
                    <?php } ?>
                    <div class="container" style="margin-top: 15px; padding-left: 10px;">
                        <div class="d-flex justify-content-left" style="margin-top: 10px;">
                            <h6 style="margin-right: 124px;">Name </h6>
                            <h6 style="margin-right: 40px;">:</h6>
                            <textarea type="text" style="height:30px; width: 190px;" name="name"><?php echo $getcurrentuser['Name']; ?></textarea>
                        </div>
                        <div class="d-flex justify-content-left" style="margin-top: 10px;">
                            <h6 style="margin-right: 128px;">Email </h6>
                            <h6 style="margin-right: 40px;">:</h6>
                            <h6><?php echo $getcurrentuser['Email']; ?></h6>
                        </div>
                        <div class="d-flex justify-content-left" style="margin-top: 10px;">
                            <h6 style="margin-right: 98px;">Company </h6>
                            <h6 style="margin-right: 40px;">:</h6>
                            <h6><?php echo $getcurrentuser['Company']; ?></h6>
                        </div>
                        <hr>
                        <!-- Password Fields -->
                        <div class="d-flex align-items-center">
                            <h5>Change Password</h5>
                            <input type="radio" id="yeschange" name="passchange" style="margin-left: 10px; margin-right: 5px; margin-top:-3px;" value="yes">
                            <label for="yesemail" style="margin-top: -3px;">Yes</label>
                            <input type="radio" id="nochange" name="passchange" style="margin-left: 10px; margin-right: 5px; margin-top:-3px;" value="no" checked="true">
                            <label for="noemail" style="margin-top: -3px;">No</label>
                            <p style="margin-left: 5px; margin-right: 5px; margin-top:12px;font-size: 12px;">(choose "No" if not)</p>
                        </div>
                        <div class="d-flex justify-content-left" style="margin-top: 10px;">
                            <h6 style="margin-right: 40px; display: none;" id="cplabel">Current Password </h6>
                            <h6 style="margin-right: 40px; display: none;" id="cpcolon">:</h6>
                            <input type="password" placeholder="Current Password" name="currentpass" id="currentpass" style="height: 30px; display: none;">
                        </div>
                        <div class="d-flex justify-content-left" style="margin-top: 10px;">
                            <h6 style="margin-right: 62px; display: none;" id="nplabel">New Password </h6>
                            <h6 style="margin-right: 40px; display: none;" id="npcolon">:</h6>
                            <input type="password" placeholder="New Password" name="newpass" id="newpass" style="height: 30px; display: none;">
                        </div>
                        <div class="d-flex justify-content-center" style="margin-top: 20px;">
                            <button class="btn btn-success" type="submit" name="submit">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>



        </div>
    </div>
<script>
    $(document).ready(function (){
    });

    //hiding and showing password fields based on radio button choice
    $('input[type=radio]').click(function(e) {//jQuery works on clicking radio box
        var value = $(this).val(); //Get the clicked radio value
        if (value == "yes"){
            document.getElementById('currentpass').style.display = 'block';
            document.getElementById('newpass').style.display = 'block';
            document.getElementById('cplabel').style.display = 'block';
            document.getElementById('cpcolon').style.display = 'block';
            document.getElementById('nplabel').style.display = 'block';
            document.getElementById('npcolon').style.display = 'block';
        }
        else {
            document.getElementById('currentpass').style.display = 'none';
            document.getElementById('newpass').style.display = 'none';
            document.getElementById('cplabel').style.display = 'none';
            document.getElementById('cpcolon').style.display = 'none';
            document.getElementById('nplabel').style.display = 'none';
            document.getElementById('npcolon').style.display = 'none';
        }
    });
</script>
</body>
</html>