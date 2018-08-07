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


}

 ?>