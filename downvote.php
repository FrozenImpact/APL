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
$vote = downVote($_POST['usr'], $postid, $commid);

if ($vote=="Oled seda juba vote'inud"){
	echo 'jah';
}


// $fp = fopen('vote_log.txt', 'a+');
// fwrite($fp, "upvoted post_id: ".$_POST['id'].", user_id: ".$_POST['usr']);
// fwrite($fp, ''. PHP_EOL .'');
// fclose($fp);
?>