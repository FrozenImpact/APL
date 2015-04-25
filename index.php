<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style.css?v=1.1" media="screen">
<title>APL</title>
</head>
<body>
<?php
	session_start();
	include_once 'db/sql_functions.php';

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function readClasses() {
	$('#scroller2').empty();
	$( '#scroller2').append( '<a style="color:white;">Loading...</a>' );
	$.post( 
	'readClasses.php', 
	{ filter: $("#class_search_entry").val() }, 
	function( data ){ 
		//$('#down li').remove();
		$('#scroller2').empty();
		$( '#scroller2').append( data );
	});
}

$(document).ready(function() {
	
	// ainete filter paremal all
	// seda AJAXiga lehel tehtud muudatust saab ka bookmarkida
	readClasses();
	var vana = $("#class_search_entry").val();
	$("#class_search_entry").keyup(function() {
		
		readClasses();
		
		var hetkeUrl = window.location.href;

		if (hetkeUrl.indexOf("?")==-1){
			window.history.replaceState("", "", window.location.href+"?");
		}
		
		if (hetkeUrl.indexOf("&filter=")!=-1){
			var uus = hetkeUrl.replace("&filter="+vana,"&filter="+ $("#class_search_entry").val());
			window.history.replaceState("", "", uus);
			vana = $("#class_search_entry").val();
		} else {
			window.history.replaceState("", "", window.location.href + "&filter=" + $("#class_search_entry").val());
			vana = $("#class_search_entry").val();
		}
	});
	
	
	
	//suur otsing ülemise riba paremas servas
	var search2 = $("#searchBig");
	$("#searchBig").keyup(function() {		
		$('#priit').empty();
		$( '#priit').append( '<a style="color:white;"><br/><br/><br/>Loading...</a>' );
		$.post( 
			'searchPosts.php',
			{ filter: search2.val() },
			function( data ){
				$('#priit').empty();
				$( '#priit').append( data );
			});
	});
	
	$('#priit').hide();
	
	$("#searchBig").focus(function() {
		$('#priit').fadeIn();
	});
	
	$("#searchBig").focusout(function() {
		//setTimeout(function(){	
			//$('#priit').hide();
			$('#priit').fadeOut();
		//}, 200);
	});		
	
});
</script>

<script src="facebook.js"></script>	

<div class="right">
	<div class="up" id="up">
	<?php
		
		include_once '_Sidebar.php';
		
		// kas sisselogimisnuppu on vajutatud
		if (isset( $_POST['login_button'] )){
			$fbUser = false;
			if (userExists ($_POST['login_username'], $_POST['login_password']) != 0){
				$_SESSION['login_user']= $_POST['login_username']; 
				$_SESSION['login_user_id']= userExists ($_POST['login_username'], $_POST['login_password']);
			}
			else{
				echo '<a style="color:red;">Sisestati vale või puudulik info.</a>';
			}
		}
		else if (isset($_POST['fb'])){
			if (userExists ($_POST['fb'], "") != 0){
				$_SESSION['login_user']= $_POST['fb'];
				$_SESSION['login_user_id']= userExists ($_POST['fb'], "");
			}
			else{
				addUser($_POST['fb'], "");
				$_SESSION['login_user']= $_POST['fb'];
				$_SESSION['login_user_id']= userExists ($_POST['fb'], "");
			}
			 
		}
		
		// kas väljalogimisnuppu on vajutatud
		if (isset( $_POST['logout_button'] )){
			unset($_SESSION['login_user']); 
			unset($_SESSION['login_user_id']); 
		}
		
		// kas kasutaja on sisse logitud
		if (isset( $_SESSION['login_user'] )){
			$sidebar = new Sidebar($_SESSION['login_user'], !isset($fbUser));
			$sidebar->draw_sidebar_top();
		}
		// kui ei siis n2ita sisselogimisnuppu
		else{
			$sidebar = new Sidebar("", false);
			$sidebar->draw_login_form();
		}
	?>
	</div>
	
	<div class="down" id="down">	
		<div class="separator2"></div>
			<div class="s2">
			<form method="post">
				<input type="search" class="search2" value="<?php 
					if (isset($_GET['filter'])){
						echo $_GET['filter'];
					}
					else{
						echo '';
					}				
				?>" onkeyup="submit" name="class_search_entry" id="class_search_entry" size="15" maxlength="15">
			</form>
			</div>
			
			<div class="downContainer" id="scroller2">
			
			</div>
	</div>
</div>
<!-- _________________________________________________________________________________________________________ -->

<div class="left" id="left">	

	<div class="head">	
		<div class="headLeft">
			<a href="index.php" class="headLink">APL</a>
		</div>
		<div class="headMid">
			<a href="index.php<?php if (isset($_GET['lecture'])) echo '?lecture='.$_GET['lecture'].''; ?>" class="headLink">
			<?php 
			if (isset($_GET['lecture'])){
				echo ''.$_GET['lecture'].'';
			}
			else{
				echo "Kodu";
			}
			?>
			</a>
		</div>
		<div class="headRight">			
			<form id="searchMain" method="GET">
				<input type="search" class="search" id="searchBig" placeholder="Search" name="search">
			<?php	
				if (isset($_GET['lecture'])){
					echo '<input type="hidden" name="lecture" value="' . $_GET['lecture'] . '" />';
				}
				?>
				
			</form>
			
			<div class="searchSuggestionBox" id="priit">
				<!-- priidu loodud -->
			</div>
		</div>
	</div>
	
	<!-- veebilehe peamine osa -->
	
	<div class="leftMain" id="scroller1">	
				
	<div class="separator1"></div>
	<div id="infobox"></div>


	<?php
		
		include_once '_Post.php';
		
		// search results page
		if (isset($_GET['search'])){
			echo '
			<form method="GET">
				<input type="search" class="search2" placeholder="Search SubPages" name="search" value="'.$_GET['search'].'">';
				
			if (isset($_GET['lecture'])){
				echo '<input type="hidden" name="lecture" value="' . $_GET['lecture'] . '" />';
			}
			echo'</form>';
			echo '<a style="color:white;">Otsingu "'.$_GET['search'].'" tulemused';
			
			if (isset($_GET['lecture'])){
				$data = getAllPosts($_GET['lecture'], $_GET['search']);
				echo ' kategoorias "'.$_GET['lecture'].'".</a>';
			}
			else{
				echo ' kõigis kategooriates.';
				$data = getAllPosts("", $_GET['search']);
			}
			
			foreach($data as $row){
				$category = getCategoryName($row['Category']);
				$post = new Post($row['ID'], $row['Heading'], $category, $row['Posted'], $row['Upvote']-$row['Downvote']);
				$post->draw_post();
				
			}	
		
			
		}
		
		// make profile page
		else if (isset($_GET['kontoloomine'])){
			include_once 'makeacc.php';
		}
		
		// meldimine
		else if (isset($_GET['newpost'])){
			if (isset( $_SESSION['login_user'] )){
				include_once 'makepost.php';
			}
			else if (isset($_POST['logout_button'])){
				echo '<script>window.location.href = "index.php";</script>';
			}
			else{
				echo '<script>window.location.href = "logon.php?newpost=true'.$sidebar->getLecture().'";</script>';
			}
		}	
		
		// profile page
		else if (isset($_GET['profile'])){
			include_once 'profile.php';

		}
		
		// homepage
		else if (!isset($_GET['lecture']) && !isset($_GET['lehekylg'])){
			echo '<a style="color:white;">Tere!<br/>Valige õppeaine. <br/>Populaarsed õppeained:<br/><br/></a>';
			$data = getCategoriesInPopularityOrder();
			
			$oneOrTwo = 1;
			$kogus=0;
			foreach($data as $row){
				if ($kogus>5){
					break;
				}
				echo '<div class="downBoxRow'.$oneOrTwo.'">
					<a class="n1" href="index.php?lecture=' .$row['name']. '"><b>' .$row['name']. '</b></a>
				</div>';
				if ($oneOrTwo == 1){
					$oneOrTwo=2;
				}
				else{
					$oneOrTwo=1;
				}	
				$kogus+=1;
	}
			
			// echo 'Testimist abistavad ajutised lingid:<br/><br/>
				// <a class="rightLink" href="workspaceIndex.php">workspaceIndex</a><br/><br/>';
			// echo '<a class="rightLink" href="workspacePost.php">workspacePost</a><br/><br/>';
			// echo '<a class="rightLink" href="workspaceLogin.php">workspaceLogin</a><br/><br/>';
			// echo '<a class="rightLink" href="profile.php">profile</a><br/></a>';
		}
		

		// subreddit homepage
		else if (isset($_GET['lecture']) &&  !isset($_GET['lehekylg'])){
			include_once 'home.php';
		}
	
		// post page
		else if (isset($_GET['lecture']) &&  isset($_GET['lehekylg'])){
			include_once 'post.php';
		}
		
	?>
</div>
</div>
</body>
</html>