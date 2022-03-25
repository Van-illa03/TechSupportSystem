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
<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <a class ="navbar-brand"disabled> <img id="logo" src="images/uiplogo.png" alt="MAV Logo" class ="logo px-auto">Automated Technical Support System</a>
    </div>
</nav>
<br>
<br>

<div class="container" >
    <div class="card mx-auto" id="ticketcard">
        <div class="card-header text-white" id="cardheader" style="background-color: #224375">
            Create Ticket
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
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description" name="content"></textarea>
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
        </form>

    </div>
</div>

</body>
</html>
