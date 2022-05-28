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
                    //this code counts the number of not viewed notifications for the current user in the database
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
                        $notifquery2 = mysqli_query($con,"SELECT * FROM notifications WHERE Ticket_Owner='$currentuser'  ORDER BY NID DESC");
                        $ctr = 1;
                        while ($getnotifications1 = mysqli_fetch_assoc($notifquery2)) { //populating the  dropdown by fetching the notifications and displaying through while loop
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
                        } //end while ?>
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
                <a class="nav-link bi bi-ticket-detailed-fill" href="internhomepage.php"> All Tickets</a>
            </li>
            <li class="nav-item " id="navblue">
                <a class="nav-link  bi bi-ticket-perforated-fill "href="internunassignedticket.php"> Unassigned Tickets</a>
            </li>
            <li class="nav-item" id="navwhite">
                <a class="nav-link bi bi-envelope-open-fill" href="internopenticket.php"> Open</a>
            </li>
            <li class="nav-item" id="navblue">
                <a class="nav-link bi bi-hourglass-split" href="internpendingticket.php"> Pending</a>
            </li>
            <li class="nav-item" id="navwhite">
                <a class="nav-link bi bi-bookmark-check-fill" href="internclosedticket.php"> Closed</a>
            </li>
            <li class="nav-item" id="navblue">
                <a class="nav-link bi bi-hourglass-split" href="creatingticket.php"> Create Ticket</a>
            </li>
            <li class="nav-item" id="navwhite">
                <a class="nav-link bi bi-trash-fill" href="internrecyclebin.php"> Recycle Bin</a>
            </li>
        </ul>
    </div>
    </div>
    </div>

    <!-- Content -->
<div class="container" id="content">
    <br>
    <h2>Create Ticket</h2>
    <div class="card mx-auto" id="ticketcardintern">
        <div class="card-header text-white" id="cardheader" style="background-color: #224375">
            Ticket Details
        </div>

        <form action="ticketprocess.php" method="POST">
        <div class="card-body">
            <div class="mb-3">
                <div class="row">
                    <div class="col-8">
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Subject" name="subject">
                    </div>

                    <div class="col-4">
                        <select class="form-select" aria-label="Default select example" name="category">
                            <option value="General">General</option>
                            <option value="Technical">Technical</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <textarea type="text" id="tickettextareaintern" class="form-control" rows="3" placeholder="Description" name="content"></textarea>
            </div>

            <div class="row mx-auto">
                <div class="col-8">
                    <a></a>
                </div>
                <div class="col-2">
                    <a class="btn btn-primary" href="creatingticket.php">Cancel</a>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                </div>
            </div>
        </div>
                <input type="hidden" class="form-control" id="current-date-time" name="timeStamp" readonly="true"> <!-- Date -->
        </form>

    </div>
</div>
<script>
    //passing the number of not viewed notifications from php to javascript
        var viewcount = "<?php echo $viewcounter ?>";

        if (viewcount !== "0") { //if there are notifications that is not viewed, the badge will be displayed
            document.getElementById('badge').style.display = 'block';
        } else {
            document.getElementById('badge').style.display = 'none';
        }

    // Script for timestamp (date)
    function getDateTime() {
        var now     = new Date();
        var year    = now.getFullYear();
        var month   = now.getMonth()+1;
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds();
        if(month.toString().length == 1) {
            month = '0'+month;
        }
        if(day.toString().length == 1) {
            day = '0'+day;
        }
        if(hour.toString().length == 1) {
            hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
            minute = '0'+minute;
        }
        if(second.toString().length == 1) {
            second = '0'+second;
        }
        var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;

        return dateTime;
    }
    setInterval(function(){
        let currentTime = getDateTime();
        document.getElementById("current-date-time").value = currentTime;
    }, 1000);

</script>
</body>
</html>

