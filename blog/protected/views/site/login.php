<?php if ($user): ?>
<?php 
echo "<pre>";
print_r($user_info); ?>
<a href="<?php echo $logout_url; ?>">Logout</a>
<?php else: ?>
<div>
<a href="<?php echo $login_url; ?>">Login with Facebook</a>
</div>
<?php endif ?>