<div id="dashboard">
    <h2 class="ico_mug">Редактировать скидку</h2>
    <div class="clearfix">
    	
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
            	<form action="<?php echo base_url();?>discounts/update/<?php echo $this->uri->segment(3);?>" method="post" enctype="multipart/form-data">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название скидки: 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="dis_name" id="name" value="<?php echo $detail->dis_name;?>"/>
                        </td>
                        <td>
                        	<input type="hidden" value="<?php echo $this->uri->segment(3);?>" id="nextid"/>
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
										if($row->dt_ids == $detail->dis_type)
										{
											echo '<option selected="selected" value="'.$row->dt_ids.'">'.$row->dt_name.'</option>';
										}
										else
										{
											echo '<option value="'.$row->dt_ids.'">'.$row->dt_name.'</option>';
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
                                Категория скидки
                            </label>
                        </td>
                        <td>
                        	
                        <select name="pcategory" id="category"/>
						
						<?php
						
							foreach($pcategory as $row)
							{
								if($row->dc_cat_id == $pcat->dc_parent_id)
								{
									echo '<option  selected="selected"  value="'.$row->dc_cat_id.'">'.$row->dc_cat_name.'</option>';
								}
								else
								{
									echo '<option value="'.$row->dc_cat_id.'">'.$row->dc_cat_name.'</option>';
								}
								
							}
						
						?>
                        </select>
						
                        &raquo;
						<select name="scategory" id="subcategory"/>
							<?php
								foreach($scategory as $row)
								{
									if($row->dc_cat_id == $detail->dis_cat_id)
									{
										echo '<option  selected="selected" value="'.$row->dc_cat_id.'">'.$row->dc_cat_name.'</option>';
									}
									else
									{
										echo '<option value="'.$row->dc_cat_id.'">'.$row->dc_cat_name.'</option>';
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
								if($row->categ_ids == $ocat[0]->obj_categ)
								{
									echo '<option selected="selected" value="'.$row->categ_ids.'">'.$row->categ_nam.'</option>';
								}
								else
								{
									echo '<option value="'.$row->categ_ids.'">'.$row->categ_nam.'</option>';
								}
								
								
							}
						
						?>
                       
                    </select>
                    &raquo;
					<?php 
					
					if(isset($objects))
					{
						$mode = '';
						$advfield ='<tr id="organization"></tr>';
						
					}
					else
					{
						$mode = 'disabled="disabled"';
						$advfield = '
						<tr id="organization">
							<td>Организация</td>
							<td colspan="2">
								<input type="text" name="dis_org" value="'.stripslashes(htmlspecialchars($detail->dis_org)).'"/> 	
									если не существует объекта
							<br/>
							<input type="text" name="dis_email" id="dis_e-mail" value="'.$detail->dis_email.'"/> e-mail организации 
							<br/>
							<input type="text" name="dis_site" id="dis_site" value="'.$detail->dis_site.'"> сайт организации
							</td>
						</tr>';
					}
					
					
					?>
					
					<select name="object" id="object" <?php echo $mode;?>/>
						<?php
							foreach($objects as $row)
							{
								if($row->obj_ids == $detail->dis_obj_id)
								{
									echo '<option selected="selected" value="'.$row->obj_ids.'">'.stripslashes($row->obj_nam).'</option>';
								}
								else
								{
									echo '<option value="'.$row->obj_ids.'">'.stripslashes($row->obj_nam).'</option>';
								}
							}
							
						
						?>
                 
                    </select>
                </td>
                <td>
                </td>
                </tr>
				<?php
				echo $advfield;
				
				?>
				

				
            </table>
        </div>
        <div id="tabs-2">
            <table width="570" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" width="146">
                    	<?php 
                    		if($detail->dis_img)
                    		{
                    			echo '<img src="'.base_site_url().'_files/discount/_logo/'.$this->uri->segment(3).'/'.$detail->dis_img.'"/>';
                    		}
                    		else
                    		{
                    			echo '<img src="'.base_url().'img/no_logo_100x100.png"/>';
                    		}
                    	?>
                    	<br/>
						Логотип (100х100)
                    </td>
                    <td width="224">
                    	
                        <input type="file" name="LOGO"/>
                    </td>
                    <td  width="200">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="center">
                    	<?php 
                    		if($detail->dis_imgmini)
                    		{
                    			echo '<img src="'.base_site_url().'_files/discount/_logo/'.$this->uri->segment(3).'/'.$detail->dis_imgmini.'"/>';
                    		}
                    		else
                    		{
                    			echo '<img src="'.base_url().'img/no_logo_80x30.png"/>';
                    		}
                    	?><br/>
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
                        от <input type="text" value="<?php echo ($detail->dis_begin !=0) ? ymd_decode($detail->dis_begin):''; ?>" name="dis_begin" id="datepicker"/> до <input name="dis_end" value="<?php echo ($detail->dis_end !=0)? ymd_decode($detail->dis_end):''; ?>" type="text" id="datepicker2"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Бессрочно
                    </td>
                    <td>
                        <div style=" padding:10px;background-color:#FF9; border:#F90 1px solid; width:40px; text-align:center">
                            
							<?php 
							if($detail->dis_begin ==0 AND $detail->dis_end==0)
							{
								echo '<input type="checkbox" name="nointerval" checked="checked"/>';
							}
							else
							{
								echo '<input type="checkbox" name="nointerval"/>';
							}
							
							?>
							
                        </div>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                    	На что распространяется скидка
                        <textarea name="dis_text" style="width:90%">
                        	<?php 
								echo stripslashes($detail->dis_text);
							?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td colspan="3">
                    	Дополнительная информация
                        <textarea name="dis_advtext" style="width:90%">
                        	<?php 
								echo stripslashes($detail->dis_advtext);
							?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                        <td>
                            Галерея товаров
                        </td>
                        <td>
                           <input type="checkbox" name="dis_gallery" <?php echo ($detail->dis_gallery_id !='0') ? 'checked="checked" ': '';?> />
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="dis_gallery" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>
                <tr>
                    <td>
                        Размер скидки
                    </td>
                    <td>
                        <input type="text" name="dis_amount" value="<?php echo $detail->dis_amount;?>" id="percent"/>
                    </td>
                    <td>
                    	
                       <select name="dis_item_type">
                       	<option value="">измеритель</option>
                       	<?php
							if($detail->dis_dim == 'percent')
							{
								echo '	<option selected="selected" value="percent">проценты</option>
										<option value="money">рубли</option>';
							}
							else
							{
									echo '	<option value="percent">проценты</option>
										<option selected="selected"  value="money">рубли</option>';
							}
						?>
                       	
						
						
                       </select>
                    </td>
                </tr>
				
				<tr>
					<td>Первоисточник скидки</td>
					<td colspan="2"><input type="text" value="" name="dis_source"/></td>
					
				</tr>
            </table>
        </div>
        <div id="tabs-3">
            <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="470"  valign="top" colspan="2">
                    	<ul id="adrphone">
                    		<?php
							
							$adr = explode("|",$detail->dis_adress);
							$phones = explode("|", $detail->dis_telephone);
								$iteration = count($adr);
								
								for($i=0;$i<$iteration;$i++)
								{
									echo '<li>Адрес<input type="text" value="'.$adr[$i].'" id="adressphone" name="adres['.$i.']"/> Телефон <input value="'.$phones[$i].'" type="text" id="adressphone" name="phone['.$i.']"/></li>';
								}
								
							?>
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
					<td>
						<input type="radio" name="show" value="0"/>не показывать 
					 	<input type="radio" name="show" value="1" checked="checked"/>показывать  </td>
                    <td>
                       
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