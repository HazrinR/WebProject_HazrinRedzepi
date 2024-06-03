<?php

require_once __DIR__ . '/../services/UserService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 

Flight::set('UserService', new UserService());
/**
 * @OA\Post(
 *      path="/users/add",
 *      tags={"users"},
 *      summary="Add user",
 *      @OA\Response(
 *           response=200,
 *           description="User added successfully"
 *      ),
 *      @OA\RequestBody(
 *          description="User details",
 *          @OA\JsonContent(
 *             required={"name", "surname"},
 *             @OA\Property(property="name", type="string", example="Hazrin"),
 *             @OA\Property(property="surname", type="string", example="Redzepi"),
 *          
 *             
 *     
 *           )
 *      ),
 * )
 */

Flight::route('POST /users/add', function(){
   
    $data = Flight::request()->data->getData();

    try {
        $newUser = Flight::get('UserService')->add_user($data);
        
        Flight::json(["success" => true, "user" => $newUser]);
    } catch (Exception $e) {
       
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

/**
 * @OA\Post(
 *      path="/users/delete",
 *      tags={"users"},
 *      summary="Delete selected users",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"users"},
 *              @OA\Property(
 *                  property="users",
 *                  type="array",
 *                  @OA\Items(type="string"),
 *                  example={"1", "2", "3"},
 *                  description="Array of user IDs to delete"
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success response",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=true),
 *              @OA\Property(property="message", type="string", example="Patients deleted successfully")
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Error response",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=false),
 *              @OA\Property(property="error", type="string", example="Error message")
 *          )
 *      )
 * )
 */
Flight::route('POST /users/delete', function(){
    
    $selectedUsers = Flight::request()->data->getData()['users'];

    $PatientService = new UserService();

    try {
       
        foreach ($selectedUsers as $userId) {
            $PatientService->delete_user_by_id($userId); 
        }

       
        Flight::json(["success" => true]);
    } catch (Exception $e) {
        
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

/**
 * @OA\Get(path="/users", tags={"users"}, 
 *         summary="Return all users from the API. ",
 *         @OA\Response( response=200, description="List of users.")
 * )
 */
Flight::route('GET /users', function(){
    try {
        $users = Flight::get('UserService')->get_all_users();
        
        Flight::json($users);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }

});