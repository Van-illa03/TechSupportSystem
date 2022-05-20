<?php
require ("PHPMailer/src/PHPMailer.php");
require ("PHPMailer/src/SMTP.php");

//database connection
$con=mysqli_connect("localhost","root","","techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}
session_start();

    $tid=$_GET["tid"];
    $chosenuser = $_POST['supportuser'];
    $tixstatus = $_POST['ticketstatus'];
    $note = trim($_POST['note']);

    $currentticketquery = "SELECT * FROM tickets WHERE TID='$tid'";
    $fetchcurrentticket = mysqli_query($con,$currentticketquery);

    $currentticket = mysqli_fetch_assoc($fetchcurrentticket);
    $fetchednote = trim($currentticket['Note']);
    $fetchedstatus = $currentticket['Status'];
    $fetchedSenderID = $currentticket['Sender_ID'];



    if (isset($_POST['submit'])){
        //comparing notes from db and submitted form
        if ($fetchednote == null){ //if note from db is null
            if ($note != null){ //if note from form is not null
                $NotifContent = "The support team added notes on your ticket (Ticket no. ".$tid.").\n";
            }
            else {
                //no arg
            }
        } else {

        //comparing ticket status from db and submitted form
        if ($fetchednote == $note) {
                //no arg
            }
            else {
                $NotifContent = "The support team updated your ticket (Ticket no. ".$tid.").\n";
            }
        }

        if($fetchedstatus != $tixstatus){
            $status = "Ticket status changed from ".$fetchedstatus." to ".$tixstatus;
            $NotifContent .= $status;
        }

        if ($NotifContent != null) {
            $InsertNotif = "INSERT INTO notifications (TID,Ticket_Owner,Content,ViewStatus) 
                      VALUES('$tid','$fetchedSenderID','$NotifContent',0)";
            mysqli_query($con, $InsertNotif);
        }


        $UpdateTicket = "UPDATE tickets SET Personnel_ID='$chosenuser',Status='$tixstatus',Note='$note' WHERE TID='$tid'";
        mysqli_query($con, $UpdateTicket);
        $emailcontent = $_POST['emailcontent'];

        if ($emailcontent != null){
            $mailto = $_POST['emailto'];
            $subject = $_POST['subject'];
             if ($subject == null) {
                 $subject = "Undefined Subject";
             }


            $mail = new \PHPMailer\PHPMailer\PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;

            //if you happen to create new smtp2go account, you can input the new username and password you provided in their dashboard.
            $mail->Username = "uiptechsuppsys@gmail.com";
            $mail->Password = "uiptechsuppadmin1";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->From = "techsupport@melhamconstruction.ph";
            $mail->FromName = "UIP Technical Support";
            $mail->addAddress($mailto,"Intern");
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $emailcontent;
            $mail->AltBody = "Email Content";

            if (!$mail->send()){
                echo "Mailer Error: ".$mail->ErrorInfo;
            }
            else {
                echo "Email has been sent";
            }
        }

        header('location: supporthomepage.php');
    }
?>
