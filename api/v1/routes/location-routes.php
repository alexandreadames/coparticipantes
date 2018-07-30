<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \App\Models\DAO\LocationDAO;

/**
 * Get the state list
 */
$app->get('/location/states', function (Request $request, Response $response) use ($app) {
   
    //Query for a citie by ibge code for response
    $locationDAO = new LocationDAO();

    $states = $locationDAO->getStates();

    $result["error"] = false;
    $result["data"]["states"] = $states;


    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json; charset=utf-8');

    return $return;
 });

/**
 * Get the state list
 */
$app->get('/location/cities/{state_id}', function (Request $request, Response $response) use ($app) {
   	

   	$route = $request->getAttribute('route');
    $state_id = $route->getArgument('state_id');

    //Query for a citie by ibge code for response
    $locationDAO = new LocationDAO();

    $cities = $locationDAO->getCitiesByState($state_id);

    $result["error"] = false;
    $result["data"]["cities"] = $cities;


    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json; charset=utf-8');

    return $return;
 });


/**
 * Get the location by zipcode
 */
$app->get('/location/{zipcode}', function (Request $request, Response $response) use ($app) {
   	
   	$route = $request->getAttribute('route');
    $zipcode = $route->getArgument('zipcode');

    //Make a call for viacep api
    $address = json_decode(file_get_contents("https://viacep.com.br/ws/$zipcode/json/"), true);

    //Query for a citie by ibge code for response
    $locationDAO = new LocationDAO();

    $selected_location = $locationDAO->getLocationByIbgeCode($address['ibge']);
    $selected_location['street'] = $address['logradouro'];
    $selected_location['addressdetails'] = $address['complemento'];
    $selected_location['district'] = $address['bairro'];
    $selected_location['ibge_code'] = $address['ibge'];

    //Get cities list by state selected
    $selected_cities = $locationDAO->getCitiesByState($selected_location['state_id']);

    $result["error"] = false;
    $result["data"]["selected_location"] = $selected_location;
    $result["data"]["selected_cities"] = $selected_cities;


    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json; charset=utf-8');

    return $return;
 });


?>