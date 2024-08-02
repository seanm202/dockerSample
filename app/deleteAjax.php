<?php
	include "recipe.php";
	$recipeId=$_POST['recipeIdNo'];
	$suc=rateRecipe($recipeId);
	$sql = "DELETE FROM recipeds WHERE recipeId = '".$recipeId."'";

	if ($sql === TRUE) {
	  $message="Record deleted successfully";
	} else {
	  $message="Error deleting record: " . $conn->error;
	}

						echo json_encode($message);
?>
