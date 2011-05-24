<div id="dashboard">
    <h2 class="ico_mug">Добавить вид спорта</h2>
    <div class="clearfix">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Кратко</a>
                </li>
                <li>
                    <a href="#tabs-2">Описание</a>
                </li>
                <li>
                    <a href="#tabs-3">SEO</a>
                </li>
                <li>
                    <a href="#tabs-4">Подменю</a>
                </li>

            </ul>
            <div id="tabs-1">
                <form action="<?php echo base_url();?>sport/update" enctype="multipart/form-data" method="post">
                <table width="570" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название вида спорта: 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="sp_name" id="name" value=""/>
                        </td>
                        <td>
                            <input type="hidden" id="sportid" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name">
                                Название вида спорта (транслитерация): 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="sp_transl" id="name" value=""/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td width="146">
                            <img src="" />Логотип (100х100)
                        </td>
                        <td width="235">
                            <input type="file" name="LOGO"/>
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
                                Описание вида спорта
                            </p>
                            <textarea name="sp_txt" style="width:100%; height:500px;">
                               
                            </textarea>
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
                            <input name="par_tile" type="text" id="percent" size="50" value=""/>
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
                            <textarea cols="50" rows="3" name="par_keywords">
                                
                            </textarea>
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
                            <textarea cols="50" rows="3" name="par_description">
                              
                                	
                            </textarea>
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
                        <td>
                            Общие правила
                        </td>
                        <td>
                            <input type="checkbox" name="sp_1"/>
                        </td>
                        <td>

                        </td>
                    </tr>
					<!--
                    <tr>
                        <td>
                            Новости
                        </td>
                        <td>
                            <input type="checkbox" <?php echo($detail->sp_2 == '1') ? 'checked="checked" value="1"' : ' '; ?> name="obj_2"/>
                        </td>
                        <td>
                            <p>
                                <a href="#" id="dialog_link" title="gallery" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>редактировать</a>
                            </p>
                        </td>
                    </tr>-->
     
                    <tr>
                        <td>
                            Отзывы
                        </td>
                        <td>
                            <input type="checkbox"  name="sp_5"/>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name">
                                Данные счетчика: 
                            </label>
                        </td>
                        <td>
                           Всего <input type="text" name="cou_v" id="name" value=""/>
                        </td>
                        <td>
                           В день <input type="text" name="cou_vd" id="name" value=""/>
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
                                    | <input class="button" type="submit" value="Добавить" name="do"/>
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