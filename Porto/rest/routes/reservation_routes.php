<?php
require_once __DIR__ . '/../services/ReservationService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php';
Flight::set('ReservationService', new ReservationService());


/**
 * @OA\Post(
 *      path="/reservations/add",
 *      tags={"reservations"},
 *      summary="Add reservation",
 *      @OA\RequestBody(
 *          description="Reservation details",
 *          @OA\JsonContent(
 *             required={"doctor_id", "patient_id", "appointment_date", "status"},
 *             @OA\Property(property="doctor_id", type="integer", example=1),
 *             @OA\Property(property="patient_id", type="integer", example=2),
 *             @OA\Property(property="appointment_date", type="string", format="date", example="2021-03-20"),
 *             @OA\Property(property="status", type="integer", type="integer", example=1)
 *          )
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Reservation added successfully"
 *      )
 * )
 */



Flight::route('POST /reservations/add', function(){
    // Get the data sent via POST
    $data = Flight::request()->data->getData();

    try {
        $newReservation = Flight::get('ReservationService')->add_reservation($data);
        
        Flight::json(["success" => true, "reservation" => $newReservation]);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

//ne treba na stranici da se prikaze
Flight::route('GET /reservations', function(){
    try {
        $reservations = Flight::get('ReservationService')->get_all_reservations();  //ovdje bilo prvobitno Reservationservice tj service malim
        
        Flight::json ($reservations);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }

});

