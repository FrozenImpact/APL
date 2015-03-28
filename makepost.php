<?php
	function save ($dataArray) {
		$fp = fopen('...posts.txt', 'a+');
		fwrite($fp, ';');
		fwrite($fp, $dataArray['title']);
		// $dataArray['name'];
		fwrite($fp, ';');
		fclose($fp);
		return true;
	}

	if (isset($_GET['lecture'])) {
		echo'
		<div class="selfComment">	
			<form method="POST">
				<textarea rows="1" cols="68" value="" name="title" id="title" style="color: white; background-color: #1E1E1E" ></textarea><br><br/>	
				<input type="hidden" name="action" value="new_entry"/>
				<textarea rows="6" cols="68" value="" name="name" id="comment" style="color: white; background-color: #1E1E1E" ></textarea><br><br/>			
				<input class="rightLink" type="submit" value="Post"/>
			</form>	
		</div>
		';
	}
	else{
		echo '<font color="white">Esmalt peate valima paremalt õppeaine.</font>';
	}


	if (isset($_POST['action'])) {
		save($_POST);
		echo '<font color="white">Postitus loodud.</font>';
		echo "<script type='text/javascript'>$.removeCookie('example');</script>";
		echo "<script type='text/javascript'>$.removeCookie('example2');</script>";
		echo '<script>window.location.href = "index.php?'.$sidebar->getLecture().'&lehekylg='.$_POST['title'].'";</script>';
	}

?>



