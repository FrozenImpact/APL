<?php
class Comment {
	private $sisu;
	private $autor;
	private $kuup2ev;
	private $skoor;
	private $fbUser;
	
	public function __construct ($sisu, $author, $date, $score) {
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
 

	public function draw_comment (){
		
			
		if ($this->fbUser){
			$fbIcon = '<img src="img/facebook-icon.png" width="10" height="10"/>';
		}
		else{
			$fbIcon = '';
		}
		
		
		echo '
		<div class="postBox">	
			<div class="voteBox">
				<a class="s1" href="#"><img class="mid"" src="img/upV.png" width="30" height="30" alt="" /></a>
			</div>
		
			<div class="postDataBox">
				<div class="postDataBoxUp">	
					<a style="color:white;">' .$this->sisu. '</a>
				</div>
				
				<div class="postDataBoxDown">
					<div class="dataComments">	
						<a class="n1" href="index.php?profile='.$this->autor.'">'.$fbIcon.''.$this->autor.' </a>
					</div>
					<div class="dataScore">	
						<i1>'.$this->skoor.'</i1>
					</div>				
					<div class="dataDate">	
						<h>'.$this->kuup2ev.'</h>
					</div>
				</div>					
			</div>		
			
			<div class="voteBox">
				<a class="s1" href="#"><img class="mid" src="img/downV.png" width="30" height="30" alt=""/></a>
			</div>
				
	</div><br/><br/>';

	}

}

?>