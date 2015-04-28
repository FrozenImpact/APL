<?php
require_once 'db/sql_functions.php';

class Post {
	private $id;
	private $tiitel;
	private $category;
	private $postDate;
	private $score;
	
	
	public function __construct ($id, $tiitel, $category, $postDate, $score) {
		$this->id = $id;
		$this->tiitel = $tiitel;
		$this->category = $category;
		if ($postDate ==""){
			$this->postDate = "";
		}else{
			$this->postDate = formatDate($postDate);
		}
		$this->score = $score;
	}
	


	public function draw_post (){
		
		$upmod = "'upmod'";
		$downmod = "'downmod'";
		
		
		if ( isset( $_SESSION['login_user']) ){
			$onClickScriptUp = 'onclick="$.post( 
		\'upvote.php\', 
		{ id: '.$this->id.', usr: '.$_SESSION['login_user_id'].' }, 
		function( data ){ 
		});this.classList.toggle( '.$upmod.' ); "';
		
			$onClickScriptDown = 'onclick="$.post( 
		\'downvote.php\', 
		{ id: '.$this->id.', usr: '.$_SESSION['login_user_id'].' }, 
		function( data ){ 
		});this.classList.toggle( '.$downmod.' ); "';
		}
		else{
			$userMessage = "'Only avaiable to registered users.'";
			$onClickScriptUp = 'onclick="alert('.$userMessage.')"';
			$onClickScriptDown = 'onclick="alert('.$userMessage.')"';
		}

		// replies: '.count(getAllComments($this->id)).'
		// <a id="upvote" '.$onClickScriptUp.' ><span></span></a>
		// <a id="downvote" '.$onClickScriptDown.' ><span></span></a>
		echo '
			<div class="postBoxRow">
		<div class="vertIcon">
		</div>
		<div class="postBox">	
			<div class="voteBox">
				
				<a class="s1" '.$onClickScriptUp.' ><img class="mid" src="img/upV.png" width="50" height="50" alt="" /></a>
				
			</div>
			<div class="postDataBox">	
				<div class="postDataBoxUp">	
					<a class="s1" href="index.php?lecture=' .$this->category. '&lehekylg=' .$this->tiitel. '&post_id=' .$this->id. '">' .$this->tiitel. '</a>
					
				</div>
				<div class="postDataBoxDown">
					<div class="dataComments">	
						<a class="h">Replies: ??</a>
						
					</div>
					<div class="dataScore">	
						<a class="i1">' .$this->score. '</a>
						
					</div>				
					<div class="dataDate">	
						<a class="h">' .$this->postDate. '</a>
						
					</div>
				</div>			
			</div>			
			<div class="voteBox">
				
				<a class="s1" '.$onClickScriptUp.' ><img class="mid" src="img/downV.png" width="50" height="50" alt="" /></a>
				
			</div>				
		</div>	
	</div>
		';

	}
	public function draw_post_mini (){	
			echo'<div class="downBoxRow1">
				<a class="n1" href="index.php?lecture=' .$this->category. '&lehekylg=' .$this->tiitel. '&post_id=' .$this->id. '"><b>' .$this->tiitel. '</b></a>
			</div>';
	}


}

?>