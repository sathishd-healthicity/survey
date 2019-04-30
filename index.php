<?php require "head.php" ?>
<?php 
$email=$_POST['email'];
if(filter_var($email,FILTER_VALIDATE_EMAIL)){
	$_SESSION['email']=$email;
	header ("Location: survey.php");
}
?>
<div><h3>Please enter Email Address for Survey</h3></div>
<form method=post action=''>
	<input type=email name=email required email>
	<input type=Submit value='Start Survey'>
</form>
<div id="thanksdiv">
	<div style="width: 60%;">
		<div>This Survey online application is demo assignment as part of Cloud Computing course on google app platform.</div>
		<div style="text-align: right;">- ID:2018ht12173</div>
    </div>    
</div>
<?php require "foot.php" ?>
