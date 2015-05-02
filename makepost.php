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
				<textarea rows="1" cols="68" placeholder="Insert the title of your post here..." name="title" id="title" class="largeTextEntry" ></textarea><br><br/>	
				<input type="hidden" name="action" value="new_entry"/>
				<textarea rows="6" cols="68" placeholder="Insert the content of your post here..." name="kehatekst" id="kehatekst" class="largeTextEntry" ></textarea><br><br/>			
				<input class="rightLink" type="submit" value="Post"/>
			</form>	
		</div>
		';
	}
	else{
		// Lehekülg, kui õppeaine on valimata
		echo '<a class="w">Esmalt peate valima paremalt õppeaine.</a>';
	}


	if (isset($_POST['action'])) {
		$uusid = save($_POST);
		// success message
		echo '<a class="w">Postitus loodud.</a>';
		// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
		echo "<script type='text/javascript'>$.removeCookie('example2');</script>";
		echo "<script type='text/javascript'>$.removeCookie('example3');</script>";
		echo '<script>window.location.href = "index.php?'.getLecture().'&lehekylg='.$_POST['title'].'&post_id='.$uusid.'";</script>';
	}

?>



