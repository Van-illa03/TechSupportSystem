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
    <script type="text/javascript" src="jquery.bootpag.js"></script>
    <script  type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <a class ="navbar-brand"disabled> <img id="logo" src="images/uiplogo.png" alt="MAV Logo" class ="logo px-auto">Automated Technical Support System</a>
    <ul class="navbar-nav">
      <li class="nav-item">
      </li>
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

    <!-- Sidebar -->
    <div class id="sidebar">
        <header>
            <p></p>
        </header>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link bi bi-ticket-detailed-fill" href="adminhomepage.php"> All Tickets</a>
            </li>
            <li class="nav-item " id="navblue">
                <a class="nav-link  bi bi-ticket-perforated-fill "href="adminunassignedticket.php"> Unassigned Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link bi bi-envelope-open-fill" href="adminopenticket.php"> Open</a>
            </li>
            <li class="nav-item" id="navblue">
                <a class="nav-link bi bi-hourglass-split" href="adminpendingticket.php"> Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link bi bi-bookmark-check-fill" href="adminclosedticket.php"> Closed</a>
            </li>
        </ul>
    </div>

  <!-- Content -->
      <div id="content">
          <br>
        <div class="container-fluid" id="content-container">
            <h2>All Tickets</h2>
             <table class="table table-hover table-bordered table-striped" style="border-color:#224375">
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

            $row = 0;
            // number of rows per page
            $rowperpage = 5;

            if(isset($_POST['num_rows'])){
                $rowperpage = $_POST['num_rows'];
            }

            // Previous Button
            if(isset($_POST['but_prev'])){
                $row = $_POST['row'];
                $row -= $rowperpage;
                if( $row < 0 ){
                    $row = 0;
                }
            }

            // Next Button
            if(isset($_POST['but_next'])){
                $row = $_POST['row'];
                $allcount = $_POST['allcount'];

                $val = $row + $rowperpage;
                if( $val < $allcount ){
                    $row = $val;
                }
            }

            // count total number of rows
            $sql = "SELECT COUNT(*) AS rowcount FROM tickets";
            $result = mysqli_query($con,$sql);
            $fetchresult = mysqli_fetch_array($result);
            $allcount = $fetchresult['rowcount'];

            // selecting rows
            $ticketsql = "SELECT * FROM tickets  ORDER BY TID ASC limit $row,".$rowperpage;
            $sqlresult = mysqli_query($con,$ticketsql);
            $rowcounter = $row + 1;


            while($tickets = mysqli_fetch_array($sqlresult)){
                $assignedsupp=$tickets['Personnel_ID'];
                if ($assignedsupp == 0){
                    $getassignedsupp['Name']="None";
                } else {
                    $fetchassignedsupp = mysqli_query($con,"SELECT Name FROM supportteam WHERE UID='$assignedsupp'");
                    $getassignedsupp = mysqli_fetch_assoc($fetchassignedsupp);
                }
                ?>

                <tr data-index="<?php echo $rowcounter;?>">
                    <td class="text-center"> <?php echo $tickets['TID'];?></td>
                <td class="text-center"><?php echo $tickets['Sender_ID']; ?></td>
                <td class="text-center"><?php echo $tickets['Sender_Name']; ?></td>
                <td><?php echo $tickets['Subject']; ?></td>
                <td class="text-center"><?php echo $tickets['Category']; ?></td>
                <td class="text-center"><?php echo $tickets['Status']; ?></td>
                <td><?php echo $tickets['Content']; ?></td>
                <td class="text-center"><?php echo $getassignedsupp['Name']; ?></td>
                <td class="text-center"><?php echo $tickets['Date']; ?></td>
                <td class="text-center"><a href="viewticketadmin.php?id=<?php echo $tickets['TID'];?>" class="View" title="View Ticket"><button class="btn btn-primary btn-mini "><i class="bi bi-eye-fill"></i></i></button></a>
                </td>

                </tr>

                <?php
            $rowcounter = $rowcounter+1;
            }
            ?>
                </tbody>
                </table>
        </div>
      </div>
    <div id="page-selection">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-start">

                <form method="post" action="" id="pagform">
                    <div id="div_pagination">
                        <input type="hidden" name="row" value="<?php echo $rowcounter; ?>">
                        <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
                        <input type="submit" class="button" name="but_prev" value="Previous">
                        <input type="submit" class="button" name="but_next" value="Next">

                        <!-- Number of rows -->
                        <div class="divnum_rows">
                            <span class="paginationtextfield">Number of rows:</span>&nbsp;

                            <select id="num_rows" name="num_rows">
                                <?php
                                $numrows_arr = array("5","10","25","50","100","250");
                                foreach($numrows_arr as $nrow){
                                    if(isset($_POST['num_rows']) && $_POST['num_rows'] == $nrow){
                                        echo '<option value="'.$nrow.'" selected="selected">'.$nrow.'</option>';
                                    }else{
                                        echo '<option value="'.$nrow.'">'.$nrow.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <script>
                                $(document).ready(function(){
                                    // Number of rows selection
                                    $("#num_rows").change(function(){
                                        // Submitting form
                                        $("#pagform").submit();

                                    });
                                });
                            </script>
                        </div>
                    </div>
                </form>
            </ul>
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>
    // init bootpag
    $('#page-selection').bootpag({
        total: 1000
        page: 1
        maxVisible: 3
    }).on("page", function(event, num){
        $("#content").html("Insert content"); // some ajax content loading...
    });
</script>

</body>
</html>