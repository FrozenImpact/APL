<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>

<?php

	echo '<h1>Matemaatiline analüüs</h1>';
	
	
	echo '<a href="http://www.reddit.com/"><img src="up.png" width="20" height="20" alt="" />';
	
	echo '<a href="#"> post 1 title </a> <br />';
	
	echo '<a>posti sisu siia </a><br />';

?>
<form method="POST">
	<textarea rows="10" cols="46" value="
	<?php 
		if (!isset($nimim2lus))echo '';
		else echo $nimim2lus
		
		?>
		" name="comment">


		</textarea> <br />
	 <input class="button" type="submit" value="Vasta" />
</form><br />
<?php

	
if (isset($_POST['action'])) {
     
     switch ($_POST['action']) {
          
          case 'new_entry':
               
			        $nimim2lus = $_POST['name'];
					save($_POST);
			   

               
          break;
          
     }
     
}




function save ($dataArray) {
     
$fp = fopen('comments.txt', 'a+');
fwrite($fp, $dataArray['name']);
fwrite($fp, "\n");
fclose($fp);
return true;

}






	
	$i = 1;
	while ($i < 10){
		echo '<a>comment ' .$i. '</a><br />';
		echo '<a>autor </a>';
		echo '<a>skoor </a>';
		echo '<a>kuupäev </a>';
		echo '<br />';
		
		$i++;
	};
	
?>

</html>