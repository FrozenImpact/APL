<?php
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
		$this->postDate = $postDate;
		$this->score = $score;
	}

	public function draw_post (){
		
		$upmod = "'upmod'";
		$downmod = "'downmod'";
		
		echo '
			<div class="postBoxRow" id="postBoxRow">
		<div class="vertIcon">
		</div>
		<div class="postBox">	
			<div class="voteBox">
					<a id="upvote" href="#" onclick="this.classList.toggle( '.$upmod.' );"><span></span></a>
				
			</div>
			<div class="postDataBox">	
				<div class="postDataBoxUp">	
					<a class="s1" href="index.php?lecture=' .$this->category. '&lehekylg=' .$this->tiitel. '&post_id=' .$this->id. '">' .$this->tiitel. '</a>
					
				</div>
				<div class="postDataBoxDown">
					<div class="dataComments">	
						<h>Replies: ??</h>
						
					</div>
					<div class="dataScore">	
						<i1>' .$this->score. '</i1>
						
					</div>				
					<div class="dataDate">	
						<h>' .$this->postDate. '</h>
						
					</div>
				</div>			
			</div>			
			<div class="voteBox">
					<a id="downvote" href="#" onclick="this.classList.toggle( '.$downmod.' );"><span></span></a>
				
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