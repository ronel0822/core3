<?php

class controller extends Db{

	public function addDrug($name,$type,$description,$price){
		$query = "INSERT INTO core3_pharmacy_drugs VALUES (null,?,?,?,?,NOW())";
		$stmt = $this->connect()->prepare($query);
		$stmt->bindParam(1,$name);
		$stmt->bindParam(2,$price);
		$stmt->bindParam(3,$type);
		$stmt->bindParam(4,$description);
		$stmt->execute();
		return $stmt;
	}

	public function getAllDrug(){
		$query = "SELECT * FROM core3_pharmacy_drugs ORDER BY drug_id DESC";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function getDrugById($id){
		$query = "SELECT * FROM core3_pharmacy_drugs WHERE drug_id = ? ORDER BY drug_id DESC";
		$stmt = $this->connect()->prepare($query);
		$stmt->bindParam(1,$id);
		$stmt->execute();
		return $stmt;
	}
    
}