<?php
	// skript, mis filtreerib paremas servas olevat loetelu, käivitatakse onKeyUp korral AJAXiga
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
			//echo'<li><a href="index.php?lecture=' .$entryData. '">' .$entryData. '</a></li>';
			echo'
			<div class="downBoxRow1">
				<a class="n1" href="index.php?lecture=' .$entryData. '"><b>' .$entryData. '</b></a>
			</div>
			';			
			
			
		}
		else if (stripos ($entryData, $filter)!== false){
			//echo'<li><a href="index.php?lecture=' .$entryData. '">' .$entryData. '</a></li>';
			echo'
			<div class="downBoxRow1">
				<a class="n1" href="index.php?lecture=' .$entryData. '"><b>' .$entryData. '</b></a>
			</div>
			';
		}
	}
?>