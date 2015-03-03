<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />


<div class="right">

	<div class="up">
<?php
	include_once '_Sidebar.php';
	
	if (isset($_GET['user'])){
		$sidebar = new Sidebar($_GET['user']);
		$sidebar->kirjuta();
	}
	else{
		$sidebar = new Sidebar("Jah");
		$sidebar->kirjuta();
	}
	

?>
	</div>
	
	
	
	<div class="down">					
	</div>
</div>


<div class="left">

<?php

	echo '<h1>Matemaatiline analüüs</h1><br/><br/>';
	
	include_once '_Post.php';

	$post = new Post($_GET['lehekylg']);
	$post->kirjuta();
	
	echo '<br /><h> tiitel ütleb kõik, aitäh! </h><br />';

?>

<form method="POST">
    <input type="hidden" name="action" value="new_entry" />
	<textarea rows="10" cols="46" value="" name="name" ></textarea> <br />
	<input class="button" type="submit" value="Vasta" />
</form><br />


<?php

	
if (isset($_POST['action'])) {
     switch ($_POST['action']) {
          case 'new_entry':
			$nimim2lus = $_POST['name'];
			save($_POST);
		}
}




function save ($dataArray) {
     
	$fp = fopen('...comments.txt', 'a+');
	fwrite($fp, $dataArray['name']);
	fwrite($fp, ';');
	fclose($fp);
	return true;

}



include_once '_Comment.php';

$data = file('...comments.txt');
foreach ($data as $entryData) {
	$entryParts = explode(';', $entryData);
	foreach ($entryParts as $comm) {
		
		if ($comm != ''){
		$comment = new Comment($comm);
		$comment->kirjuta();
		}
	}
}



	
?>
	</div>	   
</div>
