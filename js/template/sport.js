
$(function(){




    $("#tabs-4 a").click(function(){
    
        var method = $(this).attr("title");
        var id = $("#sportid").val();
		var type = "SPORT";
        
        var sta = 'toolbar=no,location=no,scrollbars=yes,directories=no,status=no,menubar=no,height=680,width=800,top=50,left=200,resizable=yes';
        window.open("/submenu/edit_" + method + "/" + id+ "/" + type, "msgWindow1", sta);
        
    })
	
	
	$("#tabs-3 a[title=delete]").click(function(){
		var ids = $(this).attr("id");
		$.ajax({
		            url: '/sport/ajax/',
		            type: 'POST',
		            data: 'type=delete_rat&id=' + ids,
		            dataType: 'HTML',
		            success: function(result){
		            
						if(result == "OK")
						{
							$('p#'+ids).fadeOut(300);
						}
		             
		                
		                
		            }
				})
		
	})	
	
	 $("img[alt=del_sb]").click(function(){
	 	var ids = $(this).attr("title");
		
			$.ajax({
	            url: '/submenu/ajax/',
	            type: 'POST',
	            data: 'type=delete_sb&id=' + ids,
	            dataType: 'HTML',
	            success: function(result){
	            
					if(result == "OK")
					{
						$('li#'+ids).fadeOut(300);
					}
	             
	                
	                
	            }
			})
		})
		
	
    $("img[alt=edit]").click(function(){
        var ids = $(this).attr("title");
        
        $.ajax({
            url: '/submenu/ajax/',
            type: 'POST',
            data: 'type=edit_feedback&id=' + ids,
            dataType: 'HTML',
            success: function(result){
            
                $("#block").append(result);
                
                
            }
        });
        $("#dialog").dialog({
            buttons: {
                "Сохранить": function(){
                    var feed_txt = $("#feedback_text").val();
					var feed_stat  = $("input:checked").val();
					var feed_ids = $("input[type=hidden]").val();
					
					
					var data = feed_ids+'::'+feed_txt+'::'+feed_stat;
			        $.ajax({
			            url: '/submenu/ajax/',
			            type: 'POST',
			            data: 'type=update_feedback&data='+data,
			            dataType: 'HTML',
			            success: function(result){
			            
			               if(result == 'OK')
						   {
						   		var success = '<span style="background-color:#390; color:#FFF; padding:0px 2px;">изменено</span>';
						   		$("td#"+feed_ids).text(' ').append(feed_txt + success).fadeIn(500);
								
						   }
			                
			                
			            }
			        });
				$("#block").text(' ');	
				 $(this).dialog("close").dialog("destroy");	
					
					
                },
                "Отмена": function(){
					$("#block").text(' ');	
                    $(this).dialog("close").dialog("destroy");
                }
            },
			width: 400,
			modal: true
        });
    }).end();
    
    
});
