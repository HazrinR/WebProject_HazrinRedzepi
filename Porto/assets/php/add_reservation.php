<?php

require_once __DIR__ .  '/rest/services/ReservationService.class.php';

// Get the data sent via POST
$data = json_decode(file_get_contents("php://input"), true);

 
$ReservationService = new ReservationService();

try {
     
    $newReserv = $ReservationService->add_reservation($data);
     
    echo json_encode(["success" => true, "reservation" => $newReserv]);
} catch (Exception $e) {
     
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
