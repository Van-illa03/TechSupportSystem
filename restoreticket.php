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

    $fetchquery = "SELECT * FROM ticketbin WHERE Sender_ID='$currentuser' AND TID='$id'";
    $executequery = mysqli_query($con,$fetchquery);

    $tickets = mysqli_fetch_assoc($executequery);

    $ticketID = $tickets['TID'];
    $sender = $tickets['Sender_Name'];
    $sender_email = $tickets['Sender_Email'];
    $subject = $tickets['Subject'];
    $category = $tickets['Category'];
    $content = $tickets['Content'];
    $status = $tickets['Status'];
    $date = $tickets['Date'];
    $personnelassigned = $tickets['Personnel_ID'];


    $InsertTicket = "INSERT INTO tickets (TID,Sender_ID,Sender_Name, Sender_Email, Subject, Category, Content, Status, Date, Personnel_ID) 
                      VALUES('$ticketID','$currentuser','$sender','$sender_email','$subject','$category','$content','$status','$date','$personnelassigned')";
    mysqli_query($con, $InsertTicket);

    $delquery = "DELETE FROM ticketbin WHERE Sender_ID='$currentuser' AND TID='$id' LIMIT 1;";
    mysqli_query($con,$delquery);
?>
<script type="text/javascript">
    alert('Ticket restored.');
    window.location="internhomepage.php";
</script>
