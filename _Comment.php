<?php
class Comment {
	private $id;
	private $sisu;
	private $autor;
	private $kuup2ev;
	private $skoor;
	private $fbUser;
	private $parentPostId;
	
	public function __construct ($id, $sisu, $author, $date, $score) {
	$this->id = $id;
	$this->sisu = $sisu;
	if ($sisu == ""){
		$this->sisu = "-";
	}
	
	if ($author[0]['Password'] == null){
		$this->fbUser = true;
	}else{
		$this->fbUser = false;
	}
	
	$this->autor = $author[0]['Name'];
	$this->kuup2ev = formatDate($date);
	$this->skoor = $score;
}

	public function setParentPostId ($parentPostId){
		$this->parentPostId = $parentPostId;		
	}
 

	public function draw_comment (){
		
		if (isset($this->parentPostId)){
			$urlLine = '<a class="n1" href="index.php?p='.urlencode($this->parentPostId).'"> Click here for OP </a>';
		}	
		else if ($this->fbUser){
			$fbIcon = '<img src="img/facebook-icon.png" width="10" height="10"/>';
			$urlLine = '<a class="n1" href="index.php?profile='.urlencode($this->autor).'">'.$fbIcon.''.$this->autor.' </a>';
		}
		else{
			//$fbIcon = '';
			$urlLine = '<a class="n1" href="index.php?profile='.urlencode($this->autor).'">'.$this->autor.' </a>';
		}
		
		
		if ( isset( $_SESSION['login_user']) ){
			$onClickScriptUp = 'onclick="$.post( 
		\'upvote.php\', 
		{ comm_id: '.$this->id.', usr: '.$_SESSION['login_user_id'].' }, 
		function( data ){ 
			if (data != \'jah\'){
				$(\'#infobox\').empty();
				$( \'#infobox\').append( \'<upC>Upvoted comment: '.$this->sisu.'</upC>\' );
			}
			else{
				$(\'#infobox\').empty();
				$( \'#infobox\').append( \'<y>You have already voted on this: '.$this->sisu.'</y>\' );				
			}		
		}); "';
		
			$onClickScriptDown = 'onclick="$.post( 
		\'downvote.php\', 
		{ comm_id: '.$this->id.', usr: '.$_SESSION['login_user_id'].' }, 
		function( data ){ 
			if (data != \'jah\'){
				$(\'#infobox\').empty();
				$( \'#infobox\').append( \'<downC>Downvoted comment: '.$this->sisu.'</downC>\' );
			}
			else{
				$(\'#infobox\').empty();
				$( \'#infobox\').append( \'<y>You have already voted on this: '.$this->sisu.'</y>\' );				
			}		
		}); "';
		}
		else{
			$onClickScriptUp = 'onclick="
			$(\'#infobox\').empty();
			$( \'#infobox\').append( \'<y>Voting is only available to registered users.</y>\' );"';
			$onClickScriptDown = $onClickScriptUp;
		}
		
		
		echo '
		<div class="postBox">	
			<div class="voteBox">
				<a class="s1" '.$onClickScriptUp.' ><img class="mid" src="img/upV.png" width="30" height="30" alt="" /></a>
			</div>
		
			<div class="postDataBox">
				<div class="postDataBoxUp">	
					<a class="w">' .$this->sisu. '</a>
				</div>
				
				<div class="postDataBoxDown">
					<div class="dataComments">	
						'.$urlLine.'
					</div>
					<div class="dataScore">	
						<a class="i1">'.$this->skoor.'</a>
					</div>				
					<div class="dataDate">	
						<a class="h">'.$this->kuup2ev.'</a>
					</div>
				</div>					
			</div>		
			
			<div class="voteBox">
				<a class="s1" '.$onClickScriptDown.' ><img class="mid" src="img/downV.png" width="30" height="30" alt=""/></a>
			</div>
				
	</div><br/><br/>';

	}

}

?>