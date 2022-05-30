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

    //getting the motification id using URL parameter
    $nid=$_GET["nid"];

    //deleting the specific notification
    $delquery = "DELETE FROM notifications WHERE NID='$nid'";
    mysqli_query($con,$delquery);

    header('location: internhomepage.php');
?>

