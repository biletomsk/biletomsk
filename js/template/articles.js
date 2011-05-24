$(function(){


    $("#kategoria").change(function(){
        var cat = $(this).val();
        
        window.location = "http://admin.biletomsk.ru/articles/show_category/" + cat;
        
    })
    
    
   
    
})
