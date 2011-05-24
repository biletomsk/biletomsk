<div id="dashboard">
    <h2 class="ico_mug">Редактировать фотоотчет</h2>
    <div class="clearfix">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Описание</a>
                </li>
                <li>
                    <a href="#tabs-2">Редактировать Фотографии</a>
                </li>
                <li>
                    <a href="#tabs-3">Добавить Фотографии</a>
                </li>
            </ul>
            <div id="tabs-1">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <form action="<?php echo base_url();?>photoarchive/update/<?php echo $this->uri->segment(3);?>" method="post" enctype="multipart/form-data">
                    <tr>
                        <td width="160">
                            <label for="name">
                                Название фотоотчета: 
                            </label>
                        </td>
                        <td width="390">
                            <input type="text" name="arch_name" id="name" value="<?php echo htmlspecialchars(stripslashes($detail->arch_name));?>"/>
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
                            <input type="text" name="arch_date" id="datepicker" value="<?php echo $detail->arch_d.'.'.$detail->arch_m.'.'.$detail->arch_y; ?>"/>
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
                            if ($row->id == $detail->arch_categ) {
                                echo '<option selected="selected" value="'.$row->id.'">'.$row->name.'</option>';
                            } else {
                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
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
                            foreach ($objcategory as $row) {
                                if ($row->categ_ids == $ocat[0]->obj_categ) {
                                    echo '<option selected="selected" value="'.$row->categ_ids.'">'.$row->categ_nam.'</option>';
                                } else {
                                    echo '<option value="'.$row->categ_ids.'">'.$row->categ_nam.'</option>';
                                }
                            
                                
                            }
                            
                            ?>
                        </select>
                        &raquo;
                        <?php 
						
                        if (@$objects) {
                            $mode = '';
                            
                        } else {
                            $mode = 'disabled="disabled"';
                            
                        }
                        ?>
                        <select name="arch_objid" id="object"<?php echo $mode; ?>/>
                        <?php 
                        foreach ($objects as $row) {
                            if ($row->obj_ids == $detail->arch_objid) {
                                echo '<option selected="selected" value="'.$row->obj_ids.'">'.stripslashes($row->obj_nam).'</option>';
                            } else {
                                echo '<option value="'.$row->obj_ids.'">'.stripslashes($row->obj_nam).'</option>';
                            }
                        }
                        
                        
                        ?>
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
                        <textarea id="textile" name="arch_txt" style="width:100%">
                            <?php 
                            echo stripslashes($detail->arch_txt);
                            
                            ?>
                        </textarea>
                    </td>
                </tr>
                </table>
            </div>
            <div id="tabs-2">
                <table width="600" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                        <?php 
                        $allcol = 4;
                        $first = 1;
                        
                        foreach ($images as $row) {
                            echo '
                        				<td  style="background:#606060;border: 1px black solid; padding: 3px;" >
                        				<div id="wrap" align="center">
                        					<img style="padding:3px; background:#FFF;" width="120" id="'.$row->id.'" src="'.base_site_url().'photoarchive/'.$row->p_id.'/'.$row->img.'"/>
                        				</div>
                        
                        				<div align="center" style="margin-top:2px; color:#fff;font-family:verdana; font-size:12px;">
                        				'.stripslashes($row->text).'
                        				</div>
                        
                        				<div id="menu">
                        
                        				<input type="checkbox" name="TODEL[]" value="'.$row->id.'"> удалить |
                        				';
                            if ($row->img == $detail->arch_title_img) {
                                echo '<input type="radio" checked="checked" name="TOIND" value="'.$row->img.'"/> индекс';
                            } else {
                                echo '<input type="radio" name="TOIND" value="'.$row->img.'"/> индекс';
                            }
                            
                            echo '</div></td>';
                        
                            
                            if (is_integer($first / $allcol)) {
                                echo '</tr><tr>';
                            }
                            $first++;
                        }
                        
                        
                        
                        
                        ?>
                    </tr>
                </table>
            </div>
            <div id="tabs-3">
            <table width="570" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="146">
                        Способ загрузки
                    </td>
                    <td colspan="2" width="424">
                        <select name="up_type" id="uploadtype">
                            <option value="" selected="selected">не загружать</option>
                            <option value="1">По одной</option>
                            <option value="2">Оптом</option>
                        </select>
                    </td>
                </tr>
                <tr id="uploadform">
                </tr>
                <tr>
                    <td colspan="2">
                       
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