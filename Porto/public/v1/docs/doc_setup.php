<?php

/**
 * @OA\Info(
 *   title="API",
 *   description="Web Programming API",
 *   version="1.0",
 *   @OA\Contact(
 *     email="hazrin.redzepi@stu.ibu.edu.ba",
 *     name="Hazrin Redzepi"
 *   )
 * ),
 * @OA\OpenApi(
 *   @OA\Server(
 *       url=BASE_URL
 *   )
 * )
 * @OA\SecurityScheme(
 *     securityScheme="ApiKey",
 *     type="apiKey",
 *     in="header",
 *     name="Authentication"
 * )
 */