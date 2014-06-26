<div id = "list_rate">
	<ul>
	   <?php 
	    $md = new Review;
		
	   foreach ($repost_rate as $img) {  
	   	$avg = $md->rate_avg($img->image_id);
	   	?>
	   	
		   <li>
		   	<a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/showimage?facebook_id=<?php echo $img->face_id;?>"><img src = <?php echo $img->link_image; ?> width = "100" height = "100"/> </a>
		   	<p><a class= "namefb" href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/showimage?facebook_id=<?php echo $img->face_id;?>"><?php echo "Rating ".$img->facebook_name;?> </a></p>
		   	<p class = "count_rate"> Count rate: <?php echo $img->count_rate;?></p> 
		   	<p class = "avg_rate"> Rate avg: <?php echo $avg[0]->avgRate;?></p> 
		   </li>
	   <?php }?>	
	</ul>
</div>
