<?php

function connect()
{
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$db = "apl";

	try{
    $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    return $conn;
}

function addUser($username, $password)
{
	$conn = connect();
	$sql = "INSERT INTO User (Name, Password) VALUES (?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $username);
	$stmt->bindValue(2, $password);
	$stmt->execute();
}
?>