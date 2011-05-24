<div id="dashboard">
    <h2 class="ico_mug">Добавить скидку</h2>
    <div class="clearfix">
    	<?php echo validation_errors();?>
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Кратко</a>
                </li>
                <li>
                    <a href="#tabs-2">Основное</a>
                </li>
                <li>
                    <a href="#tabs-3">Дополнительно</a>
                </li>
            </ul>
            <div id="tabs-1">
            	<form action="<?php echo base_url();?>discounts/update" method="post" enctype="multipart/form-data">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название скидки: 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="dis_name" id="name"/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="type">
                                Тип скидки: 
                            </label>
                        </td>
                        <td>
                            <select name="dis_type" id="dis_type">
                            	<option value="">выбери</option>
            					<?php
									foreach($type as $row)
									{
										echo '<option value="'.$row->dt_ids.'">'.$row->dt_name.'</option>';
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
                                Категория скидки
                            </label>
                        </td>
                        <td>
                        <select name="pcategory" id="category"/>
						
						<option value="">Выбери</option>
						<?php
							foreach($pcategory as $row)
							{
								echo '<option value="'.$row->dc_cat_id.'">'.$row->dc_cat_name.'</option>';
							}
						
						?>
                        </select>
						
                        &raquo;
						<select name="scategory" id="subcategory" disabled="disabled"/>

						
                    </select>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">
                            Привязка к объекту
                        </label>
                    </td>
                    <td>
                    <select name="objcategory" id="objcategory">
                        <option value="">Выбери</option>
						<?php 
							foreach($objcategory as $row)
							{
								echo '<option value="'.$row->categ_ids.'">'.$row->categ_nam.'</option>';
							}
						
						?>
                       
                    </select>
                    &raquo;
					<select name="object" id="object" disabled="disabled"/>
					
                 
                    </select>
                </td>
                <td>
                </td>
                </tr>
				
				<tr id="organization">
					<td>Организация</td>
					<td colspan="2">
					<input type="text" name="dis_org"/> 	
						если не существует объекта
						<br/>
					<input type="text" name="dis_email" value="" id="dis_e-mail"/> e-mail организации 
					<br/>
					<input type="text" name="dis_site" value="" id="dis_site"> сайт организации
					</td>
					
					
				</tr>

				
            </table>
        </div>
        <div id="tabs-2">
            <table width="580" border="0" cellspacing="0" cellpadding="0"  id="mytable">
                <tr id="big_logo">
                    <td width="146">
                        Логотип (100х100)
                    </td>
                    <td width="235">
                        <input type="file" name="LOGO"/>
                    </td>
                    <td width="219">
                        &nbsp;
                    </td>
                </tr>
                <tr id="mini_logo">
                    <td>
                        Логотип (80х30)
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
                        Продолжительность
                    </td>
                    <td colspan="2">
                        от <input type="text" name="dis_begin" id="datepicker"/> до <input name="dis_end" type="text" id="datepicker2"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Бессрочно
                    </td>
                    <td>
                        <div style=" padding:10px;background-color:#FF9; border:#F90 1px solid; width:40px; text-align:center">
                            <input type="checkbox" name="nointerval"/>
                        </div>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                    	На что распространяется скидка
                        <textarea name="dis_text" style="width:100%">
                        </textarea>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td colspan="3">
                    	Дополнительная информация
                        <textarea name="dis_advtext" style="width:100%">
                        </textarea>
                    </td>
                </tr>
				<!--<tr>
                        <td>
                            Галерея товаров
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="dis_gallery" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>добавить</a>
                            </p>
                        </td>
                    </tr>-->
                <tr>
                    <td>
                        Размер скидки
                    </td>
                    <td>
                        <input type="text" name="dis_amount" id="percent"/>
                    </td>
                    <td>
                    	
                       <select name="dis_item_type">
                       	<option value="">измеритель</option>
						<option value="percent">проценты</option>
						<option value="money">рубли</option>
						
                       </select>
                    </td>
                </tr>
				
				<tr>
					<td>Первоисточник скидки</td>
					<td colspan="2"><input type="text" name="dis_source"/></td>
					
				</tr>
            </table>
        </div>
        <div id="tabs-3">
            <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="470"  valign="top" colspan="2">
                    	<ul id="adrphone">
							<li>Адрес<input type="text" id="adressphone" name="adres[]"/> Телефон <input type="text" id="adressphone" name="phone[]"/></li>
							<li>Адрес<input type="text" id="adressphone" name="adres[]"/> Телефон <input type="text" id="adressphone" name="phone[]"/></li>
							<li>Адрес<input type="text" id="adressphone" name="adres[]"/> Телефон <input type="text" id="adressphone" name="phone[]"/></li>
							<li>Адрес<input type="text" id="adressphone" name="adres[]"/> Телефон <input type="text" id="adressphone" name="phone[]"/></li>
							<li>Адрес<input type="text" id="adressphone" name="adres[]"/> Телефон <input type="text" id="adressphone" name="phone[]"/></li>
						
						
						</ul>
                    </td>
                    <td width="130"  valign="top">
                        <a href="#" title="Добавить" id="addinput" onclick="addItem()"><img src="<?php echo base_url();?>img/add.png" alt="add" /></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Статус скидки
                    </td>
                    <td colspan="2">
                        <input type="radio" name="show" value="0"/>не показывать <input type="radio" name="show" value="1" checked="checked"/>показывать 
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
</div><!-- end #dashboard -->
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