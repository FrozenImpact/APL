            document.querySelector( "#upvote" )
                .addEventListener( "click", function() {
                    this.classList.toggle( "upmod" );
                });

            document.querySelector("#downvote")
                .addEventListener("click", function(){
                    this.classList.toggle("downmod");
                });