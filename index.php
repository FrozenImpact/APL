<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
		var search = $("#class_search_entry");
        $("#class_search_entry").keyup(function() {
			$.post( 
				'readClasses.php', // location of your php script
				{ filter: search.val() }, // any data you want to send to the script
				function( data ){  // a function to deal with the returned information
					$('#down li').remove();
					$( '#down').append( data );
				});
        });
		
		var search2 = $("#searchBig");
        $("#searchBig").keyup(function() {
			$.post( 
				'searchPosts.php',
				{ filter: search2.val(), lecture: '<?php 
					if (isset($_GET['lecture'])){
						echo $_GET['lecture'];
					}
					else{
						echo 'Matemaatiline analüüs';
					}
					?>' },
				function( data ){
					//$('#left #postBoxRow').remove();
					//$( '#left').append( data );
					$('#content').empty();
					$( '#content').append( data );
				});
        });
});
</script>
	

<div class="right">
<div class="up">
<?php
	session_start();
	
	include_once '_Sidebar.php';
	
	// kas sisselogimisnuppu on vajutatud
	if (isset( $_POST['login_button'] )){
		$_SESSION['login_user']= $_POST['login_username']; 
	}
	
	// kas väljalogimisnuppu on vajutatud
	if (isset( $_POST['logout_button'] )){
		unset($_SESSION['login_user']); 
	}
	
	// kas kasutaja on sisse logitud
	if (isset( $_SESSION['login_user'] )){
		$sidebar = new Sidebar($_SESSION['login_user']);
		$sidebar->draw_sidebar_top();
	}
	// kui ei siis n2ita sisselogimisnuppu
	else{
		$sidebar = new Sidebar("");
		$sidebar->draw_login_form();
	}
?>
</div>
<div class="down" id="down">	
<?php
	$sidebar->draw_sidebar_bot ();
	include_once 'readClasses.php';
	
?>				

</div>
</div>


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
			<form id="searchMain">
				<input type="search" id="searchBig" placeholder="Search">
			</form>
		</div>
							
			
	</div><br></br>
	<div id="content">	
	<?php
	
		if (!isset($_GET['lecture']) && !isset($_GET['lehekylg'])){
			echo "Tere!<br/>Valige paremalt õppeaine.";
		}
		
		else if (isset($_GET['lecture']) &&  !isset($_GET['lehekylg'])){
		
			include_once '_Post.php';

			$data = file('...posts.txt');
			foreach ($data as $entryData) {
				$entryParts = explode(';', $entryData);
				foreach ($entryParts as $comm) {
			
					if ($comm != ''){
						$post = new Post($comm, $_GET['lecture']);
						$post->draw_post();
					}
				}
			}
		}
		
		else if (isset($_GET['lecture']) &&  isset($_GET['lehekylg'])){
			
			include_once '_Post.php';

			$post = new Post($_GET['lehekylg'], $_GET['lecture']);
			$post->draw_post();

			echo '
				<div class="selfPost">
					<h> tiitel ütleb kõik, aitäh! </h>
				</div>


			<div class="selfComment">	
					<form method="POST">
						<input type="hidden" name="action" value="new_entry"/>
						<textarea rows="6" cols="68" value="" name="name" ></textarea><br><br/>			
						<input class="button" type="submit" value="Reply"/>
					</form>	
			</div>';


			if (isset($_POST['action'])) {
				save($_POST);
			}
			include_once '_Comment.php';
			
			// failist lugemine
			$data = file('...comments.txt');
			foreach ($data as $entryData) {
				$entryParts = explode(';', $entryData);
				if ( isset($entryParts[0]) && isset($entryParts[1]) && isset($entryParts[2]) ){
				
					$comm = $entryParts[0];
					$author = $entryParts[1];
					$date = $entryParts[2];
						
					$comment = new Comment($comm, $author, $date);
					$comment->draw_comment();
				}
			}
		}
	
		// kirjuta comment tekstfaili
		function save ($dataArray) {
			$fp = fopen('...comments.txt', 'a+');
			fwrite($fp, $dataArray['name']);
			
			if(isset($_SESSION['login_user'])){
				fwrite($fp, ';'.$_SESSION['login_user'].';');
			}
			else{
				fwrite($fp, ';Anon;');
			}
			
			fwrite($fp, time());
			fwrite($fp, ''. PHP_EOL .'');  	//reavahetus
			fclose($fp);
			return true;
		}

	?>

</div>
</div>

