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


    //checking if the submit button is set
    if (isset($_POST['submit'])){

        //getting the information of the current user to be included in ticket details
        $Query = mysqli_query($con,"SELECT * FROM internuser WHERE UID='$currentuser' LIMIT 1");
        $QueryResult= mysqli_fetch_assoc($Query);
        $sender = $QueryResult['Name'];
        $sender_email = $QueryResult['Email'];

        //getting the form inputs
        $subject = $_POST['subject'];
        $category = $_POST['category'];
        $content = $_POST['content'];
        $date = $_POST['timeStamp'];
        $open = "Open";
        $note = "";



        //inserting the ticket data into the database
        $InsertTicket = "INSERT INTO tickets (Sender_ID,Sender_Name, Sender_Email, Subject, Category, Content, Status, Date, Personnel_ID, Note) 
                      VALUES ('$currentuser','$sender','$sender_email','$subject','$category','$content','$open','$date',0,'$note');";
        mysqli_query($con, $InsertTicket);
        echo '<script type="text/javascript">
        alert("Ticket successfully submitted.");
        window.location="internhomepage.php";
        </script>';

    }
?>

