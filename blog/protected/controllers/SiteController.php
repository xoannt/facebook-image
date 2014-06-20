<?php

class SiteController extends Controller 
{
	/*public public function actions()
	{
		return array();
	}*/
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
		$facebook = new Facebook(array(
			  'appId' => Yii::app()->params['appId'],
			  'secret' => Yii::app()->params['secret'],
			));
		$login_url=$facebook->getLoginUrl(array(
													'scope'=>'friends_photos, publish_stream',
													'display'=>'popup',
													'redirect_uri' => 'http://localhost/facebook-image/blog/index.php/site/FacebookCallback'
													));
		$this->redirect($login_url);
	}
	public function actionFacebookCallback()
	{
		// luu csdl
		echo "xu li";
	}
		
}
