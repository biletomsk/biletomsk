

$(function(){
	
	
	  $("#kategoria").change(function(){
  	var cat = $(this).val();
	
	window.location = "http://admin.biletomsk.ru/news/show_category/"+cat;
	
  })
	
 // выбор category of object
  function adjustObject(){

   
  	var categoryValue = $('#setCategory').val();
  	var tmpSelect = $('#setObject');
  	if(categoryValue.length == 0) {

  	               
  		tmpSelect.attr('disabled','disabled');
  		tmpSelect.clearSelect();

  	} else {

		$.ajax({
		url:'/news/ajax/',
		type:'POST',
		data: 'category='+categoryValue,
		dataType: 'JSON',
		success: function(result){
				var data = eval('('+ result +')');
              tmpSelect.clearSelect().fillSelect(data).attr('disabled','')


			}
		});

  	}
  };
 

	function adjustSport()
	{
		var categoryValue = $("#new_type").val();
		var tmpSelect = $('#selectsport');
		if(categoryValue == 5)
		{
			$.ajax({
			url:'/news/ajax/',
			type:'POST',
			data: 'newscategory='+categoryValue,
			dataType: 'JSON',
			success: function(result){
					var data = eval('('+ result +')');
	              tmpSelect.clearSelect().fillSelect(data).attr('disabled','')
	
	
				}
			});
		}
		else
		{
			tmpSelect.attr('disabled','disabled');
  			tmpSelect.clearSelect();	
		}
	}


  $('#setCategory').change(function(){
  	adjustObject();
  });
  
  $("#new_type").change(function(){
  	adjustSport();
  })

});


