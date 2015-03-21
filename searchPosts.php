<?php
	// skript, mis teostab otsingut, käivitatakse onKeyUp korral AJAXiga
	include_once '_Post.php';

	if (isset($_POST['filter'])){
		$filter = $_POST['filter'];
	}
	else{
		$filter = "";
	}
	
	//echo 'filter: '.$_POST['filter'].'<br/>';
	$data = file('...posts.txt');
	$kogus = 0;
	foreach ($data as $entryData) {
		$entryParts = explode(';', $entryData);
			foreach ($entryParts as $comm) {
				if ($comm != ''){
					
					if ($filter == ""){
						// ära näita midagi enam
						//$post = new Post($comm, $_POST['lecture']);
						//$post->draw_post_mini();
					}
					else if (stripos ($comm, $filter)!== false && $kogus < 3){
						$post = new Post($comm, $_POST['lecture']);
						$post->draw_post_mini();
						$kogus +=1;
					}
					

			}
		}
	}
?>