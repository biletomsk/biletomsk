<div id="dashboard">
    <h2 class="ico_mug">Редактирование соревнования  <?php echo stripslashes($detail->sps_name); ?></h2>
    <div class="clearfix">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Основное</a>
                </li>
                <li>
                    <a href="#tabs-2">Описание</a>
                </li>
                <li>
                    <a href="#tabs-3">Разное</a>
                </li>

            </ul>
            <div id="tabs-1">
                <form action="<?php echo base_url();?>sport/update_competition/<?php echo $detail->sps_ids;?>" enctype="multipart/form-data" method="post">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название соревнования: 
                            </label>
                        </td>
                        <td colspan="2">
                            <input size="60" type="text" name="sps_name" id="name" value="<?php echo stripslashes(htmlspecialchars($detail->sps_name));?>"/>
                       
                           
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name">
                                Категория спорта спорта: 
                            </label>
                        </td>
                        <td>
                        	<select name="competit_type" id="type">
                            <?php
							
							foreach($category as $row)
							{
                                    if ($row->sp_ids == $detail->sps_for) {
                                        echo '<option selected="selected" value="'.$row->sp_ids.'">'.$row->sp_name.'</option> ';
                                    } else {
                                        echo '<option value="'.$row->sp_ids.'">'.$row->sp_name.'</option> ';
                                    }
							}
							
							?>
							</select>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td width="146">
                              <label for="name">
                                Дата соревнования: 
                            </label> </td>
                        <td width="235">
                       <input type="text" name="competit_date" id="datepicker" value="<?php echo substr($detail->sps_date,6,2); ?>.<?php echo substr($detail->sps_date,4,2); ?>.<?php echo substr($detail->sps_date,0,4); ?>"/>
                       
                        </td>
                        <td width="219">
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-2">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3">
                            <p>
                                Описание соревнования
                            </p>
                            <textarea name="sps_txt" style="width:100%; height:500px;">
                                <?php echo $detail->sps_txt; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-3">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        
                        <td colspan="3">
                        	<p>
                      <input type="checkbox" <?php echo ($detail->sps_1 == 1)? ' checked="checked" ': ''; ?> name="reglament"/>Регламент
                         </p>
                            <textarea name="sps_reglam" rows="3">
                                <?php echo $detail->sps_reglam; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                                       <td colspan="3">
                         	  <p><input type="checkbox" <?php echo ($detail->sps_3 == 1)? ' checked="checked"': ''; ?> name="raspisanie"/>Расписание</p>
                        
                            <textarea cols="50" rows="3" name="sps_raspisanie">
                                <?php echo $detail->sps_raspisanie; ?>
                            </textarea>
                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p><input type="checkbox" <?php echo ($detail->sps_2 == 1)? ' checked="checked"': ''; ?> name="ratings"/>Рейтинги</p>
                         <?php 
						 if($ratings)
						 {
						 	echo '<p>Существующие:</p>';
						 	foreach($ratings as $item)
							{
								echo '<p id="'.$item->ratxl_ids.'">'.stripslashes($item->ratxl_name).'  <a style="color: blue;" href="'.base_site_url().'sport/download/'.$dir->sp_transl.'/'.$item->ratxl_forid.'/'.$item->ratxl_xls.'">скачать</a> <a style="color:red;" id="'.$item->ratxl_ids.'" title="delete" href="#">удалить</a></p>';
							}
						 }
						 else
						 {
						 	echo '<p style="text-align:center;">Рейтинги отсутствуют</p>';
						 }
						 
						 
						 ?>
						 </td>
					</tr>	 
						 
					<tr>
						<td>Добавить файл (rar архив)</td>
						<td>
							<input type="text" name="ratxl_name" value="Название"/>
							
						</td>
						<td>
              				<input type="file" name="sps_ratings"/>
                       
                            </td>
					</tr>
					<tr>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                <div class="sub_dash">
                                    <a href="">назад</a>
                                    | <input class="button" type="submit" value="Обновить" name="do"/>
                                </div>
                            </td>
                        </tr>
                </table>
            </div>


            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
tinyMCE.init({

	// General options
	mode: "textareas",
	theme: "advanced",
	language:"ru",
	plugins: "safari,spellchecker,pagebreak,style,layer,advhr,advimage,advlink,preview,media,print,contextmenu,paste,directionality,visualchars,nonbreaking,xhtmlxtras",
	// Theme options
	theme_advanced_buttons1: "bold,italic,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,fontsizeselect,|,bullist,numlist,link,unlink,anchor,image,cleanup,code,",
	theme_advanced_buttons2: "",
	theme_advanced_buttons3: "",
	theme_advanced_buttons4: "",
	theme_advanced_toolbar_location: "top",
	theme_advanced_toolbar_align: "left",
	theme_advanced_statusbar_location: "bottom",
	theme_advanced_resizing: true,
	// Example content CSS (should be your site CSS)
	content_css: "css/example.css",
	// Drop lists for link/image/media/template dialogs
	
	template_external_list_url: "js/template_list.js",
	
	external_link_list_url: "js/link_list.js",
	
	external_image_list_url: "js/image_list.js",
	
	media_external_list_url: "js/media_list.js",

});

</script>