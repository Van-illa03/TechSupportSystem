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
            <li class="nav-item" id="navwhite">
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
    //getting the ticket based on TID passed on URL parameter
    $id=$_GET["id"];
    $getTickets = mysqli_query($con,"SELECT * FROM tickets WHERE TID='$id'");
    $chosenTicket = mysqli_fetch_array($getTickets)
    ?>
  <!-- Content -->
      <div id="content" class="container">
          <br>
        <div class="container-fluid" id="content-container">
            <h2>View Ticket</h2>

            <br>

            <div class="container">
                <div class="card mx-auto" id="ticketcardadmin">
                    <div class="card-header text-white" id="cardheader" style="background-color: #224375">
                        <div class="row">
                            <div class="col-7">
                                <h4>Ticket #<?php echo $chosenTicket['TID'];?> | <?php echo $chosenTicket['Status']; ?></h4>
                            </div>
                            <div class="col-5">
                                <p style="float:right;"><?php echo $chosenTicket['Date'];?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Start -->
                    <form action="updateticketadmin.php?tid=<?php echo $chosenTicket['TID'];?>" method="POST">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4><?php echo $chosenTicket['Subject'];?> (<?php echo $chosenTicket['Category'];?>)</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <p><?php echo $chosenTicket['Sender_Name'];?> | <?php echo $chosenTicket['Sender_Email'];?></p>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="tickettextareaadmin" rows="3" placeholder="Description" name="content" disabled><?php echo $chosenTicket['Content'];?></textarea>
                            </div>
                            <!-- Dropdown for support personnel (Initially assigning of ticket to a support personnel) -->
                            <div class="row mx-auto">
                                <div class="col-7 d-flex justify-content-start">
                                    <h6 style="margin-top:12px; margin-right:5px;">Assigned to:  </h6>
                                    <select class="form-select" aria-label="Default select example" id="selectsupport" name="supportuser">
                                        <?php
                                        //code group gets all the support user on the database and display them as dropdown item using while loop
                                        $currentsupport = $chosenTicket['Personnel_ID'];
                                        $fetchassignedsupport = mysqli_query($con,"SELECT * FROM supportteam WHERE UID='$currentsupport'");
                                        $fetchsupports = mysqli_query($con,"SELECT * FROM supportteam");

                                        //if the $currentsupport value is zero, this means that the ticket is not assigned to any support personnel
                                        //hence we need to display "None" on the dropdown to indicate that it is currently not handled by any support personnel
                                        if ($currentsupport==0){?>
                                            <option value=0 selected>None</option><!-- "None" dropdown option -->
                                            <?php while($supportslist = mysqli_fetch_assoc($fetchsupports)){ ?>
                                                    <option value =<?php echo $supportslist['UID']; ?>>
                                                        <?php echo $supportslist['Name'];?>
                                                    </option>
                                                <?php }
                                             }
                                        else { //if the ticket is already assigned, we display in the dropdown first the name of the assigned support personnel
                                            $assignedsupport = mysqli_fetch_assoc($fetchassignedsupport);?>
                                            <option value=<?php echo $assignedsupport['UID']; ?> selected> <?php echo $assignedsupport['Name']; ?> </option> <!-- Assigned support personnel on the ticket -->

                                            <?php while($supportslist = mysqli_fetch_assoc($fetchsupports)){
                                                if ( $supportslist['UID'] != $assignedsupport['UID']) { ?>
                                                    <option value =<?php echo $supportslist['UID']; ?>>
                                                        <?php echo $supportslist['Name'];?>
                                                    </option>
                                               <?php }
                                                }
                                            } ?>
                                    </select>
                                </div>
                                <div class="col-5 d-flex justify-content-end">
                                    <a href="" class="update" title="Update Ticket"><button class="btn btn-primary" type="submit" name="submit">Save Changes</button></a>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="current-date-time" name="timeStamp" readonly="true">
                    </form>

                </div>
            </div>
        </div>
      </div>
</div>

</body>
</html>