<?php
header('Content-Type: text/html; charset=utf-8');
include_once 'sql_functions.php';
$username = "PotatoMan";
$password = "PotatoMan";
$heading = "Millal meil kollokvium tuleb?";
$description = "Tiitel ütleb kõik, aitäh";
$userid = 1;
$postid = 1;
$content = "On siis kellelgi?";

//addUser($username, $password);
//addPost($userid, $heading, $description);
//addComment($userid, $postid, $content);
//echo "new fields added";
$data = getposts();

foreach($data as $row){
	echo $row['Description']. "<br>";
}

/*foreach($data as $row){
	echo $row['Heading']. "		" . $row['Description']. "<br>";
}*/

?>