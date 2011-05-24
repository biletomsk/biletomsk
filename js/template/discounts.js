
function addItem()
{
      	var field = 'Адрес<input type="text" id="adressphone" name="adres[]"/> Телефон <input type="text" id="adressphone" name="phone[]"/>';
	   
		var list = document.getElementById('adrphone');
		var li = document.createElement('LI')
		li.innerHTML = field
		list.appendChild(li)  	
}

$(function(){
	
	    $("#tabs-2 a").click(function(){
    
        var method = $(this).attr("title");
        var id = $("#nextid").val();
		
        
        var sta = 'toolbar=no,location=no,scrollbars=yes,directories=no,status=no,menubar=no,height=680,width=800,top=50,left=200,resizable=yes';
        window.open("/submenu/edit_" + method + "/" + id, "msgWindow1", sta);
        
    })
	
		$("img[alt=del_dis]").click(function(){
	 	var ids = $(this).attr("title");
	
			$.ajax({
	            url: '/submenu/ajax/',
	            type: 'POST',
	            data: 'type=delete_disitem&id=' + ids,
	            dataType: 'HTML',
	            success: function(result){
	            
					if(result == "OK")
					{
						$('li#'+ids).fadeOut(300);
					}
	             
	                
	                
	            }
			})
		})
	
 // выбор category of object
  function adjust(method,tmp,value){


  	if(value.length == 0) {

  	               
  		tmp.attr('disabled','disabled');
  		tmp.clearSelect();

  	} else {

		$.ajax({
		url:'/discounts/ajax/',
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
	
	function adjustOrganization(value)
	{
		
		if(value.length == 0)
		{
			var advMenu = $('#organization').html();
			
			if(advMenu == '')
			{
				$('#organization').append('<td>Организация</td><td colspan="2"><input type="text" name="dis_org"/>	если не существует объекта	<br/><input type="text" name="dis_email" value="" id="dis_e-mail"/> e-mail организации <br/><input type="text" name="dis_site" value="" id="dis_site"> сайт организации	</td>');
			}
			else
			{
				$("#ajax_big_logo").remove();
				$("#ajax_mini_logo").remove();
				$("#big_logo").show();
				$("#mini_logo").show();
				$('#organization').show();
				
			}
			
			
		
		}
		else
		{
						
			$('#organization').hide();
			
		}
	}	

 $('#object').change(function(){
 	
	$("#big_logo").hide();
	$("#mini_logo").hide();
	var object = $(this).val();
	$.ajax({
		url:'/discounts/ajax/',
		type:'POST',
		data: 'action=setlogotypes&id='+object,
		dataType: 'HTML',
		success: function(result){
				
				$("#mytable").prepend(result);


			}
		});
 })

  $('#category').change(function(){
  	var method = 'setsubcategory';   
  	var categoryValue = $('#category').val();
  	var tmpSelect = $('#subcategory');
  	adjust(method,tmpSelect,categoryValue);
  });
  
 $('#subcategory').change(function(){
	 var method = 'setdiscount';
	 var subcategoryValue = $('#subcategory').val();
	 var tmpSelect = $('#discount');
	 adjust(method,tmpSelect,subcategoryValue);
	 
 })
 
 
  $('#objcategory').change(function(){
  	
  	var method = 'setobjcategory';   
  	var categoryValue = $('#objcategory').val();
	
	
  	var tmpSelect = $('#object');
	adjustOrganization(categoryValue);
  	adjust(method,tmpSelect,categoryValue);
	
	
  });
  
  
  
  
  $("li span a").click(function(){
  	
	var ids = $(this).attr("id");
	$.ajax({
			            url: '/submenu/ajax/',
			            type: 'POST',
			            data: 'type=delete_disitem&id=' + ids,
			            dataType: 'HTML',
			            success: function(result){
			            
							if(result == "OK")
							{
								$('li#'+ids).fadeOut(300);
							}
			             
			                
			                
			            }
					})
  	
  })
  
  

});