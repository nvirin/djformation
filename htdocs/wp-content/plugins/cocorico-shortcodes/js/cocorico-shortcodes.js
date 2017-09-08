jQuery(document).ready(function($) {
	if(jQuery().tabs) { // If this page contains tabs
     	$(function(){
			$( ".cs_tabs" ).tabs();
		});
	}
});

jQuery(document).ready(function($) {
	if(jQuery().toggle) { // If this page contains toggle
     	$(function(){
			$(".cs_toggle_content").hide();
			
			$(".cs_toggle_button").toggle(function(){
				$(this).addClass("toggle-active");
				}, function () {
				$(this).removeClass("toggle-active");
			});
			
			$(".cs_toggle_button").click(function(){
				$(this).next(".cs_toggle_content").slideToggle("fast");
				return false;
			});
		});
	}
});