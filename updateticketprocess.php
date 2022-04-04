<?php
//database connection
$con=mysqli_connect("localhost","root","","techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}
session_start();

    $tid=$_GET["tid"];
    $chosenuser = $_POST['supportuser'];
    echo $chosenuser;

    if (isset($_POST['submit'])){

        $UpdateTicket = "UPDATE tickets SET Personnel_ID='$chosenuser' WHERE TID='$tid'";
        mysqli_query($con, $UpdateTicket);
        header('location: adminhomepage.php');


    }
?>
