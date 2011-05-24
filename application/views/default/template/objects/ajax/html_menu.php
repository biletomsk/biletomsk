<style type="text/css">
	
	#block {width:680px; padding:10px auto; margin-top:10px;}
	
</style>


    <script type="text/javascript">

tinyMCE.init({

mode : "textareas",

theme : "advanced",
plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",

// Theme options

theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontsizeselect,bullist,numlist,|,link,unlink,anchor,image,cleanup",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
language:"ru"

});

</script>

<textarea name="html_content" id="html_content" style="width:100%; height:500px;">
	<?php echo mb_convert_encoding($menu,'UTF8','CP1251');?>
</textarea>

<input type="submit" value="Обновить" name="do"/>

