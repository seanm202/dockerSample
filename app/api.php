<?php
require_once 'action.php';
require_once 'recipe.php';
// Create an instance of the Employee class
$recipeObject = new Recipe($conn);
// Get the request method
$method = $_SERVER['REQUEST_METHOD'];
// Get the requested endpoint
$endpoint = $_SERVER['PATH_INFO'];
// Set the response content type
header('Content-Type: application/json');
// Process the request
switch ($method) {
    case 'GET':
        if ($endpoint === '/recipes') {
          //Get all recipes
            $recipes = $recipeObject->getAllRecipes();
            echo json_encode($recipes);
        } elseif (preg_match('/^\/recipes\/(\d+)$/', $endpoint, $matches)) {
          //Get a single api using RecpeId
            $recipeId = $matches[1];
            $recipe = $recipeObject->getRecipeById($recipeId);
            echo json_encode($recipe);
        }
        break;
    case 'POST':
        if ($endpoint === '/recipes') {
            // Add new recipe
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $recipeObject->addRecipe($data);
            echo json_encode(['success' => $result]);
        } elseif (preg_match('/^\/recipes\/(\d+)$/', $endpoint, $matches)) {
          //Get a single api using RecpeId
            $recipeId = $matches[1];
            $recipe = $recipeObject->rateRecipe($data);
            echo json_encode($recipe);
        }
        break;
    case 'PUT':
        if (preg_match('/^\/recipes\/(\d+)$/', $endpoint, $matches)) {
            // Update recipe by ID
            $recipeId = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $recipeObject->updateRecipe($recipeId, $data);
            echo json_encode(['success' => $result]);
        }
        break;
    case 'DELETE':
        if (preg_match('/^\/recipes\/(\d+)$/', $endpoint, $matches)) {
            // Delete recipe by ID
            $recipeId = $matches[1];
            $result = $recipeObject->deleteRecipe($recipeId);
            echo json_encode(['success' => $result]);
        }
        break;
    case 'POST':
        if (preg_match('/^\/recipes\/(\d+)$/', $endpoint, $matches)) {
            // Delete recipe by ID
            $recipeId = $matches[1];
            $result = $recipeObject->deleteRecipe($recipeId);
            echo json_encode(['success' => $result]);
        }
        break;
}
?>
