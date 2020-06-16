<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=quizz_odc', 'root', '');
	}catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>