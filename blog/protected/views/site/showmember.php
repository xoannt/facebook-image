<?php
	  $session = new CHttpSession;
	  $session->open();
	  $fusername = $session['fusername'];
	  if($fusername)
	  {
	  	echo "<p>Welcome ".$fusername."!</p>";
	  }
	  else {
	  	echo '';	 
      }
?>
<ul class="list_member">
<?php
foreach($list_member as $member)
{
?>	<li>
	<div>
		<img src="<?php echo $member['avatar'];?>" width="50" height="50"  style = "border: 1px solid #CCC; box-shadow: 3px 3px 3px #CCC"/>
	</div>
	<div>
		<h1><?php echo $member['facebook_name'];?></h1>
		<p>
		   <a href="<?php echo $member['facebook_link'];?>">Facebook</a>
		   <span style="color: red;">|</span>
		   <a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/showimage?facebook_id=<?php echo $member['facebook_id'];?>">Rating Image</a>
		</p>
	</div>
	</li>
<?php
}
echo (isset($empty_member)&&$empty_member!='')?$empty_member:'';
?>
<ul>
