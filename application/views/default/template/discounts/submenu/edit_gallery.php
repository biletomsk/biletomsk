<div id="dashboard2">
    <h2 class="ico_mug">Редактирование галереи товаров</h2>
    <?php echo @$message; ?>
    <br/>
    <form action="<?php echo base_url();?>submenu/update_dis_gallery/<?php echo $this->uri->segment(3); ?>" enctype="multipart/form-data" method="post">
        <div class="panel2 photo2 left">
            <?php 
			
		
            if ($gallery) {
                echo '<ul class="clearfix">';
                foreach ($gallery as $item) {
                
                    echo '<li style="height:110px;" id="'.$item->dg_id.'">
					<img  width="110" height="110" src="'.base_site_url().$path.$item->dg_img.'" alt="photo"/>
					<span style="width:110px;pading:5px; background-color:#fff;"> 
					<a id="'.$item->dg_id.'" title="удалить" href="#">
					<img src="'.base_url().'img/cancel.jpg"  alt="удалить"/>
					</a> '.$item->dg_description.'</span></li>		';
                }
                echo '</ul>';
            } else {
                echo '<div id="warning" class="info_div"><span class="ico_error">Товары отсутсвуют</span></div>';
            }
            
            ?>
        </div>
        <!-- end #photo -->
        <div>
            <input name="MAX_FILE_SIZE" value="1000000" type="hidden"/>Выберите фотографии <span style="color:red;">*</span>:<input name="IMAGES[]" id="fileToUpload" class="MultiFile" type="file"/>
        </div><input type="submit" value="Обновить" name="do"/>  <input type="button" onClick="window.close();" class="button" value="Закрыть"/>
    </form>
</div><!-- end #dashboard -->
<script type="text/javascript">
    //multiFile
    $('.MultiFile').MultiFile({
        accept: 'jpg|gif',
        max: 150,
        STRING: {
            remove: '<img style="border: 0px;" src="<?php echo base_url();?>img/bin.gif" height="16" width="16" alt="x"/>',
            file: '$file | URL баннера: <input type="text" name="ftxt[]"/>',
            selected: ' Выбраны: $file ',
            denied: 'Неверный тип файла: $ext!',
            duplicate: 'Этот файл уже выбран:\n$file!'
        }
    });
</script>
