<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
/**
 * Entities
 */
use \App\Models\Entity\Person;
/**
 * Lista de todos os livros
 */
$app->get('/secure/person', function (Request $request, Response $response) use ($app) {

    $return = $response->withJson(['conseguiu acessar a rota'], 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

/**
 * Retornando mais informações do livro informado pelo id
 */

$app->get('/person/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $person = new Person();

    $person->setId($id);

    $idperson = $person->getId();    

    $return = $response->withJson(['personid' => "$idperson"], 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

/**
 * Fake Register
 */

$app->get('/test/register', function (Request $request, Response $response) use ($app) {

    $user = array(
        "firstName" => "Jonh",
        "lastName" => "Doe",
        "email" => "jonhdoe@test.com"
    );

    $return = $response->withJson($user, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->get('/test/register/error', function (Request $request, Response $response) use ($app) {

    $res = array(
        "msg"=> "An error occurred",
        "error" => true
    );
    

    $return = $response->withJson($res, 404)
        ->withHeader('Content-type', 'application/json');
    return $return;
});



/**
 * Deleta o livro informado pelo ID
 */

$app->delete('/book/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');    
    $return = $response->withJson(['msg' => "Deletando o livro {$id}"], 204)
        ->withHeader('Content-type', 'application/json');
    return $return;
});


$app->get('/token', function (Request $request, Response $response) use ($app) {

    $key = "example_key";
    $token = array(
        "iss" => "http://example.org",
        "aud" => "http://example.com",
        "iat" => 1356999524,
        "nbf" => 1357000000
    );

    /**
     * IMPORTANT:
     * You must specify supported algorithms for your application. See
     * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
     * for a list of spec-compliant algorithms.
     */
    $jwt = JWT::encode($token, $key);
    $decoded = JWT::decode($jwt, $key, array('HS256'));

    $return = $response->withJson($decoded, 200)
    ->withHeader('Content-type', 'application/json');
    
    return $return;
});
?>