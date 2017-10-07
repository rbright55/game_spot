	$(document).ready(function(){
		$(function() {
		    $.stayInWebApp();
		});
		$("#open").fadeIn(800);

	    $("#play").click(function(){
	        $(".appPage").hide();
	        $("#games").fadeIn();
	    });
	    $("#TopP").click(function(){
	        sqlOptions();
	        $(".appPage").hide();
	        $("#topPlayers").fadeIn();
	    });
	    $("#signupb").click(function(){
	        $(".appPage").hide();
	        $("#signup").fadeIn();
	    });
	    $("#account_button").click(function(){
	        lookup();
	        $(".appPage").hide();
	        $("#account_page").fadeIn();
	    });
	    $(".backPage").click(function(){
	    	$(".appPage").hide();
	        $("#open").slideDown();
	    });
	    $('#lock_inp').click(function(){
	    	if(document.getElementById("username_box").readOnly){
	   		 	$('#username_box').attr('readonly', false);
	   		 	$("#lockunlock").hide();
	   		 	$('#lockunlock').attr('class', "fa fa-unlock fa-2x");
	   		 	$('#lockunlock').fadeIn();
	   		 	$( "#username_box" ).focus();
	   		 } else{
	   		 	$('#username_box').attr('readonly', true);
	   		 	$("#lockunlock").hide();
	   		 	$('#lockunlock').attr('class', 'fa fa-lock fa-2x');
	   		 	$('#lockunlock').fadeIn();
	   		 	lookup();
	   		 }
		});
	});