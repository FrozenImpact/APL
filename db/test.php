<?php
header('Content-Type: text/html; charset=utf-8');
include_once 'sql_functions.php';

// $username = "PotatoMan";
// $password = "PotatoMan";
// $heading = "Millal meil kollokvium tuleb?";
// $description = "Tiitel ütleb kõik, aitäh";
$userid = 1;
$postid = 1;
// $content = "On siis kellelgi?";

//addUser($username, $password);
//addPost($userid, $heading, $description);
//addComment($userid, $postid, $content);
//echo "new fields added";

/*
$data = getAllComments($postid);

foreach($data as $row){
    $user = getUserById($row['User_ID']);
	echo $row['Content'] . " " . $user . " " . $row['Posted'] . "<br>";
}

$data2 = getPost($postid);
foreach($data2 as $row){
    $user = getUserById($row['User_ID']);
	echo $row['Description'] . " " . $row['Category'] . " " . $user . " " . $row['Posted'] . " " . $row['Heading'] . " " . $row['Downvote'] . " " . $row['Upvote'] . "<br>";
}

$data1 = getAllPosts("", "Intell");
foreach($data1 as $row){
	echo $row['Description'] . " " . $row['Category'] . " " . $row['Posted'] . " " . $row['Heading']. "<br>";
}
$data2 = getAllPosts(19, "");
foreach($data2 as $row){
	echo $row['Description'] . " " . $row['Category'] . " " . $row['Posted'] . " " . $row['Heading']."<br>";
}
$data3 = getAllPosts(19, "el");
foreach($data3 as $row){
	echo $row['Description'] . " " . $row['Category'] . " " . $row['Posted'] . " " . $row['Heading']."<br>";
}


//$data4 = getAllCategories("infor");
$data5 = getAllCategories("");
foreach($data5 as $row){
    echo $row['name']."<br>";
}

echo userExists("x", "x");
echo userExists("MyUser", "MyUser");
echo userExists("Anni Uutma");
*/
addUser("Meh", "Meh");
addUser("Kessu Sisselasi");
?>