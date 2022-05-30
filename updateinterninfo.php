<?php
//database connection
$con=mysqli_connect("localhost","id19015714_techsupportadmin","rZf}z!K3@PZ^9Nt/","id19015714_techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}
session_start();

    if (isset($_POST['submit'])){
        $uid=$_GET["id"]; //intern user ID through URL parameter

        //fetching intern data from database
        $query = "SELECT * FROM internuser WHERE UID='$uid'";
        $fetchinterndata = mysqli_query($con, $query);
        $interndata = mysqli_fetch_assoc($fetchinterndata);

        //fetching form inputs
        $name = $_POST['name'];
        $currentpass = $_POST['currentpass'];
        $newpass = $_POST['newpass'];

        //updating the name
        if ($name != ""){ //if name field is not empty
            if ($name != $interndata['Name']){
                $namequery = "UPDATE internuser SET Name='$name' WHERE UID='$uid'";
                mysqli_query($con,$namequery);
            }
        }
        else{ //if name field is empty
            header('location: internprofile.php?error=Name cannot be empty.');
        }

        //updating the password
        if (isset($_POST['passchange'])){ //if the radio button has value
            $changepass = $_POST['passchange'];

            if ($changepass == "yes") { //if the radio button value is yes
                if ($currentpass == $interndata['Password']){
                    if ($currentpass != $newpass){ //if the current password is not the same as the new password
                        $passquery = "UPDATE internuser SET Password='$newpass' WHERE UID='$uid'";
                        mysqli_query($con,$passquery);

                        //goes back to intern profile page
                        echo '<script type="text/javascript">alert("Your information has been updated")
                    window.location.replace("internprofile.php");
                    </script>';
                    }
                    else {
                        header("location: internprofile.php?error=Current password and new password is the same.");
                    }
                }
                else {
                    header("location: internprofile.php?error=Current password does not match.");
                }

            }
            else {
                echo '<script type="text/javascript">alert("Your information has been updated")
                    window.location.replace("internprofile.php");
                    </script>';
            }
        }


    }
?>
