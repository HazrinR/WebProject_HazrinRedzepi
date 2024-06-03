<?php

require_once __DIR__ .  '/rest/services/UserService.class.php';


$selectedUsers = $_POST['users'];


$UserService = new UserService();

try {
    
    foreach ($selectedUsers as $userId) {
        $UserService->delete_user_by_id($userId);
    }

    // Return success response
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // Return error response
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}

?>
