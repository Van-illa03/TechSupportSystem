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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </style>
</head>

<body>
<?php
//query on getting the information of the current user that matches the id on the $currentuser variable
$userquery = mysqli_query($con,"SELECT * FROM supportteam WHERE UID='$currentuser'");
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
                <a class="nav-link bi bi-ticket-detailed-fill" href="supporthomepage.php"> All Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link bi bi-envelope-open-fill" href="supportopenticket.php"> Open</a>
            </li>
            <li class="nav-item" id="navblue">
                <a class="nav-link bi bi-hourglass-split" href="supportpendingticket.php"> Pending</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link bi bi-bookmark-check-fill" href="supportclosedticket.php"> Closed</a>
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
            <h2>View Ticket</h2>


            <div class="container">
                <div class="card mx-auto" id="ticketcardsupport">
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

                    <form action="updateticketsupport.php?tid=<?php echo $chosenTicket['TID'];?>" method="POST">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-9">
                                        <h4><?php echo $chosenTicket['Subject'];?> (<?php echo $chosenTicket['Category'];?>)</h4>
                                    </div>
                                    <div class="col-3">
                                        <select class="form-select" aria-label="Default select example" id="selectstatus" name="ticketstatus">
                                            <?php
                                            $currentstatus = $chosenTicket['Status'];

                                                ?>
                                                <option value="<?php echo $currentstatus; ?>" selected> <?php echo $currentstatus; ?> </option>

                                                <?php if ($currentstatus=="Open"){ ?>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Closed">Closed</option>
                                                <?php  }
                                                else if ($currentstatus=="Pending"){ ?>
                                                    <option value="Open">Open</option>
                                                    <option value="Closed">Closed</option>
                                            <?php  }
                                                else if ($currentstatus=="Closed"){ ?>
                                                    <option value="Open">Open</option>
                                                    <option value="Pending">Pending</option>
                                            <?php  } ?>
                                        </select>
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
                                <br>
                                <h5>Personnel Notes</h5>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter your notes/comments" name="note" ><?php echo $chosenTicket['Note'];?></textarea>
                            </div>
                            <div class="row mx-auto">
                                <hr style="height:2px; color:black;">
                                <div class="p-0 d-flex align-items-center">
                                    <h5>Initiate Email</h5>
                                    <input type="radio" id="yesemail" name="emailinit" style="margin-left: 10px; margin-right: 5px; margin-top:-3px;" value="yes" checked="true">
                                    <label for="yesemail" style="margin-top: -3px;">Yes</label>
                                    <input type="radio" id="noemail" name="emailinit" style="margin-left: 10px; margin-right: 5px; margin-top:-3px;" value="no" >
                                    <label for="noemail" style="margin-top: -3px;">No</label>
                                </div>
                                <div class="d-flex p-0 align-items-center">
                                    <p style="margin-top: 10px; font-size: 15px;" id="emaillabel">Recipient:</p><input type="email" class="form-control" id="emailto" rows="1" placeholder="Receipient Email" name="emailto" style="height:40px; width: 200px; margin-left: 10px;">
                                    <p style="margin-top: 10px; margin-left: 20px; font-size: 15px;" id="emailsubj">Subject:</p><input type="text" class="form-control" id="subject" rows="1" placeholder="Email Subject" name="subject" style="height:40px; width: 260px; margin-left: 10px;">
                                </div>

                                <textarea class="form-control" id="emailcontent" rows="3" placeholder="Enter Email Content Here" name="emailcontent"></textarea>
                            </div>
                            <br>
                            <div class="row mx-auto">
                                <div class="col-7 d-flex justify-content-start">
                                    <p style="margin-top:10px; margin-right:8px;">Re-assign to:   </p>
                                    <select class="form-select" aria-label="Default select example" id="selectsupport" name="supportuser">
                                        <?php
                                        $currentsupport = $chosenTicket['Personnel_ID'];
                                        $fetchassignedsupport = mysqli_query($con,"SELECT * FROM supportteam WHERE UID='$currentsupport'");
                                        $fetchsupports = mysqli_query($con,"SELECT * FROM supportteam");

                                        if ($currentsupport==0){?>
                                            <option value=0 selected>None</option>
                                            <?php while($supportslist = mysqli_fetch_assoc($fetchsupports)){ ?>
                                                <option value =<?php echo $supportslist['UID']; ?>>
                                                    <?php echo $supportslist['Name'];?>
                                                </option>
                                            <?php }
                                        }
                                        else {
                                            $assignedsupport = mysqli_fetch_assoc($fetchassignedsupport);?>
                                            <option value=<?php echo $assignedsupport['UID']; ?> selected> <?php echo $assignedsupport['Name']; ?> </option>

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
                                    <button class="btn btn-primary" type="submit" name="submit" style="height:40px; margin-top: 5px;">Save Changes</button>
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

    $('input[type=radio]').click(function(e) {//jQuery works on clicking radio box
        var value = $(this).val(); //Get the clicked checkbox value
        if (value == "yes"){
            document.getElementById('emailto').style.display = 'block';
            document.getElementById('emailcontent').style.display = 'block';
            document.getElementById('emaillabel').style.display = 'block';
            document.getElementById('subject').style.display = 'block';
            document.getElementById('emailsubj').style.display = 'block';
        }
        else {
            document.getElementById('emailto').style.display = 'none';
            document.getElementById('emailcontent').style.display = 'none';
            document.getElementById('emaillabel').style.display = 'none';
            document.getElementById('subject').style.display = 'none';
            document.getElementById('emailsubj').style.display = 'none';
        }
    });

    const name =  document.getElementById('emailto');

    // setting the value
    name.value = "<?php echo $chosenTicket['Sender_Email']; ?>";
</script>
</body>
</html>