<?php
// DB connection info
$host = "eu-cdbr-azure-north-c.cloudapp.net";
$user = "be787757308987";
$pwd = "a435f8ab";
$db = "APL";
// Connect to database.
try {
    $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));
}
?>