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
		echo'
		<div class="selfComment">	
			<form method="POST">
				<textarea rows="1" cols="68" value="" name="title" id="title" style="color: white; background-color: #1E1E1E" ></textarea><br><br/>	
				<input type="hidden" name="action" value="new_entry"/>
				<textarea rows="6" cols="68" value="" name="kehatekst" id="kehatekst" style="color: white; background-color: #1E1E1E" ></textarea><br><br/>			
				<input class="rightLink" type="submit" value="Post"/>
			</form>	
		</div>
		';
	}
	else{
		echo '<font color="white">Esmalt peate valima paremalt õppeaine.</font>';
	}


	if (isset($_POST['action'])) {
		$uusid = save($_POST);
		echo '<font color="white">Postitus loodud.</font>';
		echo "<script type='text/javascript'>$.removeCookie('example2');</script>";
		echo "<script type='text/javascript'>$.removeCookie('example3');</script>";
		echo '<script>window.location.href = "index.php?'.$sidebar->getLecture().'&lehekylg='.$_POST['title'].'&post_id='.$uusid.'";</script>';
	}

?>



