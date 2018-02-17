$(function(e){
	
	$("a#update").click(function(){
		var mabh = $("input#mabh").val();
		var id = $("input#idBH").val();
		if(parseInt(id) > 0){
			jQuery.ajax({
				url: "../ajax/update_mabh.php",
				type: "POST",
				data: 'mabh='+mabh+'&id='+id,
				success: function (res) {
					if(res == 1){
						$("div#mess").removeClass("mess_fail").addClass("mess_updated").html("<font style='color: blue;'>Update successful.</font>");
					}
					else if(res == 0){
						$("div#mess").removeClass("mess_updated").addClass("mess_fail").html("<font style='color: red;'>Update fail.</font>");
					}
					
				}		
			});
		}
		else {
			alert("Please type number");
		}
	});//End a#update click
});

