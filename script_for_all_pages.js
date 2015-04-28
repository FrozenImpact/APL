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
	
	
	/*
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
	*/
});