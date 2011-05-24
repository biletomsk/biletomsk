<div id="dashboard">
    <h2 class="ico_mug">Добавить фотоотчет</h2>
    <div class="clearfix">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Описание</a>
                </li>
                <li>
                    <a href="#tabs-2">Фотографии</a>
                </li>
            </ul>
            <div id="tabs-1">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <form action="<?php echo base_url();?>photoarchive/update" method="post" enctype="multipart/form-data">
                    <tr>
                        <td width="160">
                            <label for="name">
                                Название фотоотчета: 
                            </label>
                        </td>
                        <td width="390">
                            <input type="text" name="arch_name" id="name"/>
                        </td>
                        <td width="20">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="type">
                                Дата фотоотчета: 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="arch_date" id="datepicker"/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="category">
                                Категория 
                            </label>
                        </td>
                        <td>
                        <select name="arch_categ" id="category"/><option value="0">Выбери</option>
                        <?php 
                        foreach ($category as $row) {
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
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
                            <select name="objcateg" id="objcategory">
                                <option value="">выбери</option>
                                <?php 
                                foreach ($objcategory as $row) {
                                    echo '<option value="'.$row->categ_ids.'">'.$row->categ_nam.'</option>';
                                }
                                
                                ?>
                            </select>
                            &raquo;
                            <select name="arch_objid" id="object" disabled="disabled">
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p>
                                Описание фотоотчета
                            </p>
                            <textarea name="arch_txt" style="width:100%">
                            </textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-2">
            <table width="570" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="146">
                        Способ загрузки
                    </td>
                    <td width="235">
                        <select name="up_type" id="uploadtype">
                            <option value="" selected="selected">выберите способ</option>
                            <option value="1">По одной</option>
                            <option value="2">Оптом</option>
                        </select>
                    </td>
                    <td width="219">
                        &nbsp;
                    </td>
                </tr>
                <tr id="uploadform">
                </tr>
      
                <tr>
                    <td colspan="2">
                        Номер индекса: <input type="text" name="arch_index" value="1" size="2"/>
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