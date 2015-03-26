<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css?v=1.1" media="screen" />
<?php
	session_start();
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="jquery.cookie.js"></script>
<script>
function checkConnection() {
	$.post('checkServerConnection.php', function(data){ $('#infobox').empty(); });
}

function readClasses() {
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
		
		// kui server ei vasta
		$.ajaxSetup({
		type: 'GET',
		cache: true,
		timeout: 4000,
		error: function(xhr) {
				$('#infobox').empty();
				$( '#infobox').append( '<font color="red">TÄHELEPANU: Ühendus serveriga katkes. Kogu funktionaalsus ei pruugi enam olla kättesaadav. Juhul, kui teil on vastamine pooleli, võite seda jätkata, mustandit, kaasaarvatud teie võrguta tehtud muudatused talletatakse teie arvutis, ja see jääb alles, isegi kui te selle akna sulgete.</font>' );
			}
		})
		
		// facebook
		$.getScript('//connect.facebook.net/ee_ET/all.js', function(){
			FB.init({
				 appId: 901484619902464,
				  //xfbml      : true,
				  //version    : 'v2.1'
			});     
		
			//var e = document.createElement('script');
			//e.async = true;
			//e.src = document.location.protocol +'//connect.facebook.net/ee_ET/all.js';
		
		
        $("#facebook").click(function() {
			
			//$( '#up').append(e);
				
				FB.login(function(response) {       
						if (response.status === "connected") {
							FB.api('/me', function(data) {
								//$("#Username").val(data.name);
								//$("#login_form").submit();
								
								$.post( 
									'index.php', 
									{ fb: data.name }, 
									function( data ){ 
										location.reload();
									});
								
						  });
						 }
					}, {display: "popup"});
		
		
		 });
		
				//$('#loginbutton,#feedbutton').removeAttr('disabled');
				//FB.getLoginStatus(updateStatusCallback);
		});
		 

		
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
		
		// küpsised, poolelioleva vastuse mustandi võrguühenduseta redigeerimiseks
		$("#comment").val($.cookie("example"))
		$("#comment").keyup(function() {
			$.cookie("example", $("#comment").val());
        });
		
		
		// kasutaja informeerimine võrguühenduse katkemisest
		setInterval(function(){
			checkConnection();
		}, 1000);
		
		//alert(  );
		//$.removeCookie("example");
		

		
		
});
</script>
	

<div class="right">
	<div class="up" id="up">
	<?php
		
		include_once '_Sidebar.php';
		
		// kas sisselogimisnuppu on vajutatud
		if (isset( $_POST['login_button'] )){
			if (userExists ($_POST['login_username'], $_POST['login_password'])){
				
				$_SESSION['login_user']= $_POST['login_username']; 
			}
			else{
				echo '<font color="red">Sisestati vale või puudulik info.</font>';
			}
		}
		else if (isset($_POST['fb'])){
			$_SESSION['login_user']= $_POST['fb']; 
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
		<div class="separator2"></div>
			<div class="s2">
			<form method="post">
				<input type="search2" value="<?php 
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
<!-- ------------------------------------------------------------------------------------- -->

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
				<input type="search" id="searchBig" placeholder="Search" name="search">
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
				<input type="search2" placeholder="Search SubPages" name="search" value="'.$_GET['search'].'">';
				
			if (isset($_GET['lecture'])){
				echo '<input type="hidden" name="lecture" value="' . $_GET['lecture'] . '" />';
			}
			echo'</form>';
			echo '<font color="white">Otsingu "'.$_GET['search'].'" tulemused';
			
			if (isset($_GET['lecture'])){
				echo ' kategoorias "'.$_GET['lecture'].'".</font>';
			}
			loe_postitused_failist ($_GET['search']);
		}
		
		// make profile page
		else if (isset($_GET['kontoloomine'])){
			include_once 'makeacc.php';
		}
		
		// meldimine
		else if (isset($_GET['settings'])){
			
			if (isset( $_SESSION['login_user'] )){
				echo'<font color="white">Settings page, to be created...</font>';
			}
			else if (isset($_POST['logout_button'])){
				echo '<script>window.location.href = "index.php";</script>';
			}
			else{
				echo '<script>window.location.href = "logon.php?settings=true";</script>';
			}
		}	
		
		// profile page
		else if (isset($_GET['profile'])){
			include_once 'profile.php';
		}
		
		// homepage
		else if (!isset($_GET['lecture']) && !isset($_GET['lehekylg'])){
			echo '<font color="white">Tere!<br/>Valige paremalt õppeaine.<br/><br/>';
			echo 'Testimist abistavad ajutised lingid:<br/>
				<a href="workspaceIndex.php">workspaceIndex</a><br/>';
			echo '<a href="workspacePost.php">workspacePost</a><br/>';
			echo '<a href="profile.php">profile</a><br/></font>';
		}
		

		// subreddit homepage
		else if (isset($_GET['lecture']) &&  !isset($_GET['lehekylg'])){
		
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
	
		// post page
		else if (isset($_GET['lecture']) &&  isset($_GET['lehekylg'])){
			include_once 'post.php';
		}

		// postituste otsimine filtri järgi
		function loe_postitused_failist ($filter){
			$data = file('...posts.txt');
			foreach ($data as $entryData) {
				$entryParts = explode(';', $entryData);
				foreach ($entryParts as $comm) {
			
					if ($comm != '' && stripos ($comm, $filter)!== false){
						
						if (isset($_GET['lecture'])){
							$aine=$_GET['lecture'];
						}
						else{
							$aine="Matemaatiline analüüs";
						}
						
						$post = new Post($comm, $aine);
						$post->draw_post();
					}
				}
			}
		}
		
		
		function userExists ($un, $pw){
			$data = file('...users.txt');
			foreach ($data as $entryData) {
				$entryParts = explode(';', $entryData);
				if ( stripos ($entryParts[0], $un) !== false && stripos ($entryParts[1], $pw) !== false ){
					return true;
				}
			}
			return false;
		}
		
	?>
</div>
</div>