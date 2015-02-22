<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Hello world!</title>
    <META name="author" content="Priit">
	
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>
<body>


<!-- html kood -->

<?php

/* <?php         vahel on php kood      ?> */


include_once 'lib/Phonebook.php';
$phonebook = new Phonebook();
$phonebook->teeheader();      /* meetodi väljakutsumine */


/* muutuja */
    $name = 'World';
	
    echo 'Hello '.$name.'!';
	echo '<br />';  /* reavahe */

	
	$i = 0;
	while ($i <= 9) {
        echo 'i on '.$i.'';
		echo '<br />';
		
		if ($i < 4) {
			break;
		};
		
		}
		
	echo '<br />';
	echo 'New text document.txt <br />';
	
	
	/* faili lugemine */
	$data = file('New Text Document.txt');
	
	foreach ($data as $entryData) {
	echo $entryData;
	echo '<br />';
}





	
$phonebook->teefooter();
?>
</body>
</html>