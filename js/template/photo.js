$(function(){



  function adjust(method,tmp,value){


  	if(value.length == 0) {

  	               
  		tmp.attr('disabled','disabled');
  		tmp.clearSelect();

  	} else {

		$.ajax({
		url:'/photoarchive/ajax/',
		type:'POST',
		data: 'action='+ method +'&id='+value,
		dataType: 'JSON',
		success: function(result){
				var data = eval('('+ result +')');
              tmp.clearSelect().fillSelect(data).attr('disabled','')


			}
		});

  	}
  };
  
  function adjustUpload(method,type)
  {
  	if(type.length == 0)
	{
		$("#uploadform").empty();
		
		
	}else {
		
		$.ajax({
		url:'/photoarchive/ajax/',
		type:'POST',
		data: 'action='+ method +'&id='+type,
		dataType: 'HTML',
		success: function(result){
			$("#uploadform").append(result);


			}
		});
		
	



  	}
  }
  
  	$("#uploadtype").change(function(){
		
		var method = 'setuploadform';
		var type	= $("#uploadtype").val();
		adjustUpload(method,type);
		
	})
  
  
    $('#objcategory').change(function(){
  	
  	var method = 'setobjcategory';   
  	var categoryValue = $('#objcategory').val();
	
	
  	var tmpSelect = $('#object');
	
  	adjust(method,tmpSelect,categoryValue);
	
	
  });
  
  
  $("#kategoria").change(function(){
  	var cat = $(this).val();
	
	window.location = "http://admin.biletomsk.ru/photoarchive/show_category/"+cat;
	
  })
  
  

})