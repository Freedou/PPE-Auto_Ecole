<form method="POST" action="">
<textarea name="titre"></textarea>
<textarea name="content"></textarea>
<input value="Send" type="submit">
</form>
<?php
if(!empty($_POST))
{
	var_dump($_POST);
	$tab=array($_POST["titre"]=>$_POST["content"]);
	var_dump($tab);
	$xml=xmlrpc_encode($tab);
	var_dump($xml);
	$axml=xmlrpc_decode($xml);
	var_dump($axml);

	$monXML=fopen("data/data.xml", "w+");
	fwrite($monXML, $xml);
	fclose($monXML);
}
?>