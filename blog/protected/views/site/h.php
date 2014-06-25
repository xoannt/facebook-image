<?php echo "<h1>".$user->facebook_name."'s photos</h1>"; ?>
<div class="windy-demo">
    <ul id="wi-el" class="wi-container">
<?php
$baseurl = Yii::app()->request->baseUrl;
$session = new CHttpSession;
	  $session->open();
	  $fuser_id = $session['fid'];
foreach($list_photo as $photo)
{
?>
	<li><img class = '' src = <?php echo $photo['link_image'];?> alt = "<?php echo $photo['id']; ?>" id = "photo" /> 
		<h4>Rating average: <?php 
		$review = new Review; 
		$avg = $review->rate_avg($photo['id']);
		$avgRate = $avg[0]->avgRate;
		echo $avgRate." star";
		?> </h4>
		
	<p><?php if($fuser_id && $fuser_id!= $user->facebook_id) { ?>
		<div class="jRating" data-average="<?php echo $avgRate;/*$rating_avg;*/?>"></div>
    	
	<?php } 
	elseif($fuser_id == $user->facebook_id) 
	{
		echo '';
	}
	else {
		
		echo "<a href = '".$baseurl."/index.php/site/login' target='_blank'>Login to rating image</a>";
	}?>	
	</p></li>
<?php
}

?>
</ul>

<nav>
    <span id="nav-prev">prev</span>
    <span id="nav-next">next</span>
</nav>
</div>
<script>
                                $(document).ready(function () {
                                	var user_id = <?php echo $fuser_id;?>;
                                	var image_id = $('#photo').attr('alt');
                                	
                                    $('.jRating').jRating({
                                         step : true, 
                                         length : 10, 
                                         type : 'big',
                                         rateMax: 10,
                                         phpPath : '<?php echo $baseurl;?>/index.php/site/rating?image_id='+image_id+'&fuser_id='+user_id,
                                         onSuccess : function(){
                                         	alert("thanks you ratted");
                                         	alert(image_id);
										  }
                                });
                                });
</script>	
