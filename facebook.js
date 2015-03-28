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