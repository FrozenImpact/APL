<?php
	echo '
	<form method="GET">
		<input type="search" class="search2" placeholder="Search SubPages" name="search" value="'.$_GET['search'].'">';
		
	if (isset($_GET['lecture'])){
		echo '<input type="hidden" name="lecture" value="' . $_GET['lecture'] . '" />';
	}
	echo'</form>';
	echo '<a class="w">Otsingu "'.$_GET['search'].'" tulemused';
	
	if (isset($_GET['lecture'])){
		$data = getAllPosts($_GET['lecture'], $_GET['search']);
		echo ' kategoorias "'.$_GET['lecture'].'".</a>';
	}
	else{
		echo ' kõigis kategooriates.</a>';
		$data = getAllPosts("", $_GET['search']);
	}


	if (!isset($_GET['page']) ){
		$page=0;
	}
	else{
		$page=$_GET['page'];
	}

	
	//mitu postitust praegu näha saab?
	$loendur=0;
	for($i = $page*10; $i<($page*10)+10; $i++){
		//echo '<font color="white">'.$i.'</font><br/>';
		if (isset($data[$i])){
			$loendur++;
			$category = getCategoryName($data[$i]['Category']);
			$post = new Post($data[$i]['ID'], $data[$i]['Heading'], $category, $data[$i]['Posted'], $data[$i]['Upvote']-$data[$i]['Downvote']);
			$post->draw_post();
		}
	}
	if ($loendur>=10){
		$pagePlusOne=$page+1;
		if (isset($_GET['lecture'])){
			$lec = '&amp;lecture='.$_GET['lecture'];
		}
		else{
			$lec="";
		}
		
		echo '<br/><a href="index.php?search='.urlencode($_GET['search']).''.$lec.'&amp;page='.$pagePlusOne.'" class="rightLink" id="nextpage">Next page</a><div class="separator1"></div>';
	}
	else if ($loendur==0){
		echo '<a class="w"><br/>There seems to be nothing here...</a>';
	}
	
	?>