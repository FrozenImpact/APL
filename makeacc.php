<?php
	// Laimis, muuda kõik echo read ka, lisa sinna ülakomade vahele mis iganes dive, uusi ridu jms.
	if (isset( $_POST['makeacc_button'] )){
		if (userExists($_POST['makeacc_username'], "")==0){
			if (stripos ($_POST['makeacc_password'], $_POST['makeacc_password2']) !== false){
				addUser($_POST['makeacc_username'], $_POST['makeacc_password']);
				
				// success message
				echo '<font color="white">Konto '.$_POST['makeacc_username'].' loodud.</font></br>';
			}
			else{
				// password mismatch message
				echo '<font color="white">Paroolid on erinevad.</font></br>';
			}
		}
		else{
			// username taken message
			echo '<font color="white">Konto '.$_POST['makeacc_username'].' on juba olemas.</font></br>';
		}
	}
?>
<form method="POST" id="makeacc_form" style="display: inline;">
	<input type="text" size="15" maxlength="15" value="<?php if (isset($_POST['makeacc_username'])) echo $_POST['makeacc_username']; ?>" placeholder="Kasutajanimi" style="color:black" name="makeacc_username" ><br/>
	<input type="password" size="15" maxlength="15" value="<?php if (isset($_POST['makeacc_password'])) echo $_POST['makeacc_password']; ?>" placeholder="Parool" style="color:black" name="makeacc_password" ><br/>	
	<input type="password" size="15" maxlength="15" value="<?php if (isset($_POST['makeacc_password2'])) echo $_POST['makeacc_password2']; ?>" placeholder="Korda parooli" style="color:black" name="makeacc_password2" ><br/>
	<a><input class="n2 rightLink" type="submit" name="makeacc_button" id="makeacc_button" value="Loo"></a>

</form>	