<?php
include_once 'db/sql_functions.php';
upVote($_POST['usr'], $_POST['id'], "");


// $fp = fopen('test.txt', 'a+');
// fwrite($fp, "upvoted post_id: ".$_POST['id'].", user_id: ".$_POST['usr']);
// fwrite($fp, ''. PHP_EOL .'');
// fclose($fp);
?>