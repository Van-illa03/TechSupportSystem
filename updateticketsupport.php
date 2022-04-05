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
    $tixstatus = $_POST['ticketstatus'];
    $note = $_POST['note'];

    if (isset($_POST['submit'])){

        $UpdateTicket = "UPDATE tickets SET Personnel_ID='$chosenuser',Status='$tixstatus',Note='$note' WHERE TID='$tid'";
        mysqli_query($con, $UpdateTicket);
        header('location: supporthomepage.php');


    }
?>
