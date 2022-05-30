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

    //getting the ticket id using URL parameter
    $id=$_GET["id"];

    //since this is permanent deletion of ticket, we will delete the ticket details on the ticket bin
    $delquery = "DELETE FROM ticketbin WHERE Sender_ID='$currentuser' AND TID='$id' LIMIT 1;";
    mysqli_query($con,$delquery);
?>
<script type="text/javascript">
    alert('Ticket Permanently Deleted.');
    window.location="internhomepage.php";
</script>
