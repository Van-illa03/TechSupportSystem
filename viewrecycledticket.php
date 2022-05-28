<?php
//database connection
$con=mysqli_connect("localhost","root","","techsupportsystem");
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
    </style>
</head>

<body>
<?php
//query on getting the information of the current user that matches the id on the $currentuser variable
$userquery = mysqli_query($con,"SELECT Name,Email,UID,Company FROM internuser WHERE UID='$currentuser'");
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
            <li class="nav-item d-flex justify-content-center">
                <!-- Code block for notification starts here -->
                <div class="dropdown">
                    <?php
                    //this code counts the number of not viewed notifications for the current user in the databases
                    $notifquery = mysqli_query($con,"SELECT * FROM notifications WHERE Ticket_Owner='$currentuser'");
                    $viewcounter = 0;

                    while ($getnotifications = mysqli_fetch_assoc($notifquery)) {
                        if ($getnotifications['ViewStatus'] == 0) {
                            $viewcounter += 1;
                        }
                    }
                    ?>
                    <!-- Notification Icon and badge -->
                    <button class="btn bi bi-bell" type="button" id="notifications" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="badge" style="font-size: 9px;" id="badge"><?php echo $viewcounter; ?></span>
                    </button>


                    <!-- Notification dropdown when the notification icon was clicked -->
                    <ul class="dropdown-menu" id="notifdropdown" aria-labelledby="notifications">
                        <b><li style="margin-left: 10px; margin-bottom: 5px; font-size: 20px;">Notifications</li></b>
                        <?php
                        //gets all the notifications for the user in the database
                        $notifquery2 = mysqli_query($con,"SELECT * FROM notifications WHERE Ticket_Owner='$currentuser' ORDER BY NID DESC");
                        $ctr = 1;
                        while ($getnotifications1 = mysqli_fetch_assoc($notifquery2)) {
                            ?>
                            <li class="d-flex justify-content-center" id="dropdownitems<?php echo $ctr?>"><a class="dropdown-item" href="notifviewticket.php?ntid=<?php echo $getnotifications1['NID']?>&id=<?php echo $getnotifications1['TID']?>" title="<?php echo $getnotifications1['Content']?>  Click to view."><?php echo $getnotifications1['Content']?><p id="datetext"><?php echo $getnotifications1['date']?></p></a><a href="deletenotif.php?nid=<?php echo $getnotifications1['NID']; ?>" title="Delete notification" id="deletenotiflink"><i class="bi bi-x-lg" id="deletenotif"></i></a></li>

                            <!--php code for dropdown items bg color and hover bg color of notifications-->
                            <?php
                            $zerostring = "0";
                            $viewholder = $getnotifications1['ViewStatus'];

                            //echoing javascript for changing vg colors of notification based on their view status
                            echo "<script>
                        var viewreader ='$viewholder';
                        var zerostring = '$zerostring';

                    if (viewreader == zerostring) {
                        document.getElementById('dropdownitems'+'$ctr').style.backgroundColor = '#E8F9FD';
                        
                        //hovers
                        document.getElementById('dropdownitems'+'$ctr').onmouseover = function() {
                        document.getElementById('dropdownitems'+'$ctr').style.backgroundColor = '#F2F2F2';
                        };
                        document.getElementById('dropdownitems'+'$ctr').onmouseout = function() {
                        document.getElementById('dropdownitems'+'$ctr').style.backgroundColor = '#E8F9FD';
                        };
                    } else {
                    document.getElementById('dropdownitems'+'$ctr').style.backgroundColor = 'white';
                    
                    //hovers
                        document.getElementById('dropdownitems'+'$ctr').onmouseover = function() {
                        document.getElementById('dropdownitems'+'$ctr').style.backgroundColor = '#F2F2F2';
                        };
                        document.getElementById('dropdownitems'+'$ctr').onmouseout = function() {
                        document.getElementById('dropdownitems'+'$ctr').style.backgroundColor = 'white';
                        };
                    }
                    
                    </script>";
                            $ctr++;
                        } ?>
                    </ul>
                </div>
                <!-- Dropdown icon that shows the profile and logout button -->
                <div class="dropdown">
                    <button class="btn dropdown-toggle bi bi-person-circle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item "href="internprofile.php" id="profile">Profile</a></li>
                        <li><a class="dropdown-item "href="login.php" id="logout">Log Out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- Main content starts here -->
<div id="viewport">

    <!-- off-canvas sidebar content -->s
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
                    <li class="nav-item">
                        <a class="nav-link bi bi-ticket-detailed-fill" href="internhomepage.php"> All Tickets</a>
                    </li>
                    <li class="nav-item " id="navblue">
                        <a class="nav-link  bi bi-ticket-perforated-fill "href="internunassignedticket.php"> Unassigned Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bi bi-envelope-open-fill" href="internopenticket.php"> Open</a>
                    </li>
                    <li class="nav-item" id="navblue">
                        <a class="nav-link bi bi-hourglass-split" href="internpendingticket.php"> Pending</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link bi bi-bookmark-check-fill" href="internclosedticket.php"> Closed</a>
                    </li>
                    <li class="nav-item" id="navblue">
                        <a class="nav-link bi bi-hourglass-split" href="creatingticket.php"> Create Ticket</a>
                    </li>
                    <li class="nav-item" id="navwhite">
                        <a class="nav-link bi bi-trash-fill" href="internrecyclebin.php">Recycle Bin</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php
    //getting the deleted ticket based on TID passed on URL parameter
    $id=$_GET["id"];
    $getTickets = mysqli_query($con,"SELECT * FROM ticketbin WHERE TID='$id'");
    $chosenTicket = mysqli_fetch_array($getTickets)
    ?>
    <!-- Content -->
    <div id="content" class="container">
        <br>
        <div class="container-fluid" id="content-container">
            <h2>View Deleted Ticket</h2>


            <div class="container">
                <div class="card mx-auto" id="ticketcardintern">
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

                    <form action="ticketprocess.php" method="POST">
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
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description" name="content" disabled><?php echo $chosenTicket['Content'];?></textarea>
                                <hr>
                                <p>Assigned Personnel's Note:</p>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Personnel Notes/Comments" name="note" disabled><?php echo $chosenTicket['Note'];?></textarea>
                            </div>

                            <div class="row mx-auto">
                                <div class="col-8">
                                    <a></a>
                                </div>
                                <div class="col-2">
                                </div>
                                <div class="col-2">
                                    <a href="delete.php?id=<?php echo $chosenTicket['TID'];?>" class="btn btn-danger" title="Delete Ticket">Delete</a>
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
<script>
    //passing the number of not viewed notifications from php to javascript
    var viewcount = "<?php echo $viewcounter ?>";

    if (viewcount !== "0") {//if there are notifications that is not viewed, the badge will be displayed
        document.getElementById('badge').style.display = 'block';
    } else {
        document.getElementById('badge').style.display = 'none';
    }
</script>
</body>
</html>