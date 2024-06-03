<?php

require_once __DIR__ .  '/rest/services/ChefService.class.php';

$selectedStatuss = $_POST['Status'];


$StatusService = new StatusService();

try {
    
    foreach ($selectedStatuss as $statusId) {   //moguce da ovdje nesto nije kako treba
        $StatusService->delete_status_by_id($statusId);
    }

    // Return success response
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // Return error response
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}

?>
