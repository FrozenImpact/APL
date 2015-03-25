<?php

function connect()
{
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$db = "apl";

	try{
    $conn = new PDO( "mysql:host=$host;dbname=$db;charset=utf8", $user, $pwd);
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

function addPost($userid, $heading, $description)
{
	$conn = connect();
	$sql = "INSERT INTO Post(Description, User_ID, Heading) VALUES (?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $description);
	$stmt->bindValue(2, $userid);
	$stmt->bindValue(3, $heading);
	$stmt->execute();
}

function addComment($userid, $postid, $content)
{
	$conn = connect();
	$sql = "INSERT INTO Comment(Content, User_ID, Post_ID) VALUES (?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $content);
	$stmt->bindValue(2, $userid);
	$stmt->bindValue(3, $postid);
	$stmt->execute();
}

function getPosts()
{
	$conn = connect();
	$sql = "SELECT Heading, Description FROM Post";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll( PDO::FETCH_ASSOC );
	return $data;
}
/* tagastab listi, kust saab postituste pealkirju ja sisu sellise tsükli abil
foreach($data as $row){
	echo $row['Heading']. "		" . $row['Description']. "<br>";
}
kui on vaja ainult pealkirju või ainult sisu, siis muuta vastavalt kas 
echo $row['Heading']. "<br>"; või echo $row['Description']. "<br>";*/
?>