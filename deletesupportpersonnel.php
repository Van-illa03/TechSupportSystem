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

    $zero = 0;
    $id=$_GET["id"];

    $UpdateTicket = "UPDATE tickets SET Personnel_ID='$zero' WHERE Personnel_ID='$id'";
    mysqli_query($con, $UpdateTicket);

    $UpdateTicket = "UPDATE ticketbin SET Personnel_ID='$zero' WHERE Personnel_ID='$id'";
    mysqli_query($con, $UpdateTicket);

    $delquery = "DELETE FROM supportteam WHERE UID='$id' LIMIT 1;";
    mysqli_query($con,$delquery);
?>
<script type="text/javascript">
    alert('Support Personnel Deleted.');
    window.location="adminhomepage.php";
</script>
