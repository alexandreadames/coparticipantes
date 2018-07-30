<?php

/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;


/**
 * Entities
 */
use \App\Models\Entity\User;
use \App\Models\DAO\UserDAO;
use \App\Models\Utils\Globals;


use \App\Models\Utils\TokenUtils;


/**
 * Pega os dados do usuário após logar
 */
$app->get('/secure/user', function (Request $request, Response $response) use ($app) {

        //$route = $request->getAttribute('route');
        //$id = $route->getArgument('id'); 

        $decoded_token = TokenUtils::decodeToken($request);   

        $userDAO = new UserDAO();

        $result = $userDAO->getUserById( (int) $decoded_token["userId"]);

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});

/**
 * Pega os dados completos do usuário
 */
$app->get('/secure/user-personaldata-profile', function (Request $request, Response $response) use ($app) { 

        $decoded_token = TokenUtils::decodeToken($request);   

        $userDAO = new UserDAO();

        $result = $userDAO->getPersonalDataAndProfile( (int) $decoded_token["userId"]);

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});

/**
 * Cadastra um novo usuário
 * Ex.
 *
 {
    "email": "alexandre.adames@gmail.com",
    "password": "teste",
    "name": "Alexandre",
    "phone": "(84) 988285116",
    "street": "Avenida Brigadeiro Salema",
    "street_number": 714,
    "district": "Alto de São Manoel",
    "additional_address_details": "Apto 103 BL A1",
    "zip_code": "59628030",
    "id_city": 35,
    "type": "F",
    "cpf_cnpj": "04983863419",
    "date_of_birth": "1984-08-11", 
    "sex": "M" 
}
 */
$app->post('/user/register', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    $user = new User();

    //User
    $user->setEmail($params->email);
    $user->setPassword($params->password);

    //Person
    $user->setName($params->name);
    $user->setPhone($params->phone);
    $user->setStreet($params->street);
    $user->setStreetNumber($params->street_number);
    $user->setDistrict($params->district);
    $user->seAdditionalAddressDetails($params->additional_address_details);
    $user->seetZipCode($params->zip_code);
    $user->setIdCity($params->id_city);
    $user->setType($params->type);
    $user->setCpfCnpj($params->cpf_cnpj);
    $user->setDateOfBirth($params->date_of_birth);
    $user->setSex($params->sex);

    
    $userDAO = new UserDAO();

    $result = $userDAO->register($user);
    
    $return = $response->withJson($result, 201)
        ->withHeader('Content-type', 'application/json');
    return $return;

    
    //USE PARA DEBUG
    /*$response->getBody()->write(json_encode($result));
    return $response;*/
    
    
});


/**
 * Login
 */

$app->post('/user/login', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    $userDAO = new UserDAO();

    $result = $userDAO->login($params->email, $params->password );
    
    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json; charset=utf-8');
    return $return;

    
    //USE PARA DEBUG
    /*$response->getBody()->write(json_encode($result));
    return $response;*/
    
    
});
?>