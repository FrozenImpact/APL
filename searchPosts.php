<?php
	include_once '_Post.php';

	if (isset($_POST['filter'])){
		$filter = $_POST['filter'];
	}
	else{
		$filter = "";
	}
	
	//echo 'filter: '.$_POST['filter'].'<br/>';
	$data = file('...posts.txt');
	foreach ($data as $entryData) {
		$entryParts = explode(';', $entryData);
			foreach ($entryParts as $comm) {
				if ($comm != ''){
					
					if ($filter == ""){
						$post = new Post($comm, $_POST['lecture']);
						$post->draw_post();
					}
					else if (stripos ($comm, $filter)!== false){
						$post = new Post($comm, $_POST['lecture']);
						$post->draw_post();
					}
					

			}
		}
	}
?>