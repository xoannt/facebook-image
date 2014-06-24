<?php echo "<h1>".$user->facebook_name."'s photos</h1>"; ?>
<div class="windy-demo">
    <ul id="wi-el" class="wi-container">
<?php
foreach($list_photo as $photo)
{
?>
	<li><img src = <?php echo $photo['link_image'];?> /> <h4>Rating</h4><p>sao-sao-sao</p></li>
<?php
}

?>
</ul>

<nav>
    <span id="nav-prev">prev</span>
    <span id="nav-next">next</span>
</nav>
</div>