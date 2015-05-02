<?php
	// skript, mis filtreerib paremas servas olevat loetelu, käivitatakse onKeyUp korral AJAXiga
	if (isset($_POST['filter'])){
		$filter = $_POST['filter'];
	}
	else{
		$filter = "";
	}
	
	$oneOrTwo = 1;
	
	//echo 'filter: '.$_POST['filter'].'<br/>';
	
	include_once 'db/sql_functions.php';
	
	$data = getAllCategories($filter);
		
	foreach($data as $row){
	 
		echo '<div class="downBoxRow'.$oneOrTwo.'">
			<a class="n1" href="index.php?lecture=' .urlencode($row['name']). '"><b>' .$row['name']. '</b></a>
		</div>';
		if ($oneOrTwo == 1){
			$oneOrTwo=2;
		}
		else{
			$oneOrTwo=1;
		}
	}	
	
?>