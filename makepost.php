<script src="extended_features.js"></script>
<script src="jquery.cookie.js"></script>
<script>
function perioodiliselt_tehtav() {
	// sellel lehel pole midagi vaja teha
}
</script>
<?php
	include_once 'db/sql_functions.php';
	function save ($dataArray) {
		
		return addPost($_SESSION['login_user_id'],$_GET['lecture'],$dataArray['title'],$dataArray['kehatekst']);
	}

	if (isset($_GET['lecture'])) {
		// PEAMINE LEHEKÜLG. Sellel lehel oli keeruline html-i eraldada. echo ülakomade sisse võib kirjutada misiganes dive, uusi ridu jms.
		// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
		echo'
		<div class="selfComment">	
			<form method="POST">
				<textarea rows="1" cols="68" placeholder="Insert the title of your post here..." value="" name="title" id="title" style="color: white; background-color: #1E1E1E" ></textarea><br><br/>	
				<input type="hidden" name="action" value="new_entry"/>
				<textarea rows="6" cols="68" placeholder="Insert the content of your post here..." value="" name="kehatekst" id="kehatekst" style="color: white; background-color: #1E1E1E" ></textarea><br><br/>			
				<input class="rightLink" type="submit" value="Post"/>
			</form>	
		</div>
		';
		// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	}
	else{
		// Lehekülg, kui õppeaine on valimata
		echo '<font color="white">Esmalt peate valima paremalt õppeaine.</font>';
	}


	if (isset($_POST['action'])) {
		$uusid = save($_POST);
		// success message
		// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
		echo '<font color="white">Postitus loodud.</font>';
		// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
		echo "<script type='text/javascript'>$.removeCookie('example2');</script>";
		echo "<script type='text/javascript'>$.removeCookie('example3');</script>";
		echo '<script>window.location.href = "index.php?'.$sidebar->getLecture().'&lehekylg='.$_POST['title'].'&post_id='.$uusid.'";</script>';
	}

?>



