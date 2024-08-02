<?php
	require_once "pdo.php";
 $recipeSearchContent=$_GET["recipeSearchContent"];
// $dd="Saladd";
	$sqlGetRecipe = "SELECT * FROM recipeds WHERE recipeName LIKE ? OR recipePrepTime LIKE ? OR recipePrepDifficulty LIKE ? OR recipeVegOrNot LIKE ? OR rating LIKE ?";


$params = array("%$recipeSearchContent%","%$recipeSearchContent%","%$recipeSearchContent%","%$recipeSearchContent%","%$recipeSearchContent%");
$stmtGetRecipe = $pdo->prepare($sqlGetRecipe);
$stmtGetRecipe->execute($params);

	$rowGetRecipe = $stmtGetRecipe->fetchAll(PDO::FETCH_ASSOC);
$toBeSentAsReply="";
		foreach($rowGetRecipe as $re)
		{
			$toBeSentAsReply.="<tr><td>".$re['recipeId']."</td><td>".$re['recipeName']."</td><td>".$re['recipePrepTime']."</td><td>".$re['recipePrepDifficulty']."</td><td>".$re['recipeVegOrNot']."</td><td>".$re['rating']."</td><tr>";

		}
echo json_encode($toBeSentAsReply);


?>
