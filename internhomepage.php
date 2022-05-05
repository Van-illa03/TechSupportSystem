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
$userquery = mysqli_query($con,"SELECT Name,Email,UID,Company FROM internuser WHERE UID='$currentuser'");
$getcurrentuser = mysqli_fetch_assoc($userquery);
?>
<nav class="navbar navbar-expand-lg">
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
                </ul>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div id="content" class="container">
        <br>
        <div class="container" id="content-container">
            <h2>All Tickets</h2>
            <table class="table table-hover table-bordered table-striped" style="border-color:#224375" id="dtHorizontalExample" >
                <thead>
                <tr id="tableRow">
                    <th scope="col">Ticket ID</th>
                    <th scope="col">Sender ID</th>
                    <th scope="col">Sender Name</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Content</th>
                    <th scope="col">Personnel Assigned</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $getTickets = mysqli_query($con,"SELECT * FROM tickets WHERE Sender_ID='$currentuser'");

                while($tickets = mysqli_fetch_assoc($getTickets)){
                    $assignedsupp = $tickets['Personnel_ID'];
                    if ($assignedsupp == 0){
                        $getassignedsupp['Name']="None";
                    } else {
                        $fetchassignedsupp = mysqli_query($con,"SELECT Name FROM supportteam WHERE UID='$assignedsupp'");
                        $getassignedsupp = mysqli_fetch_assoc($fetchassignedsupp);
                    }
                    ?>
                    <tr>
                        <td class="text-center"> <?php echo $tickets['TID'];?></td>
                        <td class="text-center"><?php echo $tickets['Sender_ID']; ?></td>
                        <td class="text-center"><?php echo $tickets['Sender_Name']; ?></td>
                        <td><?php echo $tickets['Subject']; ?></td>
                        <td class="text-center"><?php echo $tickets['Category']; ?></td>
                        <td class="text-center"><?php echo $tickets['Status']; ?></td>
                        <td><?php echo $tickets['Content']; ?></td>
                        <td class="text-center"><?php echo $getassignedsupp['Name']; ?></td>
                        <td class="text-center"><?php echo $tickets['Date']; ?></td>
                        <td class="text-center"><a href="delete.php?id=<?php echo $tickets['TID'];?>" class="delete" title="Delete Ticket"><i class="bi bi-trash text-danger"></i></a>
                            <a href="viewticket.php?id=<?php echo $tickets['TID'];?>" class="View" title="View Ticket"><i class="bi bi-eye-fill text-primary"></i></i></a>
                        </td>
                    </tr>


                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<script>
    $(document).ready(function (){
        $('table').DataTable({
        });

        $('.dataTables_length').addClass('bs-select');
    });
</script>
</body>
</html>