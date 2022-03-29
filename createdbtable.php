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

    if (mysqli_query($link, $sql)) {
        echo "Database my_db created successfully\n";
    } else {

    }
}
mysqli_close($link);


$con=mysqli_connect("localhost","root","","TechSupportSystem");
if (!$con){
    echo "failed to connect";
    die();
}

$tableIntern ="internuser" ;
$tableSupport ="supportteam" ;
$tableAdmin ="administrator" ;

$queryTableIntern ="SELECT * FROM ".$tableIntern ;
$queryTableSupport ="SELECT * FROM ".$tableSupport;
$queryTableAdmin ="SELECT * FROM ".$tableAdmin;


$result = $con->query($queryTableIntern);
$result2 = $con->query($queryTableSupport);
$result3 = $con->query($queryTableAdmin);

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

else{
    echo "<p>all required tables exists</p>";
}