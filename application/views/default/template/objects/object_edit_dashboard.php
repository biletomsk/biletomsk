<div id="dashboard">

    <h2 class="ico_mug">Редактирование объекта <?php echo stripslashes($detail->obj_nam);?></h2>
    <div class="clearfix">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Кратко</a>
                </li>
                <li>
                    <a href="#tabs-2">Логотипы</a>
                </li>
                <li>
                    <a href="#tabs-3">SEO</a>
                </li>
                <li>
                    <a href="#tabs-4">Описание</a>
                </li>
                <li>
                    <a href="#tabs-5">Подменю</a>
                </li>
                <li>
                    <a href="#tabs-6">Разное</a>
                </li>
            </ul>
            <div id="tabs-1">
            	<form action="<?php echo base_url();?>object/update/<?php echo $detail->obj_ids;?>" enctype="multipart/form-data" method="post">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название объекта: 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="obj_nam" id="name" value="<?php echo stripslashes(htmlspecialchars($detail->obj_nam));?>"/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="type">
                                Категория объекта: 
                            </label>
                        </td>
                        <td>
                		<select name="obj_categ" id="setCategory">
                            	<option value="">выбери категорию</option>
                                <?php 
                                foreach ($category as $row) {
                                	if($row->categ_ids == $detail->obj_categ)
									{
										echo '<option selected="selected" value='.$row->categ_ids.'>'.stripslashes($row->categ_nam).'</option>';
									}
									else
									{
										echo '<option value='.$row->categ_ids.'>'.stripslashes($row->categ_nam).'</option>';
									}
                                    
                                }
                                
                                
                                ?>
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="category">
                                Поддомен объекта
                            </label>
                        </td>
                        <td>
                            <input type="text" name="obj_transl" value="<?php echo $detail->obj_transl;?>" id="name"/>.biletomsk.ru
                        </td>
                        <td>
                        	  	<input type="hidden" name="nextid" id="nextid" value="<?php echo $detail->obj_ids;?>"/>
                       
                        </td>
                    </tr>
                    
                </table>
            </div>
            <div id="tabs-2">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="146">
                            <img src="http://www.biletomsk.ru/_object/logo/<?php echo $detail->obj_ids;?>/<?php echo $detail->obj_img;?>" />Логотип (100х100)
                        </td>
                        <td width="235">
                            <input type="file" name="LOGO"/>
                        </td>
                        <td width="219">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="http://www.biletomsk.ru/_object/logo/<?php echo $detail->obj_ids;?>/<?php echo $detail->obj_img_mini;?>" />Логотип (80х30)
                        </td>
                        <td>
                            <input type="file" name="MLOGO"/>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Псевдоним логотипа
                        </td>
                        <td colspan="2">
                            <input type="text" name="obj_img_alt" id="name"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ссылка для нажатия на логотип
                        </td>
                        <td>
                            <input type="text" name="obj_img_url" id="name"/>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-3">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3">
                            Meta TITLE
                       
                            
                            <input name="par_tile" type="text" id="percent" size="50" value="<?php echo @stripslashes($seo[0]->par_tile); ?>"/>
                        </td>
                       
                    </tr>
                    <tr>
                         <td colspan="3">
                            Meta KEYWORD
                        
                        	<textarea cols="40" rows="3" name="par_keywords" style="width:50%">
                        		<?php echo @stripslashes($seo[0]->par_keywords); ?>
							</textarea>
 
                        </td>
                     
                    </tr>
                    <tr>
                        <td colspan="3">
                            Mets DESCRIPTION
                        
                        	<textarea cols="50" rows="3" name="par_description" style="width:50%">
                        		<?php echo @stripslashes($seo[0]->par_description); ?>	
							</textarea>
								
                         
                        </td>
                       
                    </tr>
                </table>
            </div>
            <div id="tabs-4">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3">
                            <p>
                                Описание объекта
                            </p>
                            <textarea name="obj_alltxt" style="width:100%; height:500px;">
                            	<?php echo stripslashes($detail->obj_alltxt); ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Телефоны
                        </td>
                        <td>
                            <input type="text" name="obj_phone" value="<?php echo $detail->obj_phone;?>"  id="percent"/>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Адрес
                        </td>
                        <td>
                            <input type="text" name="obj_addr" value="<?php echo stripslashes($detail->obj_addr);?>" id="percent"/>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Электронный адрес
                        </td>
                        <td>
                            <input type="text" name="obj_email" value="<?php echo $detail->obj_email;?>" id="percent"/>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Веб-сайт
                        </td>
                        <td>
                            <input type="text" name="obj_www"  value="<?php echo $detail->obj_www;?>" id="percent"/>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-5">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            Меню заведения
                        </td>
                        <td>
                            <input type="checkbox" <?php echo ($detail->obj_1 == '1')? 'checked="checked" ' : ' '; ?> name="obj_1"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="menu" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Фотогалерея
                        </td>
                        <td>
                            <input type="checkbox"  <?php echo ($detail->obj_2 == '1')? 'checked="checked" ' : ' '; ?> name="obj_2"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="gallery" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Отзывы
                        </td>
                        <td>
                            <input type="checkbox"  <?php echo ($detail->obj_3 == '1')? 'checked="checked" ' : ' '; ?> name="obj_3"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="feedback" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>
					
					<!--
                    <tr>
                        <td>
                            Новости заведения
                        </td>
                        <td>
                            <input type="checkbox"  <?php echo ($detail->obj_4 == '1')? 'checked="checked" value="1"' : ''; ?> name="obj_4"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="news" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>-->
                    <tr>
                        <td>
                            Схема зала
                        </td>
                        <td>
                            <input type="checkbox"  <?php echo ($detail->obj_5 == '1')? 'checked="checked" ' : ''; ?> name="obj_5"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="sheme_of_hall" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Схема проезда
                        </td>
                        <td>
                            <input type="checkbox"  <?php echo ($detail->obj_8 == '1')? 'checked="checked"  ' : ''; ?> name="obj_8"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="scheme_of_map" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Услуги и цены
                        </td>
                        <td>
                            <input type="checkbox"  <?php echo ($detail->obj_6 == '1')? 'checked="checked"  ' : ' '; ?> name="obj_6"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="price" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>
					<!--
                    <tr>
                        <td>
                            Расписание мероприятий
                        </td>
                        <td>
                            <input type="checkbox"  <?php echo ($detail->obj_7 == '1')? 'checked="checked"  value="1"' : ''; ?> name="obj_7"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="afisha" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>-->
                </table>

            </div>
            <div id="tabs-6">
                <p>
                    Информативная таблица объекта
                </p>
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="480" valign="top">
                        	<ul id="adrphone">
							<?php
							
												
							foreach($info as $row)
							{
						echo '<li>Поле <input type="text" name="FIELD['.$row->objt_ids.'][objt_nam]" id="adressphone" value="'.stripslashes($row->objt_nam).'"/>
						Описание<input type="text" name="FIELD['.$row->objt_ids.'][objt_txt]" id="adressphone" value="'.stripslashes($row->objt_txt).'"/>
                            <a href="#" id="remove_item">[-]</a></li>';
							
							}
							
							?>
                           </ul>
                        </td>
                        <td width="90" valign="top">
                            <a href="#" title="Добавить" id="addinput" onclick="addItem()"><img src="<?php echo base_url();?>img/add.png" alt="add" /></a>
                        </td>
                    </tr>
                </table>
                <p>
                    Показания счетчиков
                </p>
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Данные счетчика: 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="cou_v" id="name" value="<?php echo $stat->cou_v ? $stat->cou_v : '0';  ?>"/>
                        </td>
                        <td>
                            <input type="text" name="cou_vd" id="name" value="<?php echo $stat->cou_vd ? $stat->cou_vd : '0';  ?>"/>
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
                            <input type="submit" value="Обновить" name="do"/>
                        </td>
                    </tr>
                </table>
				</form>
            </div>
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
	theme_advanced_buttons1: "bold,italic,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontsizeselect,|,bullist,numlist,link,unlink,anchor,image,cleanup,code,",
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
	
	media_external_list_url: "js/media_list.js"

});

</script>