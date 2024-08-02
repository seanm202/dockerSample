<?php
	include "recipe.php";
	$recipeIdNo=$_POST['recipeId'];
	$recipeRating=$_POST['recipeRating'];

	$sql=updateRecipe($recipeIdNo, $_POST);

		if ($sql === TRUE) {
		  $message="Record deleted successfully";
		} else {
		  $message="Error deleting record";
		}
	echo json_encode($message);

?>
