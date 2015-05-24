function readClasses() {
	$('#scroller2').empty();
	$( '#scroller2').append( '<a class="w">Loading...</a>' );
	$.post( 
	'readClasses.php', 
	{ filter: $("#class_search_entry").val() }, 
	function( data ){ 
		//$('#down li').remove();
		$('#scroller2').empty();
		$( '#scroller2').append( data );
	});
}


// hides right panel when screen size is lesser than 800
function suurus(){
	if ($(window).width() < 800){
		
		// Hack to get 320x480 semi-working. Default width for right pane is 400. Manually adjust 2 elements.
		if ($(window).width() < 400){
			$("#upDownRight").css('text-align', 'left');
			$("#upDownRight").css('padding-right', '0px');
			$("#upDownRight").css('padding-left', '10px');
			$("#scroller2").css('width', $(window).width()-30);
		}
		else{
			$("#upDownRight").css('text-align', 'right');
			$("#upDownRight").css('padding-right', '10px');
			$("#upDownRight").css('padding-left', '0px');
			$("#scroller2").css('width', '376px');
		}
		
		// hide right pane
		$("#right").hide();
		$("#left").css('right', '15px');
		$("#sidebar_toggle_button_container").show();
	}
	else {
		// revert everything to original css
		$("#right").show();
		$("#left").css('right', '415px');
		$("#sidebar_toggle_button_container").hide();
		
		$("#right").css('position', 'absolute');
		$("#right").css('top', '0px');
		$("#head").css('position', 'absolute');
		$("#head").css('right', '-15px');
	}	
}


// Toggles whether right panel is visible or not. Activated when user click button.
function toggleRight(){
	if ( $("#left").css('right') == '415px' ){
		$("#left").css('right', '15px');
		
		$("#right").css('position', 'absolute');
		$("#right").css('top', '0px');
		$("#head").css('position', 'absolute');
		$("#head").css('right', '-15px');
	}
	else{
		$("#left").css('right', '415px');
		$("#right").css('position', 'relative');
		$("#right").css('top', '50px');
		$("#head").css('position', 'fixed');
		$("#head").css('right', '0px');
	}
	$("#right").toggle();
	
}

$( window ).resize(function() {
	suurus();
});


$(document).ready(function() {
	

	suurus();
	$("#sidebar_toggle_button_container").append('<a class="headLink" id="sidebar_toggle_button">></a>');
	$("#sidebar_toggle_button").click(function() { toggleRight(); });
	
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
		$( '#priit').append( '<a class="w"><br/><br/><br/>Loading...</a>' );
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