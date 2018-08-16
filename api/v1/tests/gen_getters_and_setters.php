<?php

//Retirar tempo de execução da página, usar com cuidado...
set_time_limit(0);

const HOSTNAME = "127.0.0.1";
const USERNAME = "root";
const PASSWORD = "";
const DBNAME = "coparticipantesdb";

$conn = new PDO(
			"mysql:dbname=".DBNAME.";host=".HOSTNAME,
			USERNAME,
			PASSWORD
		);

function select($conn, $rawQuery){


	$stmt = $conn->prepare($rawQuery);

	$stmt->execute();

		if (!$stmt->execute()) {
    		return $stmt->errorInfo();
		}
		else{
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}
}

$query = "select * from tbl_bankaccount";


$entity_in_bd = select($conn, $query);

print_r($entity_in_bd);

$entity = $entity_in_bd[0];
$entity_fields = array();

foreach ($entity as $key => $value) {
	$entity_fields[] = $key;
}

//Getters
echo "//Getters";
foreach ($entity_fields as $variable) {
	/*
	 public function getId(){
        return $this->id;
    }
	*/
	echo "<br>
		public function get".ucwords($variable)."(){<br>
			return \$this->".$variable.";<br>
		}
		<br>"
	;
}

//Getters
echo "//Setters";
foreach ($entity_fields as $variable) {
	/*
	 public function setId($id){
        $this->id = $id;
    }
	*/
	echo "<br>
		public function set".ucwords($variable)."(\$$variable){<br>
			\$this->".$variable."=\$$variable;<br>
		}
		<br>"
	;
}



 ?>
