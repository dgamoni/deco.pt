<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="initial-scale=1.0, width=device-width"/>
	<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<![endif]-->
	<title>DECO</title>
	<meta name="keywords" content="keyword1, keyword2"/>
	<meta name="description" content="description"/>
	<script src="scripts/jquery.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
<script type="text/javascript">
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
document.createElement('hgroup');
document.createElement('figure');
</script>
<![endif]-->
	<!-- ***** tail ***** -->
	<!-- tail-code -->
	<!-- ***** /tail **** -->
</head>
<body class="site">	
	<div class="vc_custom_heading_wrap ">
	<div class="heading-text el-text">
		<h1><b>O SEU MUNICÍPIO É VERDE?</b></h1>
		<hr class="separator-break separator-accent">
	</div>
	<div class="clear"></div>
</div>
<div class="uncode_text_column" style="margin-bottom: 100px;">
	<div class="" style="margin: 36px 0 34px;">Avalie a sua atuação</div>
	<!-- MAP CONTAINER -->
	<?php require("item-map.php"); ?>
	<!-- /MAP CONTAINER -->
</div>
	
<div class="vc_custom_heading_wrap">
	<div class="heading-text el-text">
		<h1><b>O MUNICÍPIO MUDA CONSIGO.</b></h1>
		<hr class="separator-break separator-accent">
	</div>
	<div class="clear"></div>
</div>
<div class="uncode_text_column" style="margin-bottom: 26px;">
	<div class="" style="margin: 36px 0 34px;">Participe nesta campanha e faça parte da mudança!</div>
	<!-- FORM CONTAINER -->
	<?php require("item-contacts.php"); ?>								
	<!-- /FORM CONTAINER -->
</div>
	
<script src="scripts/selectize.min.js" type="text/javascript" charset="utf-8"></script>

<?php $compressedFiles = 1;
if(!$compressedFiles){ ?>
	<script src="scripts/main.js" type="text/javascript" charset="utf-8"></script>
<?php } else { ?>
	<script src="scripts/lp_ac_js.js" type="text/javascript" charset="utf-8"></script>
<?php } ?>
</body>
</html>