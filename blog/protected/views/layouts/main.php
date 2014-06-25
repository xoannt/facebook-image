<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<?php $baseurl = Yii::app()->request->baseUrl;?>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/css/windy.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/css/style1.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	
	<!-- Show image-->
	
	<script type="text/javascript" src="<?php echo $baseurl; ?>/js/jquery-1.8.0.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl; ?>/js/modernizr.custom.79639.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl; ?>/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl; ?>/js/jquery.windy.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl; ?>/js/slider.js"></script>
	
	<!-- jRating CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/jRating.jquery.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/css/form.css" />
	<script type="text/javascript" src="<?php echo $baseurl;?>/js/jRating.jquery.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode('Facebook-image'); ?></div>
	</div><!-- header -->
	<div id="mainmenu">
		<?php 
		  $visible_guest = 1;
		  $visible_mb = 0;
		  $session = new CHttpSession;
		  $session->open();
		  $fuser_id = $session['fid'];
		  if(isset($fuser_id) && $fuser_id!='')
		  {
		  	$visible_mb = 1;
			$visible_guest = 0;
		  }
		?>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('site/index')),
				array('label'=>'List member', 'url'=>array('site/showmember')),
				array('label'=>'Login', 'url'=>array('site/login'), 'visible'=> $visible_guest),
				array('label'=>'Logout', 'url'=>array('site/logout'), 'visible'=> $visible_mb)
			),
		)); ?>
	</div><!-- mainmenu -->
	
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>