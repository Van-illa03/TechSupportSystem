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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  </style>
</head>

<body>
<?php
//query on getting the information of the current user that matches the id on the $currentuser variable
$userquery = mysqli_query($con,"SELECT Name,Email,UID,Company FROM administrator WHERE UID='$currentuser'");
$getcurrentuser = mysqli_fetch_assoc($userquery);
?>
<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <div class="d-flex flex-row">
            <div class="p-2">
                <!-- Hamburger button to open the off-canvas sidebar -->
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" id="hamburgerbutton">
                    <i class="bi bi-list" id="hamburgericon"></i>
                </button>
            </div>
            <div class="p-2">
                <a class ="navbar-brand" disabled> <img id="logo" src="images/uiplogo.png" alt="MAV Logo" class ="logo">Automated Technical Support System</a>
            </div>
        </div>
        <ul class="navbar-nav">
            <!-- User's name at the page header -->
            <li class="nav-item">
                <h6 class="nav-link" disabled><?php echo $getcurrentuser['Name']?></h6>
            </li>
            <li class="nav-item">
                <!-- Dropdown icon that shows the profile and logout button -->
                <div class="dropdown">
                    <button class="btn dropdown-toggle bi bi-person-circle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item "href="adminprofile.php" id="profile">Profile</a></li>
                        <li><a class="dropdown-item " href="index.php" id="logout">Log Out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- Main content starts here -->
<div id="viewport">

    <!-- off-canvas sidebar content -->
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
                <a class="nav-link bi bi-ticket-detailed-fill" href="adminhomepage.php"> All Tickets</a>
            </li>
            <li class="nav-item " id="navblue">
                <a class="nav-link  bi bi-ticket-perforated-fill "href="adminunassignedticket.php"> Unassigned Tickets</a>
            </li>
            <li class="nav-item"id="navwhite">
                <a class="nav-link bi bi-envelope-open-fill" href="adminopenticket.php"> Open</a>
            </li>
            <li class="nav-item" id="navblue">
                <a class="nav-link bi bi-hourglass-split" href="adminpendingticket.php"> Pending</a>
            </li>
            <li class="nav-item" id="navwhite">
                <a class="nav-link bi bi-bookmark-check-fill" href="adminclosedticket.php"> Closed</a>
            </li>
            <li class="nav-item" id="navblue">
                <a class="nav-link bi bi-person-check-fill" href="adminviewsupports.php">  Support Personnel</a>
            </li>
            <li class="nav-item" id="navwhite">
                <a class="nav-link bi bi-shield-lock-fill" href="admingeneratecode.php"> Security Codes</a>
            </li>
        </ul>
    </div>
    </div>
    </div>
<?php
    //fetching the codes from the database
    $codequery = mysqli_query($con,"SELECT * FROM codes");
    $getcodes = mysqli_fetch_assoc($codequery);

    if (isset($getcodes['id'])){ //if id is set, it means that there is already an existing row for the code.
        //no arg
    } else { //if the row id is not set, it means that the row is still not existing, so the code below initializes it
        $InitCode = "INSERT INTO codes (AdminCode,SupportCode,id)
                    VALUES('UIPadmin','UIPsupp',1)";
        mysqli_query($con, $InitCode);
    }

    if(isset($_POST['submit'])){ //if submit is set -- the code only works when submit button is clicked
        $ACode = $_POST['acode'];
        $SCode = $_POST['scode'];

            if (isset($getcodes['AdminCode'])){ //if there's a fetched admin code in the database, we only update it, not insert
                if ($getcodes['AdminCode'] != $ACode){
                    $AUpdateCode = "UPDATE codes
                    SET AdminCode = '$ACode' WHERE id=1";
                    mysqli_query($con, $AUpdateCode);
                    echo '<script>alert("Administrator code updated successfully.");</script>';
                }
            }

        if (isset($getcodes['SupportCode'])){ //if there's a fetched support code in the database, we only update it, not insert
            if ($getcodes['SupportCode'] != $SCode){
                $SUpdateCode = "UPDATE codes
                    SET SupportCode = '$SCode' WHERE id=1";
                mysqli_query($con, $SUpdateCode);
                echo '<script>alert("Support code updated successfully.");</script>';
            }

        }
    }

?>
  <!-- Content (code display)-->
      <div id="content" class="container">
          <br>
        <div class="container-fluid" id="content-container">
            <h2>Security Codes</h2>

            <div class="container">
                <div class="card mx-auto" id="ticketcardadmin" style="margin-bottom: 20px;">
                    <div class="card-header text-white" id="cardheader" style="background-color: #224375">
                        <div class="row">
                            <div class="col-6">
                                <h4>Codes</h4>
                            </div>
                        </div>
                    </div>

                    <form method="POST">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h4>Support Code</h4>
                                        </div>
                                    <div class="col-6">
                                        <h4>Admin Code</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                    //we fetch the codes again for displaying
                                    $codequery = mysqli_query($con,"SELECT * FROM codes");
                                    $getcodes = mysqli_fetch_assoc($codequery);

                                    if(isset($getcodes['SupportCode'])){ //if there's a fetched support code
                                        //no arg
                                    } else { //if there's not fetched support code, we only assign null string
                                        $getcodes['SupportCode'] = "";
                                    }

                                    if (isset($getcodes['AdminCode'])){ //if there's a fetched admin code
                                        //no arg
                                    } else { //if there's not fetched admin code, we only assign null string
                                        $getcodes['AdminCode'] = "";
                                    }
                                    ?>
                                    <!-- display the codes -->
                                    <div class="col-6">
                                        <textarea class="form-control" type="text" rows="3" placeholder="Input Support Code (up to 10 characters only)" name="scode"><?php echo $getcodes['SupportCode'];?></textarea>
                                    </div>
                                    <div class="col-6">
                                        <textarea class="form-control" type="text" rows="3" placeholder="Input Admin Code (up to 10 characters only)" name="acode"><?php echo $getcodes['AdminCode'];?></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col d-flex justify-content-center">
                                            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
</div>
</body>
</html>