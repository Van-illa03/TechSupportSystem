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
    <script  type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--CDN for data tables -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
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


    <!-- Content (Table) -->
      <div id="content"  class="container">
          <br>
        <div class="container-fluid" id="content-container">
            <h2>Registered Support Personnel</h2>
             <table class="table table-hover table-bordered table-striped" style="border-color:#224375">
                 <!-- Table Header -->
                <thead>
                <tr id="tableRow">
                    <th scope="col" class="text-center">Personnel ID</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Company</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
            <?php
            // selecting all the support personnel data and displaying it by row
            $supportsql = "SELECT * FROM supportteam ORDER BY UID ASC";
            $supportresult = mysqli_query($con,$supportsql);

            while($supportusers = mysqli_fetch_assoc($supportresult)){ // fetching all the support personnel and displaying it through a while loop
                ?>
                <tr>
                <td class="text-center"> <?php echo $supportusers['UID'];?></td>
                <td class="text-center"><?php echo $supportusers['Name']; ?></td>
                <td class="text-center"><?php echo $supportusers['Email']; ?></td>
                <td><?php echo $supportusers['Company']; ?></td>
                <td class="text-center">
                    <a onclick="confirmation()" href="deletesupportpersonnel.php?id=<?php echo $supportusers['UID'];?>" class="View" title="Delete Personnel"><i class="bi bi-trash text-danger"></i></a>
                </td>
                </tr>
                <?php
                } //close while loop
                ?>
                </tbody>
                </table>
        </div>
      </div>
</div>

<script>
    //plugin that enables pagination on our tables
    $(document).ready(function (){
        $('table').DataTable();
    });

    //function that ask the user to confirm the deletion of a support personnel
    function confirmation() {
        var result = confirm('You are about to delete this user. Are you sure?');

        if (result == false) {
            event.preventDefault();
        }
    }
</script>
</body>
</html>