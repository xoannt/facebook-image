<?php

class SiteController extends Controller 
{
	protected $facebook;
	protected function getFaceBook() 
	{
		if ($this->facebook===null){
                        $this->facebook = new Facebook(array('appId'=>Yii::app()->params['appId'],
                        									 'secret'=>Yii::app()->params['secret']));
                        }
        return $this->facebook;
	}
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	public function actionIndex()
	{
		
		$this->render('index');
	}
	public function actionShowMember()
	{
		$model = User::model()->findAll();	
		$this->render('showmember', array("list_member" => $model));
	}
	public function actionShowImage($facebook_id = '')
	{
		$facebook = $this->getFaceBook();
		if(isset($_GET['facebook_id']))
		{
			// examp view photos all
			$data = $facebook->api(
            '/me/albums','GET',
            array(
                'fields' => 'id,name,privacy,photos.fields(id,name,images)',
            ));
            
        }
	}
	
	public function actionLogin()
	{
			$facebook = $this->getFaceBook();
			$base_url = Yii::app()->request->getBaseUrl(true);
			$redirect_uri = $base_url."/index.php/site/FacebookCallback";
			$login_url = $facebook->getLoginUrl(array(
									'display'=>'popup',
									'redirect_uri' => $redirect_uri));
			$this->redirect($login_url);
	}
	
	protected function all_photos($facebook_id = '')
	{
		$facebook = $this->getFaceBook();
		if(isset($_GET['facebook_id']))
		{
			$data = $facebook->api(
            '/me/albums','GET',
            array(
                'fields' => 'id,name,privacy,photos.fields(id,name,images)',
            )); 
			//...
            
        }
	}
	public function actionFacebookCallback()
	{
			$facebook = $this->getFaceBook();
			$user = $facebook->getUser();
			if($user)
			{
				/*  $criteria = new CDbCriteria();
					$criteria->condition = 'facebook_id = :facebook_id';
					$criteria->params = array(':facebook_id' => $user);
					$check = User::model()->find($criteria); 
					$check = User::model()->find(array('condition'=>'facebook_id=:facebook_id','params'=>array('facebook_id'=>$user)));
				*/
				
				$model_user = new User;
				$check = $model_user->model()->find(array('condition'=>'facebook_id=:facebook_id','params'=>array('facebook_id'=>$user)));
				//var_dump($check);
				
				if($check === null)
				{
					$info = $facebook->api('/me');
					$path = Facebook::$DOMAIN_MAP;
					$avatar = $path['graph'].$user."/picture";
					//$avatar = $facebook->api('me/picture');
					// set attributes
					$model_user->facebook_id = $info['id'];
					$model_user->facebook_name = $info['name'];
					$model_user->facebook_link = $info['link'];
					$model_user->avatar = $avatar;
					// save user
					$model_user->save();
					
					// save image
					
					$photo = $facebook->api(
		            '/me/albums','GET',
		            array(
		                'fields' => 'id,name,privacy,photos.fields(id,name,images)',
		            ));
					
					$this->redirect(Yii::app()->homeUrl);
				} 
				else 
				{
					$this->redirect(Yii::app()->homeUrl);
				} 
			}
			else 
			{
				$this->redirect(Yii::app()->homeUrl);
			}
}
	public function actionLogout()
	{
		
		$this->redirect(Yii::app()->homeUrl);
	}
		
}
