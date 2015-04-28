<?php

if (isset($_POST['id'])){
	$postid = $_POST['id'];
}
else{
	$postid = "";
}

if (isset($_POST['comm_id'])){
	$commid = $_POST['comm_id'];
}
else{
	$commid = "";
}

include_once 'db/sql_functions.php';
downVote($_POST['usr'], $postid, $commid);


// $fp = fopen('vote_log.txt', 'a+');
// fwrite($fp, "upvoted post_id: ".$_POST['id'].", user_id: ".$_POST['usr']);
// fwrite($fp, ''. PHP_EOL .'');
// fclose($fp);
?>