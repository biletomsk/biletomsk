<div id="dashboard2">
    <h2 class="ico_mug">Редактирование галереи объекта</h2>
    <?php echo @$message; ?>
    <br/>
    <form action="<?php echo base_url();?>submenu/update_gallery/<?php echo $this->uri->segment(3); ?>" enctype="multipart/form-data" method="post">
      	<input type="hidden" id="hiddendata" name="submenu" value="delete_gallitem"/>
      	<input type="hidden" id="hiddendata2" name="submenu" value="edit_gallitem"/>
        <div class="panel2 photo2 left">
            <?php 
            if ($photos) {
                echo '<ul class="clearfix">';
                foreach ($photos as $item) {
                
                    echo '<li id="'.$item->gal_ids.'">
					<img height="120" width="140" src="'.$path.$item->gal_img.'" alt="photo"/>
					<span style="width:140px;pading:5px; background-color:#fff;">
					<a id="'.$item->gal_ids.'" class="delete" title="удалить" href="#">
					<img src="'.base_url().'img/cancel.jpg"  alt="удалить"/>
					</a>
					<a id="'.$item->gal_ids.'" class="edit" title="редактировать" href="#">
					<img src="'.base_url().'img/edit.jpg" alt="редактировать"/>
					</a>
					'.$item->gal_txt.'
					</span>
					</li>';
                }
                echo '</ul>';
            } else {
                echo '<div id="warning" class="info_div"><span class="ico_error">Элементы графического меню отсутствуют</span></div>';
            }
            
            ?>
        </div>
        <!-- end #photo -->
        <div>
            <input name="MAX_FILE_SIZE" value="1000000" type="hidden"/>Выберите фотографии <span style="color:red;">*</span>:<input name="IMAGES[]" id="fileToUpload" class="MultiFile" type="file"/>
        </div><input type="submit" value="Обновить" name="do"/> 
        <input type="button" onClick="window.close();" class="button" value="Закрыть"/></form>
</div><!-- end #dashboard -->
 <div id="dialog" class="dialog" title="Редактировать фотографию">
 
				<div id="block">

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
