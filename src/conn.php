<?php
	try
	{
		$bdd = new PDO('mysql:host=databases.000webhost.com;dbname=id18048285_quizzbd', 'id18048285_seckdieng', 'uW75pCEz9PvvUN=j');
	}catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>
