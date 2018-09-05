<?php

namespace App\Models\DAO;


class BanksDAO {


public function getBanks(){

		$sql = new SQLUtils();

		$results = $sql->select(
			"SELECT * from tbl_banks"
		);

		return $results;
}

public function getAccountTypes(){

		$sql = new SQLUtils();

		$results = $sql->select(
			"SELECT * from tbl_account_type"
		);

		return $results;
}

public function addUserBankAccount($bankAccount){

	$sql = new SQLUtils();

		$results = $sql->select(
			"CALL sp_user_account_bank_save
				(:pid_bank,
				:pagency_number,
				:pagency_check_number,
				:paccount_number,
				:paccount_check_number,
				:pid_account_type,
				:pid_user)",
				array(
				":pid_bank"=>$bankAccount->getIdBank(),
				":pagency_number"=>$bankAccount->getAgencyNumber(),
				":pagency_check_number"=>$bankAccount->getAgencyCheckNumber(),
				":paccount_number"=>$bankAccount->getAccountNumber(),
				":paccount_check_number"=>$bankAccount->getAccountCheckNumber(),
				":pid_account_type"=>$bankAccount->getIdAccountType(),
				":pid_user"=>$bankAccount->getIdUser()
			)
		);

		$data = $results[0];

		$response["error"] = false;

		$response["msg"] = "Conta Bancária adicionada com sucesso!";

		$response["data"]["bank_account"] = $data;

		return $response;

}


}

 ?>
