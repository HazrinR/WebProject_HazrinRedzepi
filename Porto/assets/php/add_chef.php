<?php

require_once __DIR__ .  '/rest/services/ChefService.class.php';

// Get the data sent via POST
$data = json_decode(file_get_contents("php://input"), true);

// Instantiate ChefService
$ChefService = new ChefService();  //$chefService prije bilo

try {
    // Add the chef
    $newChef = $ChefService->add_chef($data);
    // Output the newly added chef
    echo json_encode(["success" => true, "chef" => $newChef]);
} catch (Exception $e) {
    // Handle the exception
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
