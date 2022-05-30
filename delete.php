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

    //fetching the ticket data
    $fetchquery = "SELECT * FROM tickets WHERE Sender_ID='$currentuser' AND TID='$id'";
    $executequery = mysqli_query($con,$fetchquery);

    $tickets = mysqli_fetch_assoc($executequery);

    //assigning the ticket data to PHP variables
    $ticketID = $tickets['TID'];
    $sender = $tickets['Sender_Name'];
    $sender_email = $tickets['Sender_Email'];
    $subject = $tickets['Subject'];
    $category = $tickets['Category'];
    $content = $tickets['Content'];
    $status = $tickets['Status'];
    $date = $tickets['Date'];
    $personnelassigned = $tickets['Personnel_ID'];
    $note = $tickets['Note'];

    //Since this ticket is being deleted, we will be inserting it on the recycle bin
    $InsertTicket = "INSERT INTO ticketbin (TID,Sender_ID,Sender_Name, Sender_Email, Subject, Category, Content, Status, Date, Personnel_ID,Note) 
                      VALUES('$ticketID','$currentuser','$sender','$sender_email','$subject','$category','$content','$status','$date','$personnelassigned','$note')";
    mysqli_query($con, $InsertTicket);


    //after insertion on the recycle bin, we can now delete it on the tickets table
    $delquery = "DELETE FROM tickets WHERE Sender_ID='$currentuser' AND TID='$id' LIMIT 1;";
    mysqli_query($con,$delquery);
?>
<script type="text/javascript">
    alert('Ticket deleted and was moved to recycle bin.');
    window.location="internhomepage.php";
</script>
