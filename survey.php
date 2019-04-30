<?php 

require "head.php" ;
if(empty($_SESSION['email']))
{
	header ("Location: index.php");
}

?>
<script>
$(document).ready(function() {
	$("input:radio[name=options]").click(function() {
		$('#contentdiv').hide('slide', {direction: 'left'}, 100);
		$.post( "surveyck.php", {"opt":$(this).val(),"qst_id":$("#qst_id").val()},function(return_data,status){

			if(return_data.next=='T'){
				$('#q1').html(return_data.data.q1);
				$('label[for=opt1]').html(return_data.data.opt1);
				$('label[for=opt2]').html(return_data.data.opt2);
				$('label[for=opt3]').html(return_data.data.opt3);
				$('label[for=opt4]').html(return_data.data.opt4);
				$("#qst_id").val(return_data.data.qst_id);
			}else{
					$('#contentdiv').addClass("hidden");
					$('#thanksdiv').removeClass("hidden");
					window.setTimeout(function(){
						// Move to a new location or you can do something else
        				window.location.href = "result.php";
					}, 5000);
			}
		},"json"); 
		$("#f1")[0].reset();
	 	$('#contentdiv').show('slide', {direction: 'right'}, 1000);
    });
});
//function // Your application has indicated there's an error
</script>

<?php
$count=$dbo->prepare("select * from poll_qst where qst_id=1");
if($count->execute()){
	$row = $count->fetch(PDO::FETCH_OBJ);
}
echo "
<div id='contentdiv'>
<form id='f1'>
<table>
<tr><td>
<h3 id='q1'>$row->qst</h3></td></tr>
<tr><td>
<input type=hidden id=qst_id value=$row->qst_id>
<tr><td>
      <input type='radio' name='options' id='opt1' value='option1' > <label for='opt1' class='lb'>$row->opt1</label>
</td></tr>
<tr><td>
      <input type='radio' name='options' id='opt2' value='option2' >  <label for='opt2' class='lb'>$row->opt2</label>
</td></tr>

<tr><td>
      <input type='radio' name='options' id='opt3' value='option3' >  <label for='opt3' class='lb'>$row->opt3</label>
</td></tr>
<tr><td>
      <input type='radio' name='options' id='opt4' value='option4' >  <label for='opt4' class='lb'>$row->opt4</label>
</td></tr>
</table>
</form>
</div>
";
?>
<div id="thanksdiv" class="hidden"><img src="thankyou.png"> 
	<h3>Thanks for your valuable participation and your views</h3>
	<div style="width: 60%;">
		<div>This Survey online application is demo assignment as part of Cloud Computing course on google app platform.</div>
		<div style="text-align: right;">- ID:2018ht12173</div>
		<div><img src="redirection.gif" id="loader"></div>
    </div>    
</div>
<?php require "foot.php" ?>