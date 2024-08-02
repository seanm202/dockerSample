<?php
	require_once "pdo.php";
	$recipeIdNo=$_POST['recipeIdNo'];

	$sqlGetRecipe = "SELECT * FROM recipeds WHERE recipeId=:recipeIdNo";

	$stmtGetRecipe = $pdo->prepare($sqlGetRecipe);
	$stmtGetRecipe->execute(array(
			':recipeIdNo' => $recipeIdNo));
	$rowGetRecipe = $stmtGetRecipe->fetch(PDO::FETCH_ASSOC);

			echo json_encode($rowGetRecipe);
?>
