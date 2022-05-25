<?php
//database connection
$con=mysqli_connect("localhost","root","","techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}
session_start();

    if (isset($_POST['submit'])){
        $uid=$_GET["id"];
        $query = "SELECT * FROM internuser WHERE UID='$uid'";
        $fetchinterndata = mysqli_query($con, $query);
        $interndata = mysqli_fetch_assoc($fetchinterndata);

        $name = $_POST['name'];
        $changepass = $_POST['passchange'];

        $currentpass = $_POST['currentpass'];
        $newpass = $_POST['newpass'];


        if ($name != ""){
            if ($name == $interndata['Name']){

            }
        }
        else{
            header('location: internprofile.php?error=Name cannot be empty.');
        }


    }
?>
