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
			$onClickScriptUp = 'onclick="
		$.post( 
		\'upvote.php\', 
		{ id: '.$this->id.', usr: '.$_SESSION['login_user_id'].' }, 
		function( data ){
			if (data != \'jah\'){
				$(\'#infobox\').empty();
				$( \'#infobox\').append( \'<upC>Upvoted post: '.$this->tiitel.'</upC>\' );
			}
			else{
				$(\'#infobox\').empty();
				$( \'#infobox\').append( \'<y>You have already voted on this: '.$this->tiitel.'</y>\' );				
			}			
		});
		this.classList.toggle( \'upmod\' ); 

		"';
		
			$onClickScriptDown = 'onclick="$.post( 
		\'downvote.php\', 
		{ id: '.$this->id.', usr: '.$_SESSION['login_user_id'].' }, 
		function( data ){ 
			if (data != \'jah\'){
				$(\'#infobox\').empty();
				$( \'#infobox\').append( \'<downC>Downvoted post: '.$this->tiitel.'</downC>\' );
			}
			else{
				$(\'#infobox\').empty();
				$( \'#infobox\').append( \'<y>You have already voted on this: '.$this->tiitel.'</y>\' );				
			}
		});
		this.classList.toggle( \'downmod\' ); 

		"';
		}
		else{
			$onClickScriptUp = 'onclick="
			$(\'#infobox\').empty();
			$( \'#infobox\').append( \'<y>Voting is only available to registered users.</y>\' );"';
			$onClickScriptDown = $onClickScriptUp;
		}

		// replies: '.count(getAllComments($this->id)).'
		// <a id="upvote" '.$onClickScriptUp.' ><span></span></a>
		// <a class="s1" '.$onClickScriptUp.' ><img class="mid" src="img/upV.png" width="50" height="50" alt="" /></a>
		// <a class="s1" '.$onClickScriptUp.' ><img class="mid" src="img/downV.png" width="50" height="50" alt="" /></a>
		// <a id="downvote" '.$onClickScriptDown.' ><span></span></a>
		echo '
	<div class="postBoxRow">
		<div class="vertIcon">
		</div>
		<div class="postBox">	
			<div class="voteBox">
				<a id="upvote'.$this->id.'" class="upvote" '.$onClickScriptUp.' ><span></span></a>
				
				
			</div>
			<div class="postDataBox">	
				<div class="postDataBoxUp">	
					<a class="s1" href="index.php?lecture=' .urlencode($this->category). '&amp;lehekylg=' .urlencode($this->tiitel). '&amp;post_id=' .urlencode($this->id). '">' .$this->tiitel. '</a>
					
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
								
				<a id="downvote'.$this->id.'" class="downvote" '.$onClickScriptDown.' ><span></span></a>
				
			</div>				
		</div>	
	</div>
		';

	}
	
	// probably obsolete
	public function draw_post_mini (){	
			echo'<div class="downBoxRow1">
				<a class="n1" href="index.php?lecture=' .$this->category. '&amp;lehekylg=' .$this->tiitel. '&amp;post_id=' .$this->id. '"><b>' .$this->tiitel. '</b></a>
			</div>';
	}


}

?>