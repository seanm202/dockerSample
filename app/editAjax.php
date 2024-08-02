<?php
	include "recipe.php";
	$recipeIdNo=$_POST['recipeNoOfModalInput'];
	$recipeName=$_POST['recipeNameModalInput'];
	$recipePrepTime=$_POST['recipeDurationModalInput'];
	$recipePrepDifficulty=$_POST['recipeDifficultyModalInput'];
	$recipeVegOrNot=$_POST['recipeVegOrNotModalInput'];

	$sql=updateRecipe($recipeIdNo, $_POST);

		if ($sql === TRUE) {
		  $message="Record deleted successfully";
		} else {
		  $message="Error deleting record";
		}
	echo json_encode($message);

?>
