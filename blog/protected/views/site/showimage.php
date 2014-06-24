<?php
echo "<h1>".$user->facebook_name."'s photos</h1>";
echo "<ul>";
foreach($list_photo as $photo)
{
?>
	<li style = "float: left; list-style: none; padding: 5px;"><img src = <?php echo $photo['link_image'];?> width = "200" height = "200"/> </li>
<?php
}
echo "</ul>";