<?php
	if ($_POST['lecture']!= ""){
		include_once '_Post.php';
		include_once 'db/sql_functions.php';
		
		$data = getAllPosts($_POST['lecture'], "");
		foreach($data as $row){
			 
			$post = new Post($row['ID'], $row['Heading'], $_POST['lecture'], $row['Posted'], $row['Upvote']-$row['Downvote']);
			$post->draw_post();
			
		}
	}
?>