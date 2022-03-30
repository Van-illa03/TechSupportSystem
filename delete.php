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


    $id=$_GET["id"];

    $delquery = "DELETE FROM tickets WHERE Sender_ID='$currentuser' AND TID='$id' LIMIT 1;";
    mysqli_query($con,$delquery);
?>
<script type="text/javascript">
    alert('Ticket Deleted.');
    window.location="internhomepage.php";
</script>
