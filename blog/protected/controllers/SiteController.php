<?php

class SiteController extends Controller 
{
	protected $facebook;
	protected function getFaceBook() 
	{
		if ($this->facebook===null)
		{
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
		$model = User::model()->findAll(array('order' => 'id DESC'));	
		if($model !== NULL)
		{
			$this->render('showmember', array("list_member" => $model));
		}
		else {
			$empty_member = "No member";
			$this->render('showmember', array("empty_member" => $empty_member));
		}
	}
	public function actionShowImage($facebook_id = '', $accesstk = '')
	{
		if(isset($facebook_id) && isset($accesstk))
		{
			$model = Image::model()->findAll(array('condition'=>'facebook_id=:facebook_id','params'=>array('facebook_id'=>$facebook_id)));
			//$model = Image::model()->find(array('condition'=>'facebook_id=:facebook_id','params'=>array('facebook_id'=>$facebook_id)));
			$user = User::model()->find(array('condition'=>'facebook_id=:facebook_id','params'=>array('facebook_id'=>$facebook_id)));
			if($model !== NULL)
			{
				$this->render('showimage', array("list_photo" => $model, "user" => $user));
			}
			else {
				$empty_photo = "No photo";
				$this->render('showimage', array("empty_member" => $empty_photo));
			}
		}
		else {
			$this->redirect(Yii::app()->homeUrl); 
		}
	}
	
	// sr: https://github.com/facebook/facebook-php-sdk
	public function actionLogin()
	{
			$facebook = $this->getFaceBook();
			$base_url = Yii::app()->request->getBaseUrl(true);
			$redirect_uri = $base_url."/index.php/site/FacebookCallback";
			$login_url = $facebook->getLoginUrl(array(
									'scope' => 'publish_stream,user_photos',
									'display'=>'popup',
									'redirect_uri' => $redirect_uri));
			$this->redirect($login_url); 
	}
	
	
	protected function all_photos($accesstk = '')
	{
		$facebook = $this->getFaceBook();
		$photos = array();
		if(isset($accesstk)&& $accesstk!= '')
		{
			$data = $facebook->api('/me/photos/uploaded');
			foreach($data['data'] as $photo)
			{
				$photos[] = $photo['source'];
			}
		}
        return $photos;
	}
	
	
	public function actionFacebookCallback()
	{
			$facebook = $this->getFaceBook();
			$user = $facebook->getUser();
			if($user)
			{
				$model_user = new User;
				
				$check = $model_user->model()->find(array('condition'=>'facebook_id=:facebook_id','params'=>array('facebook_id'=>$user)));
				$accesstk = $facebook->getAccessToken();
				
				// source: https://developers.facebook.com/docs/graph-api/reference/v2.0/user/photos/
				$u = $data = $facebook->api('/me/photos/uploaded');
			   // $photos = $facebook->api($user.'/photos', 'get', array('access_token'=>$accesstk)); 
				echo "<pre>";
				print_r($u);
				// chỉ lấy được toàn bộ ảnh của người tạo ra app
				//người dùng đăng nhập khác chỉ lấy được thông tin cơ bản
				
			}
			/*
				// session facebook id
				$info = $facebook->api('/me');
				Yii::app()->session['fusername'] = $info['name'];
				
				// check user existed
				if($check === null)
				{
					
					$path = Facebook::$DOMAIN_MAP;
					$avatar = $path['graph'].$user."/picture";
					
					//$avatar = $facebook->api('me/picture');
					// set attributes
					$model_user->facebook_id = $info['id'];
					$model_user->facebook_name = $info['name'];
					$model_user->facebook_link = $info['link'];
					$model_user->access_token = $accesstk;
					$model_user->avatar = $avatar;
					//save user
					$model_user->save();
					// save image
					
					foreach($list_photo as $photo)
					{
						$model_image = new Image;
						$model_image->link_image = $photo;
						$model_image->facebook_id = $user;
						$model_image->save();
					}
					$this->redirect(Yii::app()->homeUrl); 
				} 
				else 
				{
					// save photo new
					
					// get list photos from db
					$photo_db = Image::model()->findAll(array('condition'=>'facebook_id=:facebook_id','params'=>array('facebook_id'=>$user)));	
					$arr_photo_db = array();
					foreach($photo_db as $pt)
					{
						$arr_photo_db[] = $pt->link_image;
					}
					// check image existed
					foreach($list_photo as $photo)
					{
						// save photo new
					   if(!in_array($photo, $arr_photo_db))
						{
							$model_image = new Image;
							$model_image->link_image = $photo;
							$model_image->facebook_id = $user;
							$model_image->save();
						}
					}
					$this->redirect(Yii::app()->homeUrl);
				} 
			} 
			else 
			{
				$this->redirect(Yii::app()->homeUrl);
			} */
}


	public function actionLogout()
	{
		$facebook = $this->getFaceBook();
		$accesstk = $facebook->getAccessToken();
		unset(Yii::app()->session['fusername']);
		$logout_url = $facebook->getLogoutUrl(array('next' => Yii::app()->request->getBaseUrl(true),'access_token' => $accesstk));
		$this->redirect($logout_url);
	}
		
}
