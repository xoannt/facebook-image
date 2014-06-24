<?php

class Image extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_image':
	 * @var integer $id
	 * @var string $link_image
	 * @var string $facebook_id
	 */
	public $id;
	public $link_image;
	public $facebook_id;
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
		return '{{image}}';
	}
	
}

