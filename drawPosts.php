<?php
	session_start();
	if ($_POST['lecture']!= ""){
		include_once '_Post.php';
		include_once 'db/sql_functions.php';
		
		if ($_POST['page']== ""){
			$page=0;
		}
		else{
			$page=$_POST['page'];
		}
		
		$data = getAllPosts($_POST['lecture'], "");
		
		// foreach($data as $row){
			 // echo $page;
			 // $page++;
			// $post = new Post($row['ID'], $row['Heading'], $_POST['lecture'], $row['Posted'], $row['Upvote']-$row['Downvote']);
			// $post->draw_post();
			
		// }
		
		//mitu postitust praegu näha saab?
		$loendur=0;
		for($i = $page*10; $i<($page*10)+10; $i++){
			//echo '<font color="white">'.$i.'</font><br/>';
			if (isset($data[$i])){
				$loendur++;
				$post = new Post($data[$i]['ID'], $data[$i]['Heading'], $_POST['lecture'], $data[$i]['Posted'], $data[$i]['Upvote']-$data[$i]['Downvote']);
				$post->draw_post();
			}
		}
		if ($loendur>=10){
			$pagePlusOne=$page+1;
			echo '<br/><a href="index.php?lecture='.urlencode($_POST['lecture']).'&amp;page='.$pagePlusOne.'" class="rightLink" id="nextpage">Next page</a><div class="separator1"></div>';
		}
		else if ($loendur==0){
			echo '<a class="w"><br/>There seems to be nothing here...</a>';
		}
	}
?>