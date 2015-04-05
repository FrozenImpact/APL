<?php
	include_once '_Post.php';
	
	
	echo'
	<div class="downBoxRow1">
		<a class="n1"><b>___</b></a>
	</div>
	';
	
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
?>