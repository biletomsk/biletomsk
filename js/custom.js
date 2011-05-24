$(function(){
		   
	$.datepicker.setDefaults($.extend($.datepicker.regional["ru"]));
	$('#datepicker').datepicker({inline: true});
	$('#datepicker2').datepicker({inline: true});
	
	initMenu();
	$('.info_div').click(function() {$(this).fadeOut('slow')});

	$('#tabs').tabs();

	$("#tabledata").resizable({ maxWidth: 940 });
	
	});
	
	



 function initMenu() {
  $('#menu ul').hide();
  
  $('#menu li a').click(
  function() {
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
  return false;
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
  $('#menu ul:visible').slideUp('normal');
  checkElement.slideDown('normal');
  return false;
  }
  }
  );
  }				
