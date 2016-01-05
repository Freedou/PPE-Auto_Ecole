<meta charset="UTF-8">
<form method="POST" action="">
<textarea name="titre" placeholder="Intitulé du menu"></textarea>
<textarea name="content1"></textarea>
<textarea name="content2"></textarea>
<input value="Send" type="submit">
</form>
<?php
if(!empty($_POST))
{
	var_dump($_POST);
	$tab=array($_POST["titre"]=>array('content1'=>$_POST["content1"], 'content2'=>$_POST["content2"]));
	var_dump($tab);
	$json=json_encode($tab);
	var_dump($json);
	$ajson=json_decode($json);
	var_dump($ajson);

	$monJSON=fopen("data/data.json", "w+");
	fwrite($monJSON, $json);
	fclose($monJSON);
}
?>