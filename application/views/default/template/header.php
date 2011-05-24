<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->benchmark->mark('code_start'); ?>
<title>Панель управления.</title>
	<meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow" />
	
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/style.css" />
	<link rel="Stylesheet" type="text/css" href="<?php echo base_url();?>css/smoothness/jquery-ui-1.7.1.custom.css"  />	
	<!--[if IE 7]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen, projection" /><![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/superfish.css" media="screen">
	<link href="<?php echo base_url();?>css/default.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>css/uploadify.css" rel="stylesheet" type="text/css" />
	<!--[if IE]>
		<style type="text/css">
		  .clearfix {
		    zoom: 1;     /* triggers hasLayout */
		    display: block;     /* resets display for IE/Win */
		    }  /* Only IE can see inside the conditional comment
		    and read this CSS rule. Don't ever use a normal HTML
		    comment inside the CC or it will close prematurely. */
		</style>
	<![endif]-->
	<!-- JavaScript -->
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/template/<?php echo @$jslibrary ?>.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.selectfiller.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/i18n/jquery-ui-i18n.js" ></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/hoverIntent.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/superfish.js"></script>
	<script type="text/javascript">
		// initialise plugins
		$(function(){
			$('ul.sf-menu').superfish();
		});


	</script>
	<!--<script type="text/javascript" src="<?php echo base_url();?>js/excanvas.pack.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.flot.pack.js"></script>

  	<script type="text/javascript" src="<?php echo base_url();?>js/custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/tiny_mce/tiny_mce.js"></script>



		<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>

		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>


	 <!--[if IE]><script language="javascript" type="text/javascript" src="excanvas.pack.js"></script><![endif]-->
</head>
<body>
<div class="container" id="container">
<div  id="header">
	<div id="profile_info">
			<img src="<?php echo base_url();?>img/avatar.jpg" id="avatar" alt="avatar" />
			<p>Добро пожаловать <strong>администратор</strong>. <a href="<?php echo base_url();?>index/logout">выйти?</a></p>
			<p class="last_login">Последний вход: 21:03 12.05.2009</p>
		</div>
		<div id="logo"><h1><a href="/">Панель управления</a></h1></div>
		
</div><!-- end header -->