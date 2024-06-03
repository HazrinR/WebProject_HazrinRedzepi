<?php

require_once __DIR__ .  '/rest/services/UserService.class.php';

// Get the data sent via POST
$data = json_decode(file_get_contents("php://input"), true);

 
$UserService = new UserService();

try {
   
    $newUser = $UserService->add_user($data);
    
    echo json_encode(["success" => true, "user" => $newUser]);
} catch (Exception $e) {
    // Handle the exception
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
