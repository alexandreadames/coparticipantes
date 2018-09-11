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

public function getUserBankAccounts($id_user){
	$sql = new SQLUtils();

		$results = $sql->select(
			"SELECT b.name AS bank,
	       ba.agencyNumber,
	       ba.agencyCheckNumber,
	       ba.accountNumber,
	       ba.accountCheckNumber,
	       acc_type.description AS accountType
				FROM tbl_bankaccount ba
				INNER JOIN tbl_banks b ON ba.id_bank = b.id
				INNER JOIN tbl_account_type acc_type ON ba.id_account_type = acc_type.id
				WHERE id_user = :id_user",
				array(
				":id_user"=>$id_user
			)
		);

		return $results;
}


}

 ?>
