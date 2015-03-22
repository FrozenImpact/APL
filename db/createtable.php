<?php
// azure DB connection info
$host = "eu-cdbr-azure-north-c.cloudapp.net";
$user = "be787757308987";
$pwd = "a435f8ab";
$db = "APL";
// DB connection
/*$host = "localhost";
$user = "root";
$pwd = "";
$db = "apl";*/
try{
    $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
 /*   $sql3 = "CREATE TABLE User (
                ID int NOT NULL ,
                Name varchar(50) NOT NULL ,
                Joined TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                CONSTRAINT User_pk PRIMARY KEY (ID)
            )";

     $sql = "CREATE TABLE Comment (
                ID int    NOT NULL ,
               Content text    NOT NULL ,
               User_ID int    NOT NULL ,
               Posted timestamp    NOT NULL ,
               Post_ID int    NOT NULL ,
               CONSTRAINT Comment_pk PRIMARY KEY (ID)
            )";
     $sql2 = "CREATE TABLE Post (
               ID int    NOT NULL ,
               Description varchar(100)    NOT NULL ,
               User_ID int    NOT NULL ,
               Posted timestamp    NOT NULL ,
               CONSTRAINT Post_pk PRIMARY KEY (ID)
            )";*/
    /*$createclass = "CREATE TABLE Class (
              ID int    NOT NULL  AUTO_INCREMENT,
              Name int    NOT NULL ,
             CONSTRAINT Class_pk PRIMARY KEY (ID)
          )";*/
    $addpw = "ALTER TABLE User ADD COLUMN Password BINARY(200) NOT NULL";
    $autoincr1 = "ALTER TABLE User MODIFY ID INTEGER NOT NULL AUTO_INCREMENT";
    $autoincr2 = "ALTER TABLE Comment MODIFY ID INTEGER NOT NULL AUTO_INCREMENT";
    $autoincr3 = "ALTER TABLE Post MODIFY ID INTEGER NOT NULL AUTO_INCREMENT";
            
    
    //$conn->query($createclass);
    $conn->query($addpw);
    $conn->query($autoincr1);
    $conn->query($autoincr2);
    $conn->query($autoincr3);

    //$conn->exec($sql4);
    echo "successful";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
?>