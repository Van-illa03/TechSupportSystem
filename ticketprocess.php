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
        $subject = $_POST['subject'];
        $category = $_POST['category'];
        $content = $_POST['content'];
        $date = $_POST['timeStamp'];




        $InsertTicket = "INSERT INTO tickets (Sender_ID,Sender_Name, Subject, Category, Content, Date) 
                      VALUES('$currentuser','$sender','$subject','$category','$content','$date')";
        mysqli_query($con, $InsertTicket);

    }
?>
<script type="text/javascript">
    alert('Ticket successfully submitted.');
    window.location="internhomepage.php";
</script>
