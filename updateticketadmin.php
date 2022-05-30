<?php
//database connection
$con=mysqli_connect("localhost","root","","techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}
session_start();

    //getting the ticket id using URl parameter
    $tid=$_GET["tid"];

    //getting the chosen support user from the dropdown
    $chosenuser = $_POST['supportuser'];

    if (isset($_POST['submit'])){

        //updating the ticket --> changing the personnel ID to the id of the chosen support personnel
        $UpdateTicket = "UPDATE tickets SET Personnel_ID='$chosenuser' WHERE TID='$tid'";
        mysqli_query($con, $UpdateTicket);
        header('location: adminhomepage.php');


    }
?>
