
 $(function){

 	 $.ajax({
                url: "/graph",
                type:"GET",
                success: function(result){

                		console.log(result.);
                    },
                error: function (data) {
                    alert(data.status);
                    }
                 });
 }