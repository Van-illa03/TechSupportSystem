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
    <a class ="navbar-brand"disabled> <img id="logo" src="images/uiplogo.png" alt="MAV Logo" class ="logo px-auto">Automated Technical Support System</a>
    <ul class="navbar-nav">
      <li class="nav-item">
      </li>
        <li class="nav-item">
        <p class="nav-link" disabled><?php echo $getcurrentuser['Name']?></p>
        </li>
      <li class="nav-item">
        <a class="nav-link  "href="login.php">LOG OUT</a>
      </li>

    </ul>
  </div>
</nav>

<div id="viewport">

  <!-- Sidebar -->
  <div class id="sidebar">
    <header>
      <p></p>
    </header>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link bi bi-ticket-detailed-fill" href="#"> All Tickets</a>
      </li>
      <li class="nav-item " id="navblue">
        <a class="nav-link  bi bi-ticket-perforated-fill "href="#"> Unassigned Tickets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bi bi-envelope-open-fill" href="#"> Open</a>
      </li>
      <li class="nav-item" id="navblue">
        <a class="nav-link bi bi-hourglass-split" href="#"> Pending</a>
      </li>
      <li class="nav-item" >
        <a class="nav-link bi bi-bookmark-check-fill" href="#"> Closed</a>
      </li>
        <li class="nav-item" id="navblue">
            <a class="nav-link bi bi-hourglass-split" href="creatingticket.php"> Create Ticket</a>
        </li>

    </ul>
  </div>

  <!-- Content -->
  <div id="content">
    <div class="container-fluid pt-3 shadow-sm" id="content-container">
      <h2> *Choosen Tab*</h2>
    </div>
  </div>
</div>

</body>
</html>