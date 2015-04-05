<?php
	// skript, mis teostab otsingut, käivitatakse onKeyUp korral AJAXiga
	include_once '_Post.php';

	if (isset($_POST['filter']) && $_POST['filter'] != ""){
		$filter = $_POST['filter'];
		include_once 'db/sql_functions.php';
		$data = getAllPosts(0, $filter);
		$kogus = 0;
		foreach ($data as $row) {
			if ($kogus>2){
				break;
			}
			
			$category = getCategoryName($row['Category']);
			$post = new Post($row['ID'], $row['Heading'], $category, "", "");
			$post->draw_post_mini();
			$kogus +=1;
			
		}
	}
	else{
		echo '';
	}

		
?>