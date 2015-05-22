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
				
	// kas väljalogimisnuppu on vajutatud
	if (isset( $_POST['logout_button'] ) ){
		unset($_SESSION['login_user']); 
		unset($_SESSION['login_user_id']);
		
	}
	
	
	
	// kas sisselogimisnuppu on vajutatud
	if (isset( $_POST['login_button'] )){
		//$fbUser = false;
		if (userExists ($_POST['login_username'], $_POST['login_password']) != 0){
			$_SESSION['login_user']= $_POST['login_username']; 
			$_SESSION['login_user_id']= userExists ($_POST['login_username'], $_POST['login_password']);
		}
		else{
			echo '<r>Sisestati vale või puudulik info.</r>';
		}
	}
	
	// kas fesari nuppu on vajutatud?
	if (isset($_POST['fb'])){
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
		
	function getLecture(){
		if (isset($_GET['lecture'])){
			return '&lecture='.urlencode($_GET['lecture']).'';
		}
		else{
			return '';
	}
	
	
}
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="script_for_all_pages.js"></script>	
<script src="facebook.js"></script>	


<div class="left" id="left">	

	<div class="head">	
		<div class="headLeft">
			<a href="index.php" class="headLink">APL</a>
		</div>

		<div class="headMid">
			<a href="index.php<?php if (isset($_GET['lecture'])) echo '?lecture='.urlencode($_GET['lecture']).''; ?>" class="headLink">
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
			
		<!--	<div class="searchSuggestionBox" id="priit"> </div>	-->
		</div>
		
				
		<div class="headRight" id="sidebar_toggle_button_container">
			
		</div>
		
	</div>
	
	<!-- veebilehe peamine osa -->

	<div class="leftMain" id="scroller1">	
				
	<div class="separator1"></div>

	<div id="infobox"></div>

	<?php
		
		include_once '_Post.php';
		
		// post page small url
		if (isset($_GET['p'])){
			$post_data = getPost($_GET['p']);
			$category = getCategoryName($post_data[0]['Category']);
			echo '<a class="w" href="index.php?lecture='.urlencode($category).'&lehekylg='.urlencode($post_data[0]['Heading']).'&post_id='.urlencode($_GET['p']).'">If automatic forwarding doesnt work, click here.</a>';
			echo '<script>window.location.href = "index.php?lecture='.urlencode($category).'&lehekylg='.urlencode($post_data[0]['Heading']).'&post_id='.urlencode($_GET['p']).'";</script>';
			exit();
		}
		
		// search results page
		if (isset($_GET['search'])){
			include_once 'search.php';
		}
		
		// make profile page
		else if (isset($_GET['kontoloomine'])){
			include_once 'makeacc.php';
		}
		
		// meldimine
		else if (isset($_GET['newpost'])){
			
			if (isset($_POST['logout_button'])){
				echo '<script>window.location.href = "index.php";</script>';
			}
			else if (isset( $_SESSION['login_user'] )){
				include_once 'makepost.php';
			}
			else{
				echo '<a class="w"> Please log in/make account to use this feature </a>';
				echo '<script>window.location.href = "logon.php?newpost=true'.getLecture().'";</script>';
			}
		}	
		
		// profile page
		else if (isset($_GET['profile'])){
			include_once 'profile.php';

		}
		
		// homepage
		else if (!isset($_GET['lecture']) && !isset($_GET['lehekylg'])){
			echo '<a class="w">Tere!<br/>Valige õppeaine. <br/>Populaarsed õppeained:<br/><br/></a>';
			$data = getCategoriesInPopularityOrder();
			
			$oneOrTwo = 1;
			$kogus=0;
			foreach($data as $row){
				if ($kogus>5){
					break;
				}
				echo '<div class="downBoxRow'.$oneOrTwo.'">
					<a class="n1" href="index.php?lecture=' .urlencode($row['name']). '"><b>' .$row['name']. '</b></a>
				</div>';
				if ($oneOrTwo == 1){
					$oneOrTwo=2;
				}
				else{
					$oneOrTwo=1;
				}	
				$kogus+=1;
	}
			
			// echo '
			// <upC>Upvoted post: tere</upC><br/>
			// <downC>Downvoted post: tere</downC><br/>
			// <y>You have already voted on this: tere</y><br/>
			// <y>Voting is only available to registered users.</y><br/>
			// <r>TÄHELEPANU: Ühendus serveriga katkes. Võite teksti kirjutamist jätkata, sest selle mustandit talletatakse teie arvutis.</r>
			// ';
			
			// echo 'Testimist abistavad ajutised lingid:<br/><br/>
				// <a class="rightLink" href="workspaceIndex.php">workspaceIndex</a><br/><br/>';
			// echo '<a class="rightLink" href="workspacePost.php">workspacePost</a><br/><br/>';
			// echo '<a class="rightLink" href="workspaceLogin.php">workspaceLogin</a><br/><br/>';
			// echo '<a class="rightLink" href="profile.php">profile</a><br/></a>';
		}
		

		// subreddit homepage
		else if (isset($_GET['lecture']) && !isset($_GET['lehekylg'])){
			include_once 'home.php';
		}
	
		// post page
		else if (isset($_GET['lecture']) &&  isset($_GET['lehekylg'])){
			include_once 'post.php';
		}
		
	?>
	</div>
</div>

<div class="right" id="right">
	<div class="up" id="up">
	<?php
		
		include_once '_Sidebar.php';



		
		// kas kasutaja on sisse logitud
		if (isset( $_SESSION['login_user'] )){
			
			// is facebook user?
			if (getUserById($_SESSION['login_user_id'])[0]['Password'] == null ){
				$fbUser = true;
			}
			else{
				$fbUser = false;
			}

			$sidebar = new Sidebar($_SESSION['login_user'], $fbUser);
			$sidebar->setPosts( numberOfPosts($_SESSION['login_user_id']) );
			$sidebar->setComments( numberOfComments($_SESSION['login_user_id']) );
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
					if (isset($_POST['class_search_entry'])){
						echo $_POST['class_search_entry'];
					}
					else if (isset($_GET['filter'])){
						echo $_GET['filter'];
					}
					else{
						echo '';
					}				
				?>" name="class_search_entry" id="class_search_entry" placeholder="Search SubPages" size="15" maxlength="15">
			</form>
			</div>
			
			<div class="downContainer" id="scroller2">
				<?php
					include_once 'readClasses.php';
				?>
			</div>
	</div>
</div>

</body>
</html>