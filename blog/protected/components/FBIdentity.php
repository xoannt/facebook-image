<?php

class FBIdentity
{
	private $_id;
	public function isGuestFB()
	{
		$session=new CHttpSession;
		$session->open();
		$accesstk = $session['access_token'];
		if($accesstk === NULL)
		{
			return 0;
		}
		else 
		{
			return 1;
		}
	}
	public function getId()
	{
		return $this->_id;
	}
}
