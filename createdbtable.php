<?php

$link=mysqli_connect("localhost","id19015714_techsupportadmin","rZf}z!K3@PZ^9Nt/","id19015714_techsupportsystem");
if (!$link) {
    echo "failed to connect";
    die();
}

// Make techsupportsystem the current database
$db_selected = mysqli_select_db($link,'techsupportsystem' );

if (!$db_selected) {
    // If we couldn't, then it either doesn't exist, or we can't see it.
    $sql = 'CREATE DATABASE techsupportsystem';

    //initializing the database
    if (mysqli_query($link, $sql)) {
    } else {

    }
}
mysqli_close($link);


$con=mysqli_connect("localhost","id19015714_techsupportadmin","rZf}z!K3@PZ^9Nt/","id19015714_techsupportsystem");
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
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS internuser (
            UID INT(254) NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(UID),
            Name    VARCHAR(255) NOT NULL,
            Email   VARCHAR(255)  NOT NULL,
            Password VARCHAR(255) NOT NULL,
            Company VARCHAR(255) NOT NULL
        )");
}

//initialize supportteam user table
if(empty($result2)){
    {
        $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS supportteam (
            UID INT(254) NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(UID),
            Name    VARCHAR(255) NOT NULL,
            Email   VARCHAR(255)  NOT NULL,
            Password VARCHAR(255) NOT NULL,
            Company VARCHAR(255) NOT NULL
        )");
    }
}

//initialize administrator table
if(empty($result3)){
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS administrator (
            UID INT(254) NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(UID),
            Name    VARCHAR(255) NOT NULL,
            Email   VARCHAR(255)  NOT NULL,
            Password VARCHAR(255) NOT NULL,
            Company VARCHAR(255) NOT NULL
        )");
}

//initialize codes table
if(empty($result4)){
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS codes (
            id INT(2) NOT NULL,
            SupportCode    VARCHAR(10) NOT NULL,
            AdminCode   VARCHAR(10)  NOT NULL
        )");
}

//initialize notifications table
if(empty($result5)){
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS notifications (
            NID INT(254) NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(NID),
            TID INT(254) NOT NULL,
            Ticket_Owner INT(254) NOT NULL,
            Content    VARCHAR(254) NOT NULL,
            ViewStatus  INT(2)  NOT NULL,
            date VARCHAR(254) NOT NULL
        )");
}

//initialize tickets table
if(empty($result6)){
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS tickets (
            TID INT(254) NOT NULL AUTO_INCREMENT,
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
    $query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ticketbin (
            itemID INT(254) NOT NULL AUTO_INCREMENT,
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
}

//fetching the codes from the database
$codequery = mysqli_query($con,"SELECT * FROM codes");
$getcodes = mysqli_fetch_assoc($codequery);

if (isset($getcodes['id'])){ //if id is set, it means that there is already an existing row for the code.
    //no arg
} else { //if the row id is not set, it means that the row is still not existing, so the code below initializes it
    $InitCode = "INSERT INTO codes (AdminCode,SupportCode,id)
                    VALUES('UIPadmin','UIPsupp',1)";
    mysqli_query($con, $InitCode);
}
    ?>