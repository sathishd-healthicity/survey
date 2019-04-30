<?php 
require "head.php" ;
if(empty($_SESSION['email']))
{
	header ("Location: index.php");
}
?>	
<script>
$(document).ready(function() {
	window.setTimeout(function(){
		// Move to a new location or you can do something else
		window.location.href = "index.php";
	}, 5000);
});
//function // Your application has indicated there's an error
</script>
<?php 
for($i=1;$i<=3;$i++){ // loop for 10 questions
	$query=$dbo->prepare("select * from poll_qst where qst_id=$i");
	if($query->execute()){
		$question = $query->fetch(PDO::FETCH_OBJ);
		if(!empty($question)){	
			$result = array("option1"=>0,"option2"=>0,"option3"=>0,"option4"=>0);
			$total = 0;
					
			$query2=$dbo->prepare("select opt, count(ans_id) as no from poll_qst left join poll_answer on
				poll_qst.qst_id=poll_answer.qst_id where poll_answer.qst_id='{$question->qst_id}' group by opt");
			if($query2->execute()){
				$answers = $query2->fetchAll(PDO::FETCH_OBJ);
				if(!empty($answers))
				{
					foreach ($answers as $answer) 
					{
						$result[$answer->opt] = (int)$answer->no;
						$total += (int)$answer->no;
					}
				}
			}

			//////////////
			echo "<b>{$question->qst}</b> <br><br>";
			echo "{$question->opt1} (".$result["option1"].") ".number_format($result["option1"]*100/$total)."%<br>";
			echo "{$question->opt2} (".$result["option2"].") ".number_format($result["option2"]*100/$total)."%<br>";
			echo "{$question->opt3} (".$result["option3"].") ".number_format($result["option3"]*100/$total)."%<br>";
			echo "{$question->opt4} (".$result["option4"].") ".number_format($result["option4"]*100/$total)."%<br>";

			echo "Total answers : {$total} <hr>";
		}
	}
} //end of for loop for ten questions
?>
<div id="thanksdiv">
	<h3>Thanks for your valuable participation and your views</h3>
	<div style="width: 60%;">
		<div>This Survey online application is demo assignment as part of Cloud Computing course on google app platform.</div>
		<div style="text-align: right;">- ID:2018ht12173</div>
		<div><img src="redirection.gif" id="loader"></div>
    </div>    
</div>
<?php require "foot.php" ; session_destroy(); ?>
