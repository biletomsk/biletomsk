<div id="dashboard">
    <h2 class="ico_mug">Добавить новость</h2>
    <div class="clearfix">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Кратко</a>
                </li>
                <li>
                    <a href="#tabs-2">Основное</a>
                </li>
            </ul>
			<form action="<?php echo base_url();?>news/save"  method="post" enctype="multipart/form-data" >
            <div id="tabs-1">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название новости: 
                            </label>
                        </td>
                        <td>
                        	<?php echo form_error('new_name'); ?>
                            <input type="text" name="new_name" value="<?php echo set_value('new_name'); ?>" id="name"/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="type">
                                Тематика новости: 
                            </label>
                        </td>
                        <td>
                        	<?php echo form_error('new_type'); ?>
                            <select name="new_type" id="new_type">
                                <?php 
                                foreach ($category as $row) {
                                    echo '<option value="'.$row->newc_ids.'" '.set_select('new_type',$row->newc_ids ).'>'.$row->newc_name.'</option> ';
                                    
                                }
                                
                                ?>
                            </select>
                        </td>
                        <td>
                        	<select name="new_sportid" id="selectsport" disabled="disabled">
                        		
                        	</select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="category">
                                Когда
                            </label>
                        </td>
                        <td>
                        	<?php echo form_error('new_date'); ?>
                            <input type="text" name="new_date" id="datepicker" value="<?php echo date("d.m.Y");?>"/>
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
                            <select name="where" id="setCategory">
                            	<option value="">выбери категорию</option>
                                <?php 
                                foreach ($objcategory as $row) {
                                    echo '<option value='.$row->categ_ids.'>'.stripslashes($row->categ_nam).'</option>';
                                }
                                
                                
                                ?>
                            </select>
                        </td>
                        <td>
                            <select disabled="disabled"  name="new_object" id="setObject">
                                <option value="0">Выбери категорию</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-2">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="146">
                            <img src="<?php echo base_url();?>img/ni.png" />
                            <br/>
                            100х100 пикселей
                        </td>
                        <td width="235">
                            <input type="file" name="NEWS_LOGO"/>
                        </td>
                        <td width="219">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p>
                                Превью новости
                            </p>
							<?php echo form_error('new_preview'); ?>
                            <textarea name="new_preview" style="width:100%">
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p>
                                Полное описание
                            </p>
							<?php echo form_error('new_fulltext'); ?>
                            <textarea name="new_fulltext" style="width:100%; height: 350px;">
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Статус новости
                        </td>
                        <td colspan="2">
                            <input type="radio" name="new_status" value="1"/>не показывать <input type="radio" name="new_status" value="2" checked="checked"/>показывать 
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
            </div>
        </div>
		</form>
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