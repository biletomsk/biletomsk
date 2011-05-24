<div id="dashboard">
    <h2 class="ico_mug">Добавить объект</h2>
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
            	<form action="<?php echo base_url();?>object/update/<?php echo $nextid[0]->obj_ids+1;?>" method="post" enctype="multipart/form-data">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название объекта: 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="obj_nam" id="name"/>
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
                                    echo '<option value='.$row->categ_ids.'>'.stripslashes($row->categ_nam).'</option>';
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
                            <input type="text" name="obj_transl" value="" id="name"/>.biletomsk.ru
                        </td>
                        <td>
                        	<input type="hidden" name="nextid" id="nextid" value="<?php echo $nextid[0]->obj_ids+1;?>"/>
                        </td>
                    </tr>
                    
                </table>
            </div>
            <div id="tabs-2">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="146">
                            <img src="img/sbarro.jpg" />Логотип (100х100)
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
                            <img src="img/1026.gif" />Логотип (80х30)
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
                        <td>
                            Meta TITLE
                        </td>
                        <td>
                            <input name="par_tile"  type="text" id="percent"/>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Meta KEYWORD
                        </td>
                        <td>
                            <input name="par_keywords" type="text" id="percent"/>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mets DESCRIPTION
                        </td>
                        <td>
                            <input  name="par_description" type="text" id="percent"/>
                        </td>
                        <td>
                            &nbsp;
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
                            <textarea name="obj_alltxt"  name="content" style="width:100%">
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Телефоны
                        </td>
                        <td>
                            <input name="obj_phone"  type="text" id="percent"/>
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
                            <input name="obj_addr"  type="text" id="percent"/>
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
                            <input name="obj_email"  type="text" id="percent"/>
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
                            <input name="obj_www"   type="text" id="percent"/>
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
                            <input type="checkbox" value="1"  name="obj_1"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="menu" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Фотогалерея
                        </td>
                        <td>
                            <input type="checkbox" value="1"  name="obj_2"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="gallery" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Отзывы
                        </td>
                        <td>
                            <input type="checkbox" value="1"  name="obj_3"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="feedback" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>
                    <!--<tr>
                        <td>
                            Новости заведения
                        </td>
                        <td>
                            <input type="checkbox" value="1"  name="obj_4"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="news" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>-->
                    <tr>
                        <td>
                            Схема зала
                        </td>
                        <td>
                            <input type="checkbox" value="1"  name="obj_5"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="sheme_of_hall" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Схема проезда
                        </td>
                        <td>
                            <input type="checkbox" value="1"  name="obj_8"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="scheme_of_map" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Услуги и цены
                        </td>
                        <td>
                            <input type="checkbox" value="1"  name="obj_6"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="price" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>
					<!--
                    <tr>
                        <td>
                            Расписание мероприятий
                        </td>
                        <td>
                            <input type="checkbox" value="1"  name="obj_7"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="afisha" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>-->
                </table>
                <!-- ui-dialog -->


            </div>
            <div id="tabs-6">
                <p>
                    Информативная таблица объекта
                </p>
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="450" valign="top" id="adrphone">
                        	<ul id="adrphone">
							<?php 
							
							for($i=1;$i<9;$i++)
							{
								echo '<li>Поле <input type="text" name="FIELD['.$i.'][objt_nam]"/>Описание<input name="FIELD['.$i.'][objt_txt]" type="text"/></li>';
								
							}

							?>
                           </ul>
                        </td>
                        <td width="120" valign="top">
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
                            <input type="text" name="cou_vd" id="name" value="за день"/>
                        </td>
                        <td>
                            <input type="text" name="cou_v" id="name" value="за все время"/>
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
                            <input type="submit" value="Добавить" name="do"/>
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