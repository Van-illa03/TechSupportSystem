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

    //getting the ticket id using URL parameter
    $id=$_GET["id"];

    //fetching the ticket data on the ticketbin table
    $fetchquery = "SELECT * FROM ticketbin WHERE Sender_ID='$currentuser' AND TID='$id'";
    $executequery = mysqli_query($con,$fetchquery);

    $tickets = mysqli_fetch_assoc($executequery);

    //putting the ticket details on variables. This is needed when we will put back the ticket in the tickets table
    $ticketID = $tickets['TID'];
    $sender = $tickets['Sender_Name'];
    $sender_email = $tickets['Sender_Email'];
    $subject = $tickets['Subject'];
    $category = $tickets['Category'];
    $content = $tickets['Content'];
    $status = $tickets['Status'];
    $date = $tickets['Date'];
    $personnelassigned = $tickets['Personnel_ID'];


    //since we will be restoring the deleted ticket, we will insert its details again in the tickets table
    $InsertTicket = "INSERT INTO tickets (TID,Sender_ID,Sender_Name, Sender_Email, Subject, Category, Content, Status, Date, Personnel_ID) 
                      VALUES('$ticketID','$currentuser','$sender','$sender_email','$subject','$category','$content','$status','$date','$personnelassigned')";
    mysqli_query($con, $InsertTicket);

    //when the insertion is done, we can now delete the ticket recorc on the ticket bin, since it is already restored
    $delquery = "DELETE FROM ticketbin WHERE Sender_ID='$currentuser' AND TID='$id' LIMIT 1;";
    mysqli_query($con,$delquery);
?>
<script type="text/javascript">
    alert('Ticket restored.');
    window.location="internhomepage.php";
</script>
