<?php

class SiteController extends Controller 
{
	
	public function actionIndex()
	{
		$this->render('index');
		$facebook = YII::app()->facebook->getFacebook();
	}
	public function actionShowMember()
	{
			
		$this->render('showmember');
	}
	public function actionShowImage()
	{
		
	}
	public function actionLogin()
	{
		$this->redirect(Yii::app()->homeUrl);
	}
		
}
