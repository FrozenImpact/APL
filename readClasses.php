<?php
	if (isset($_POST['filter'])){
		$filter = $_POST['filter'];
	}
	else{
		$filter = "";
	}
	//echo 'filter: '.$_POST['filter'].'<br/>';
	$data = file('...classes.txt');
	foreach ($data as $entryData) {
		if ($filter == ""){
			echo'<li><a href="index.php?lecture=' .$entryData. '">' .$entryData. '</a></li>';
		}
		else if (stripos ($entryData, $filter)!== false){
			echo'<li><a href="index.php?lecture=' .$entryData. '">' .$entryData. '</a></li>';
		}
	}
?>