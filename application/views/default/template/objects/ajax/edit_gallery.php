<form name="edit_gal_item" method="post" enctype="multipart/form-data"/>
<br/>
<div style="margin:auto">
<img src="<?php echo base_site_url().'_gallery/'.$image->gal_for.'/'.$image->gal_img;?>" alt=""/>
</div>
<br/>
Альтернативный текст:<br/>
<input type="text" size="50" value="<?php echo stripslashes($image->gal_alt);?>" /><br/>
Описание фотографии:<br/>
<input type="text" size="50" value="<?php echo stripslashes($image->gal_txt);?>" /><br/>
Позиция:<br/>
<select name="position">
<option value="1">Выбрать</option>
</select>

<br/>
<label for="status">Действия</label>

<input type="radio" name="del_image" value="1"/>Удалить
<br/>

Заменить на другую: <input type="file" name="IMAGES"/>


<input type="hidden" value="<?php echo $image->gal_ids; ?>"/>


</form>