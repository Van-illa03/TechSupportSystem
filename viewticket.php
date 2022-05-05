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
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item "href="login.php" id="logout">Log Out</a></li>
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

        </ul>
    </div>
    </div>
    </div>

    <?php
    $id=$_GET["id"];
    $getTickets = mysqli_query($con,"SELECT * FROM tickets WHERE TID='$id'");
    $chosenTicket = mysqli_fetch_array($getTickets)
    ?>
  <!-- Content -->
      <div id="content" class="container">
          <br>
        <div class="container-fluid" id="content-container">
            <h2 class="text-center">View Ticket</h2>


            <div class="container">
                <div class="card mx-auto" id="ticketcard">
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
                                    <a href="delete.php?id=<?php echo $chosenTicket['TID'];?>" class="delete" title="Delete Ticket"><button class="btn btn-danger" type="submit" name="submit">Delete</button>
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