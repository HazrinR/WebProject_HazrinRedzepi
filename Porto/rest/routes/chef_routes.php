<?php

require_once __DIR__ . '/../services/ChefService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 
//provjera za ovu datoteku je http://localhost/WebProject_HazrinRedzepi/Porto/rest/routes/chef_routes.php 


Flight::set('ChefService', new ChefService());

/**
 * @OA\Post(
 *      path="/chefs/add",
 *      tags={"chefs"},
 *      summary="Add chef",
 *      @OA\Response(
 *           response=200,
 *           description="Chef added successfully"
 *      ),
 *      @OA\RequestBody(
 *          description="Chef details",
 *          @OA\JsonContent(
 *             required={"name", "surname", "expertise"},
 *             @OA\Property(property="name", type="string", example="Hazrin"),
 *             @OA\Property(property="surname", type="string", example="Redzepi"),
 *             @OA\Property(property="expertise", type="string", example="Cook"),
 *             @OA\Property(property="image", type="string", format="binary", description="The image of the chef (optional)"),
 *        
 *           )
 *      ),
 * )
 */

Flight::route('POST /chefs/add', function(){
    // Get the data sent via POST
    $data = Flight::request()->data->getData();

    try {
        $newChef = Flight::get('ChefService')->add_chef($data);
        
        Flight::json(["success" => true, "chef" => $newChef]);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

/**
 * @OA\Get(path="/chefs", tags={"chefs"}, 
 *         summary="Return all chefs from the API. ",
 *         @OA\Response( response=200, description="List of chefs.")
 * )
 */
Flight::route('GET /chefs', function(){
    try {
        $chefs = Flight::get('ChefService')->get_all_chefs();
        
        Flight::json($chefs);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }

});
/**
 * @OA\Post(
 *      path="/chefs/delete",
 *      tags={"chefs"},
 *      summary="Delete selected chefs",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"chefs"},
 *              @OA\Property(
 *                  property="chefs",
 *                  type="array",
 *                  @OA\Items(type="string"),
 *                  example={"1", "2", "3"},
 *                  description="Array of chef IDs to delete"
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success response",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=true),
 *              @OA\Property(property="message", type="string", example="Chefs deleted successfully")
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


//iz chefs.html u pozivu se proslijeduju id chefa koji su cekirani kao post i to data: { chefs: selectedChefs }, zato na get data mora biti ovo chefs da zna sta
Flight::route('POST /chefs/delete', function(){
    $selectedChefs = Flight::request()->data->getData()['chefs'];

    $ChefService = new ChefService();

    try {
        foreach ($selectedChefs as $chefId) {
            $ChefService->delete_chef_by_id($chefId);
        }

        Flight::json(["success" => true]);
    } catch (Exception $e) {
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});