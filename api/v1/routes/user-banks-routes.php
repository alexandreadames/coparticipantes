<?php

/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Entities
 */
use \App\Models\DAO\BanksDAO;


/**
 * Pega uma lista de bancos
 */
$app->get('/secure/banks', function (Request $request, Response $response) use ($app) {

        $banksDAO = new BanksDAO();

        $result = $banksDAO->getBanks();

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});

?>