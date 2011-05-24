<script type="text/javascript">
    
    $(function(){
    
    
        $("img[alt=del]").click(function(event){
        
        
        
            var id = $(this).attr('title');
            $.ajax({
                url: '/submenu/ajax/',
                type: 'POST',
                data: 'type=delete_item&id=' + id,
                dataType: 'HTML',
                success: function(result){
                
                    if (result == "OK") {
                        $("li#"+id).fadeOut(300);
                    }
                    
                    
                }
            });
            
            
        });
        
    });
    
    
    //multiFile
    $('.MultiFile').MultiFile({
        accept: 'jpg',
        max: 150,
        STRING: {
            remove: '<img style="border: 0px;" src="<?php echo base_url();?>img/bin.gif" height="16" width="16" alt="x"/>',
            file: '$file | описание фото: <textarea rows="5" cols="50" name="ftxt[]"></textarea> ',
            selected: ' Выбраны: $file ',
            denied: 'Неверный тип файла: $ext!',
            duplicate: 'Этот файл уже выбран:\n$file!'
        }
    });
</script>

    <div class="panel2 photo2">
        <?php 
        if ($photos) {
            echo '<ul class="clearfix">';
			$i=0;
            foreach ($photos as $item) {
            
                echo '<li id="'.$i.'" style="height:110px; width:110px;"><img height="100" src="'.base_site_url().$path.$item.'" alt="photo"/><span>'.$item.'<a  href="#"><img src="'.base_url().'img/cancel.jpg" title="'.$i.'" alt="del"/></a></span></li>
        					';
							$i++;
            }
            echo '</ul>';
        } else {
            echo '<div id="warning" class="info_div"><span class="ico_error">Элементы графического меню отсутствуют</span></div>';
        }
        
        ?>
    </div>
    <!-- end #photo -->

<div>
    <input name="MAX_FILE_SIZE" value="1000000" type="hidden"/>Выберите фотографии <span style="color:red;">*</span>:<input name="IMAGES[]" id="fileToUpload" class="MultiFile" type="file"/><input type="submit" value="Обновить" name="do"/>
</div>