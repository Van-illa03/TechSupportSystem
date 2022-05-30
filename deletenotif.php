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

    //getting the motification id using URL parameter
    $nid=$_GET["nid"];

    //deleting the specific notification
    $delquery = "DELETE FROM notifications WHERE NID='$nid'";
    mysqli_query($con,$delquery);

    header('location: internhomepage.php');
?>

