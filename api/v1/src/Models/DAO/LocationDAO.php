<?php 

namespace App\Models\DAO;

class LocationDAO {


public function getLocationByIbgeCode($ibgecode){

	$sql = new SQLUtils();

		$results = $sql->select("
			SELECT c.id AS city_id, 
			       c.ibge_code, 
			       c.name     AS city_name, 
			       s.id       AS state_id, 
			       s.name    AS state_name, 
			       s.initials AS state_initials 
			FROM   tbl_cities c 
			       INNER JOIN tbl_states s 
			               ON c.id_state = s.id 
			WHERE  c.ibge_code = :ibgecode 
			",
			array(
				":ibgecode" => $ibgecode
			)
		);

		return $results[0];
}

public function getStates() {

	$sql = new SQLUtils();

		$results = $sql->select(
			"
			SELECT s.id         AS state_id, 
			       s.NAME       AS state_name, 
			       s.initials   AS state_initials, 
			       s.id_country AS country_state_id 
			FROM   tbl_states s 
			"
		);

	return $results;

}


public function getCitiesByState($id_state) {

	$sql = new SQLUtils();

		$results = $sql->select("
			SELECT c.id AS city_id, 
			       c.ibge_code, 
			       c.name AS city_name, 
			       c.id_state AS state_id
			FROM   tbl_cities c 

			WHERE  c.id_state = :id_state 
			",
			array(
				":id_state" => $id_state
			)
		);

	return $results;

}

}


?>
