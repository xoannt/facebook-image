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
	        	$this->render('error', array("error" => $error));
	    }
	}
	
	
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->alias = 'tbl_review';
		$criteria->select = array('tbl_image.facebook_id as face_id', 'tbl_review.image_id', 'tbl_user.facebook_name', 'link_image', 'count(image_id) as count_rate');
		$criteria->join = "INNER JOIN tbl_image 
									           ON  tbl_image.id = tbl_review.image_id
							INNER JOIN tbl_user 
									           ON  tbl_user.facebook_id = tbl_image.facebook_id";
		
		$criteria->group = 'tbl_review.image_id';
		$criteria->order = 'count_rate DESC';
		$criteria->limit = Yii::app()->params['limit_rate'];
		$model = Review::model()->together()->findAll($criteria);
		
		$this->render('index', array('repost_rate' => $model));
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
	
	
	public function actionShowImage($facebook_id = '')
	{
		if(isset($facebook_id))
		{
			$user = User::model()->find(array('condition'=>'facebook_id=:facebook_id','params'=>array('facebook_id'=>$facebook_id)));
			$criteria = new CDbCriteria();
			$criteria->condition = 'facebook_id=:facebook_id';
			$criteria->params = array('facebook_id'=>$facebook_id);
			$model = Image::model()->findAll($criteria);
		   
			if($model !== NULL)
			{
				$this->render('showimage', array("list_photo" => $model, 
				"user" => $user));
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
									'scope' => 'publish_actions,publish_stream,user_photos,user_likes,email',
									'display'=>'popup',
									'redirect_uri' => $redirect_uri));
			$this->redirect($login_url); 
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
				// session facebook id
				$info = $facebook->api('/me');
				Yii::app()->session['fusername'] = $info['name'];
				Yii::app()->session['fid'] = $user;
				$data = $facebook->api('/me/photos/uploaded');
				$list_photo = array();
				foreach($data['data'] as $photo)
				{
					$list_photo[] = $photo['source'];
				}
			
				// source: https://developers.facebook.com/docs/graph-api/reference/v2.0/user/photos/
				//$u = $data = $facebook->api('/me/photos/uploaded');
			   // $photos = $facebook->api($user.'/photos', 'get', array('access_token'=>$accesstk)); 
				//echo "<pre>";
				//print_r($u);
				// chỉ lấy được toàn bộ ảnh của người tạo ra app
				//người dùng đăng nhập khác chỉ lấy được thông tin cơ bản
				
			
				
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
					
					// save photo new
					foreach($list_photo as $photo)
					{
						
					   if(!in_array($photo, $arr_photo_db))
						{
							$model_image = new Image;
							$model_image->link_image = $photo;
							$model_image->facebook_id = $user;
							$model_image->save();
						}
					}
					// delete image in db, which facebook deleled
					foreach($arr_photo_db as $photodb)
					{
					   if(!in_array($photodb, $list_photo))
						{
							
							Image::model()->deleteAll(array('condition'=>'link_image=:link_image','params'=>array('link_image'=>$photodb)));
							
						}
					}
					
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
		
			$facebook = $this->getFaceBook();
			$accesstk = $facebook->getAccessToken();
			unset(Yii::app()->session['fusername']);
			unset(Yii::app()->session['fid']);
			$logout_url = $facebook->getLogoutUrl(array('next' => Yii::app()->request->getBaseUrl(true),'access_token' => $accesstk));
			$this->redirect($logout_url);
		
		
	}
	
	public function actionRating($image_id = '', $fuser_id = '')
    {
        $aResponse['error'] = false;
        $aResponse['message'] = '';
		if(isset($image_id)&&isset($fuser_id))
		{
		    if(isset($_POST['action']))
	        {
	                if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'rating')
	                {
	                        $rate = floatval($_POST['rate']);
							
        					$date_rating = date("Y-m-d");
	                        // YOUR MYSQL REQUEST HERE or other thing :)
	                        $flag = 1;
							$model_review = new Review;
							$data = $model_review->model()->findAll();
							foreach($data as $review)
							{
								if(($review->date_rating == $date_rating)&&($review->user_id == $fuser_id)&&($review->image_id == $image_id))
								{
									
									$flag = 0; break;
								}
							}
							if($flag == 1)
							{
								
								$model_review->image_id = $image_id;
								$model_review->user_id = $fuser_id;
								$model_review->rating = $rate;
								$model_review->date_rating = $date_rating;
								$model_review->save();
								$aResponse['server'] = 'Thanks for your rate';
	                           
							}
							else {
								    $aResponse['server'] = 'You have ratted today';
	                            	
							}
							// rating avg
							
							// if request successful
	                        $success = true;
	                        // else $success = false;
	                        // json datas send to the js file
	                        if($success)
	                        {
	                                $aResponse['message'] = 'Your rate has been successfuly recorded. Thanks for your rate :)';
	                                echo json_encode($aResponse);
	                        }
	                        else
	                        {
	                                $aResponse['error'] = true;
	                                $aResponse['message'] = 'An error occured during the request. Please retry';
	                                
	                        }
	                }
	                else
	                {
	                        $aResponse['error'] = true;
	                        $aResponse['message'] = '"action" post data not equal to \'rating\'';
	                        
	                }
	        }
	        else
	        {
	                $aResponse['error'] = true;
	                $aResponse['message'] = '$_POST[\'action\'] not found';
	                
	        }
        }
    }
		
}
