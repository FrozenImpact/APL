<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>

<?php

	echo '<h1>Matemaatiline analüüs</h1>';
	
	echo '<a href="http://www.reddit.com/"><img src="up.png" width="20" height="20" alt="" />';
	
	echo '<a href="#">Ostan kohvikus saiakese kes mulle testi vastuseid jagab</a>';
	
	echo '<a href="http://www.reddit.com/"><img src="up.png" width="20" height="20" alt="" />';
	
	echo '<br /><a> tiitel ütleb kõik, aitäh! </a><br />';

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
     
$fp = fopen('comments.txt', 'a+');
fwrite($fp, $dataArray['name']);
fwrite($fp, ';');
fclose($fp);
return true;

}



include_once 'Comment.php';

$data = file('comments.txt');
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

</html>