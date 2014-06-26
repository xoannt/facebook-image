<?php

class Review extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_review':
	 * @var integer $id
	 * @var string $image_id
	 * @var string $user_id
	 * @var string $rating
	 */
	public $id;
	public $image_id;
	public $user_id;
	public $rating;
	public $date_rating;
	public $avgRate;
	public $count_rate;
	public $facebook_name;
	public $link_image;
	public $face_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{review}}';
	}
	public function rate_avg($img_id = '')
	{
		$avg = '';
		if($img_id != '')
		{
			$criteria=new CDbCriteria();
							$criteria->select = array('rating', 'avg(rating) as avgRate');
							$criteria->condition = 'image_id=:image_id';
							$criteria->params = array(':image_id'=>$img_id);
							$avg = Review::model()->findAll($criteria);
		}
		return $avg;
	}
	
}

