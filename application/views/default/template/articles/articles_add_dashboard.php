<div id="dashboard">
    <h2 class="ico_mug">Добавить статью</h2>
    <div class="clearfix">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Основное</a>
                </li>
            </ul>
				<form action="<?php echo base_url();?>articles/update"  method="post" enctype="multipart/form-data" >
                <div id="tabs-1">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название статьи: 
                            </label>
                        </td>
                        <td>
                        	<?php echo form_error('art_name'); ?>
                            <input type="text" name="art_name" id="name"/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="type">
                                Тематика статьи: 
                            </label>
                        </td>
                        <td>
                        	<?php echo form_error('new_type'); ?>
                            <select name="art_type" id="type">
                                <?php 
                                foreach ($category as $row) {
                                    echo '<option value="'.$row->ac_type.'" '.set_select('art_type',$row->ac_type ).'>'.$row->ac_name.'</option> ';
                                    
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
                                Когда
                            </label>
                        </td>
                        <td>
                        	<?php echo form_error('art_date'); ?>
                            <input type="text" name="art_date" id="datepicker" value="<?php echo date("d.m.Y");?>"/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo base_url();?>img/ni.png" />
                            <label for="category">
                                Изображение 1:1 
                            </label>
                        </td>
                        <td>
                            <input type="file" name="ART_LOGO"/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                        	<?php echo form_error('art_fulltext'); ?>
                            <p>
                                Полное описание
                            </p>
                            <textarea name="art_fulltext" style="width:100%; height: 350px;">
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Источник
                        </td>
                        <td>
                            <input type="text" name="art_source"/>
                        </td>
                        <td>
                        </td>
                    </tr>
				<tr>
                <td>
                    Статус статьи
                </td>
                <td colspan="2">
                	
					<input type="radio" name="art_status" value="1"/>не отображается 
					<input type="radio" name="art_status" value="2" checked="checked"/>отображается
					
                                  
                </td>
                </tr>
					
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="submit" value="Добавить" name="do"/>
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