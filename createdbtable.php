<?php

$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "failed to connect";
    die();
}

// Make techsupportsystem the current database
$db_selected = mysqli_select_db($link,'techsupportsystem' );

if (!$db_selected) {
    // If we couldn't, then it either doesn't exist, or we can't see it.
    $sql = 'techsupportsystem';

    //initializing the database
    if (mysqli_query($link, $sql)) {
        echo "Database my_db created successfully\n";
    } else {

    }
}
mysqli_close($link);


$con=mysqli_connect("localhost","root","","techsupportsystem");
if (!$con){
    echo "failed to connect";
    die();
}

$tableIntern ="internuser" ;
$tableSupport ="supportteam" ;
$tableAdmin ="administrator" ;
$tableCodes ="codes";
$tableNotifications = "notifications";
$tableTickets = "tickets";
$tableTicketbin = "ticketbin";

$queryTableIntern ="SELECT * FROM ".$tableIntern ;
$queryTableSupport ="SELECT * FROM ".$tableSupport;
$queryTableAdmin ="SELECT * FROM ".$tableAdmin;
$queryTableCodes = "SELECT * FROM ".$tableCodes;
$queryTableNotification = "SELECT * FROM ".$tableNotifications;
$queryTableTickets = "SELECT * FROM ".$tableTickets;
$queryTableTicketbin = "SELECT * FROM ".$tableTicketbin;


$result = $con->query($queryTableIntern);
$result2 = $con->query($queryTableSupport);
$result3 = $con->query($queryTableAdmin);
$result4 = $con->query($queryTableCodes);
$result5 = $con->query($queryTableNotification);
$result6 = $con->query($queryTableTickets);
$result7 = $con->query($queryTableTicketbin);

//initialize intern user table
if(empty($result)) {
    echo "<p>" . $tableIntern . " table does not exist. Creating now...</p><br>";
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS internuser (
            id INT NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            name    VARCHAR(255) NOT NULL,
            email   VARCHAR(255)  NOT NULL,
            password VARCHAR(255) NOT NULL,
            company VARCHAR(255) NOT NULL
        )");
}

//initialize supportteam user table
if(empty($result2)){
    {
        echo "<p>" . $tableSupport . " table does not exist. Creating now...</p><br>";
        $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS supportteam (
            id INT NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            name    VARCHAR(255) NOT NULL,
            email   VARCHAR(255)  NOT NULL,
            password VARCHAR(255) NOT NULL,
            company VARCHAR(255) NOT NULL
        )");
    }
}

//initialize administrator table
if(empty($result3)){
    echo "<p>" . $tableAdmin . " table does not exist. Creating now...</p><br>";
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS administrator (
            id INT NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            name    VARCHAR(255) NOT NULL,
            email   VARCHAR(255)  NOT NULL,
            password VARCHAR(255) NOT NULL,
            company VARCHAR(255) NOT NULL
        )");
}

//initialize codes table
if(empty($result4)){
    echo "<p>" . $tableCodes . " table does not exist. Creating now...</p><br>";
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS codes (
            id INT(2) NOT NULL,
            SupportCode    VARCHAR(10) NOT NULL,
            AdminCode   VARCHAR(10)  NOT NULL,
        )");
}

//initialize notifications table
if(empty($result5)){
    echo "<p>" . $tableNotifications . " table does not exist. Creating now...</p><br>";
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS notifications (
            NID INT NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(NID),
            TID INT(254) NOT NULL,
            Ticket_Owner INT(254) NOT NULL,
            Content    VARCHAR(254) NOT NULL,
            ViewStatus  INT(2)  NOT NULL,
            date VARCHAR(254) NOT NULL,
        )");
}

//initialize tickets table
if(empty($result6)){
    echo     "<p>" . $tableTickets . " table does not exist. Creating now...</p><br>";
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS tickets (
            TID INT NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(TID),
            Sender_ID INT(254) NOT NULL,
            Sender_Name VARCHAR(254) NOT NULL,
            Sender_Email   VARCHAR(254) NOT NULL,
            Subject  VARCHAR(254) NOT NULL,
            Category VARCHAR(254) NOT NULL,
            Content VARCHAR(254) NOT NULL,
            Personnel_ID INT(254) NOT NULL,
            Status VARCHAR(254) NOT NULL,
            Date VARCHAR(254) NOT NULL,
            Note VARCHAR(254) NOT NULL
        )");
}

//initialize ticketbin table
if(empty($result7)){
    echo     "<p>" . $tableTicketbin . " table does not exist. Creating now...</p><br>";
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ticketbin (
            itemID INT NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(itemID),
            TID INT(254) NOT NULL,  
            Sender_ID INT(254) NOT NULL,
            Sender_Name VARCHAR(254) NOT NULL,
            Sender_Email   VARCHAR(254) NOT NULL,
            Subject  VARCHAR(254) NOT NULL,
            Category VARCHAR(254) NOT NULL,
            Content VARCHAR(254) NOT NULL,
            Personnel_ID INT(254) NOT NULL,
            Status VARCHAR(254) NOT NULL,
            Date VARCHAR(254) NOT NULL,
            Note VARCHAR(254) NOT NULL
        )");
}

else{
    echo "<p>all required tables exists</p>";
}