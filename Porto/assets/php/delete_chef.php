<?php

require_once __DIR__ .  '/rest/services/ChefService.class.php';

// Get the selected chefs IDs sent via POST
$selectedChefs = $_POST['chefs'];

// Instantiate ChefService
$chefService = new ChefService();

try {
    // Delete the selected chefs
    foreach ($selectedChefs as $chefId) {
        $chefService->delete_chef_by_id($chefId);
    }

    // Return success response
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // Return error response
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}

?>
