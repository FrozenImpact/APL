<?php

	if (isset( $_POST['makeacc_button'] )){
		$fp = fopen('...users.txt', 'a+');
		fwrite($fp, $_POST['makeacc_username']);
		fwrite($fp, ';');
		fwrite($fp, $_POST['makeacc_password']);
		fwrite($fp, ''. PHP_EOL .'');  	//reavahetus
		fclose($fp);
		echo '<font color="white">Konto '.$_POST['makeacc_username'].' loodud.</font></br>';
	}
	

?>
<form method="POST" id="makeacc_form" style="display: inline;">
	<input type="text" size="15" maxlength="15" value="" placeholder="Kasutajanimi" style="color:black" name="makeacc_username" ><br/>
	<input type="password" size="15" maxlength="15" value="" placeholder="Parool" style="color:black" name="makeacc_password" ><br/>	
	<!--<input type="password" size="15" maxlength="15" value="" placeholder="Korda parooli" style="color:black" name="makeacc_password2" ><br/>	-->
	<a><input class="n2 rightLink" type="submit" name="makeacc_button" id="makeacc_button" value="Loo"></a>

</form>	