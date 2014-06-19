<?php

class SiteController extends Controller 
{
	
	public function actionIndex()
	{
		$this->render('index');
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
		echo "login facebook";
	}
		
}
