<?php
session_start();
include_once '_Comment.php';
include_once 'db/sql_functions.php';

$data = getAllComments($_POST['post_id']);

foreach ($data as $row) {
    $user = getUserById($row['User_ID']);
	$comment = new Comment($row['ID'], $row['Content'], $user, $row['Posted'], $row['Upvote']-$row['Downvote']);
	$comment->draw_comment();
	
}
?>