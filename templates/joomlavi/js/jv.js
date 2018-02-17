//Pagination Ajax
/*
$("#showmore").click(function(){ 
var rel = $("#showmore").attr("rel");
$.ajax({
	url: "http://localhost/nova/index.php?option=com_jv&task=getMoreProduct",
	type: "POST",
	data: "page="+rel,
	success: function (res) {
		//alert(res);return;
		if(res != "0") {
			obj = jQuery.parseJSON(res);
			for(var i=0;i< obj.length; i++){
				$("#plist").append(obj[i]);
			}
			$("#showmore").attr("rel", (rel*1 + 1));
		}
		else {
			$("#showmore").hide();
		}
	}
});  

});
*/
$(document).ready(function(){
	
	jQuery(".gototop").click(function(){
		  jQuery("html, body").animate({ scrollTop: 0 }, "slow");	
	});
	
	h = $(window).height();
	$('section.main').css({'min-height':(h-120)});
});
