<div id="dashboard2">
    <h2 class="ico_mug">Редактирование схем расположения объекта</h2>
    <?php echo @$message; ?>
    <br/>
    <form action="<?php echo base_url();?>submenu/update_scheme_of_map/<?php echo $this->uri->segment(3); ?>" enctype="multipart/form-data" method="post">
       <input type="hidden" id="hiddendata" name="submenu" value="delete_mapitem"/>
        <div class="panel2 photo2">
            <?php 
            if ($image_map) {
                echo '<ul class="clearfix">';
                foreach ($image_map as $item) {
                
                    echo '<li id="'.$item->mapz_ids.'">
                    <img height="'.$item->mapz_h.'" width="'.$item->mapz_w.'" src="'.base_site_url().$path.$item->mapz_img.'" alt="photo"/>
                    <span style="width:'.$item->mapz_w.'px;pading:5px; background-color:#fff;">
                    
                    <a id="'.$item->mapz_ids.'" class="delete" title="удалить" href="#">
                    <img src="'.base_url().'img/cancel.jpg"  alt="deny"/>
                    </a>
                    <a id="'.$item->mapz_ids.'" class="edit" title="редактировать" href="#">
					<img src="'.base_url().'img/edit.jpg" alt="редактировать"/>
					</a>
                    '.stripslashes($item->mapz_alt).'
                    </span></li>';
                }
                echo '</ul>';
            } else {
                echo '<div id="warning" class="info_div"><span class="ico_error">Элементы графического меню отсутствуют</span></div>';
            }
            
            ?>
        </div>
        <!-- end #photo -->
        <div>
            <h3>Добавить схемы</h3>
            <input name="MAX_FILE_SIZE" value="1000000" type="hidden"/>Выберите изображения <span style="color:red;">*</span>:<input name="IMAGES[]" id="fileToUpload" class="MultiFile" type="file"/>
        </div><input type="submit" value="Обновить" name="do"/>
        <input type="button" onClick="window.close();" class="button" value="Закрыть"/>
         
    </form>
</div><!-- end #dashboard -->
<script type="text/javascript">
    //multiFile
    $('.MultiFile').MultiFile({
        accept: 'jpg',
        max: 150,
        STRING: {
            remove: '<img style="border: 0px;" src="<?php echo base_url();?>img/bin.gif" height="16" width="16" alt="x"/>',
            file: '$file | описание фото: <input type="text" name="ftxt[]"/>',
            selected: ' Выбраны: $file ',
            denied: 'Неверный тип файла: $ext!',
            duplicate: 'Этот файл уже выбран:\n$file!'
        }
    });
</script>
