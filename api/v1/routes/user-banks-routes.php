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
use \App\Models\Entity\BankAccount;


/**
 * Utils
 */
use \App\Models\Utils\TokenUtils;

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

/**
 * Insert a user account bank
 */
$app->post('/secure/user/bankaccount', function (Request $request, Response $response) use ($app) {

        $params = (object) $request->getParams();

        $decoded_token = TokenUtils::decodeToken($request);

        $banksDAO = new BanksDAO();

        $bankAccount = new BankAccount();

        $bankAccount->setIdBank($params->id_bank);
        $bankAccount->setAgencyNumber($params->agencyNumber);
        $bankAccount->setAgencyCheckNumber($params->agencyCheckNumber);
        $bankAccount->setAccountNumber($params->accountNumber);
        $bankAccount->setAccountCheckNumber($params->accountCheckNumber);
        $bankAccount->setIdAccountType($params->id_account_type);
        $bankAccount->setIdUser((int) $decoded_token["userId"]);

        $result = $banksDAO->addUserBankAccount($bankAccount);

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});


?>
