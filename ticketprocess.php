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



    if (isset($_POST['submit'])){

        $Query = mysqli_query($con,"SELECT * FROM internuser WHERE UID='$currentuser' LIMIT 1");
        $QueryResult= mysqli_fetch_assoc($Query);
        $sender = $QueryResult['Name'];
        $sender_email = $QueryResult['Email'];
        $subject = $_POST['subject'];
        $category = $_POST['category'];
        $content = $_POST['content'];
        $date = $_POST['timeStamp'];




        $InsertTicket = "INSERT INTO tickets (Sender_ID,Sender_Name, Sender_Email, Subject, Category, Content, Status, Date, Personnel_ID) 
                      VALUES('$currentuser','$sender','$sender_email','$subject','$category','$content','Open','$date',0)";
        mysqli_query($con, $InsertTicket);

    }
?>
<script type="text/javascript">
    alert('Ticket successfully submitted.');
    window.location="internhomepage.php";
</script>
