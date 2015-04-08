// mõned lisaomadused, mida igal leheküljel vaja ei lähe, näiteks data push ja offline text editing
function checkConnection() {
	$.post('checkServerConnection.php', function(data){ 
		$('#infobox').empty(); 
		perioodiliselt_tehtav();
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
			$( '#infobox').append( '\
			<font color="red">TÄHELEPANU: Ühendus serveriga katkes.\
			Võite teksti kirjutamist jätkata, sest selle mustandit talletatakse teie arvutis.\
			</font>\
			' );
		}
	})
	
	// küpsised, poolelioleva vastuse mustandi võrguühenduseta redigeerimiseks
	// comment
	$("#comment").val($.cookie("example"))
	$("#comment").keyup(function() {
		$.cookie("example", $("#comment").val());
	});
	
	// new post
	$("#title").val($.cookie("example2"))
	$("#title").keyup(function() {
		$.cookie("example2", $("#title").val());
	});
	
	$("#kehatekst").val($.cookie("example3"))
	$("#kehatekst").keyup(function() {
		$.cookie("example3", $("#kehatekst").val());
	});
	
	// kasutaja informeerimine võrguühenduse katkemisest
	setInterval(function(){
		checkConnection();
	}, 1000);
	
	
/* 	$("#scroller1").scroll(function () {
		if ($("#scroller1").height() <= $("#scroller1").scrollTop() + $("#scroller1").height()) {
			$.post( 
				'drawPosts.php',
				function( data ){
					$( '#scroller1').append( data );
			});
		}
	}); */
	
});