<?php
	require_once "pdo.php";
	$recipeName=$_POST['recipeName'];
	$recipePrepTime=$_POST['recipePrepTime'];
	$recipePrepDifficulty=$_POST['recipePrepDifficulty'];
	$recipeVegOrNot=$_POST['recipeVegOrNot'];

		$sql=addRecipe($_POST);

				if ($sql === TRUE) {
				  $message="Record deleted successfully";
				} else {
				  $message="Error deleting record";
				}
			echo json_encode($message);
return 0;
?>
