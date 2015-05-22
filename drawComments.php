<?php
include_once '_Comment.php';
include_once 'db/sql_functions.php';

if (isset($_GET['post_id'])){
	$postid = $_GET['post_id'];
}
else {		
	$postid = $_POST['post_id'];
}
	
$data = getAllComments($postid);

foreach ($data as $row) {
    $user = getUserById($row['User_ID']);
	$comment = new Comment($row['ID'], $row['Content'], $user, $row['Posted'], $row['Upvote']-$row['Downvote']);
	$comment->draw_comment();
	
}
?>