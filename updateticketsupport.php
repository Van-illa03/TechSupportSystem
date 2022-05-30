<?php
require ("PHPMailer/src/PHPMailer.php");
require ("PHPMailer/src/SMTP.php");
require ('PHPMailer/src/Exception.php');

//database connection
$con=mysqli_connect("localhost","id19015714_techsupportadmin","rZf}z!K3@PZ^9Nt/","id19015714_techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}
session_start();

    //getting the ticket id using URL parameter
    $tid=$_GET["tid"];
    //getting form inputs
    $chosenuser = $_POST['supportuser'];
    $tixstatus = $_POST['ticketstatus'];
    $note = trim($_POST['note']);
    $date = $_POST['timeStamp'];

    //fetching ticket using the ticket id retrieved from URl parameter
    $currentticketquery = "SELECT * FROM tickets WHERE TID='$tid'";
    $fetchcurrentticket = mysqli_query($con,$currentticketquery);

    //assigning the ticket details to variables
    $currentticket = mysqli_fetch_assoc($fetchcurrentticket);
    $fetchednote = trim($currentticket['Note']);
    $fetchedstatus = $currentticket['Status'];
    $fetchedSenderID = $currentticket['Sender_ID'];
    $NotifContent = "";


    //notification code starts here
    //this code check if any changes were made
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
            $status = "Ticket status changed from ".$fetchedstatus." to ".$tixstatus.".";
            $NotifContent .= $status;
        }

        if ($NotifContent != "") {
            //inserting new notifications
            $InsertNotif = "INSERT INTO notifications (TID,Ticket_Owner,Content,ViewStatus,date) 
                      VALUES('$tid','$fetchedSenderID','$NotifContent',0,'$date')";
            mysqli_query($con, $InsertNotif);
        }


        $UpdateTicket = "UPDATE tickets SET Personnel_ID='$chosenuser',Status='$tixstatus',Note='$note' WHERE TID='$tid'";
        mysqli_query($con, $UpdateTicket);
        $emailcontent = $_POST['emailcontent'];



    //SMTP mailing starts here
    if (isset($_POST['emailinit'])) {
        //if the radio button has value
        $sendemail = $_POST['emailinit'];

        if ($sendemail == "yes") {
            if ($emailcontent != null){
                $mailto = $_POST['emailto'];
                $subject = $_POST['subject'];
                if ($subject == null) {
                    $subject = "Undefined Subject";
                }

                //PHP mailer
                $mail = new \PHPMailer\PHPMailer\PHPMailer();

                //default config of sending email using PHP mailer and Gmail SMTP
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "techsuppsysUIP@gmail.com";
                $mail->Password = "quetzalcoatl";
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
                    echo '<script>alert("Ticket Updated Successfully.")
                window.location.replace("supporthomepage.php");
                </script>';
                }
                } else {
                    header('location: supporthomepage.php');
                }
            }
        else { // if $sendemail is not equal to yes
            header('location: supporthomepage.php');
        }
        }
        else { //if $_POST['emailinit'] is not set
            header('location: supporthomepage.php');
        }
    }
?>
