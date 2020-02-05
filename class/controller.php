<?php

class controller extends Db{

	//Adding of drug
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

	//Get all drugs
	public function getAllDrug(){
		$query = "SELECT * FROM core3_pharmacy_drugs ORDER BY drug_id DESC";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	// Viewing of Drug
	public function getDrugById($id){
		$query = "SELECT * FROM core3_pharmacy_drugs WHERE drug_id = ? ORDER BY drug_id DESC";
		$stmt = $this->connect()->prepare($query);
		$stmt->bindParam(1,$id);
		$stmt->execute();
		return $stmt;
	}
    
    //Add Stocks
    public function addStock($drugId,$quantity,$exirationDate){
    	$query = "INSERT INTO core3_pharmacy_drug_stocks VALUES (null,?,?,NOW(),?);";
    	$stmt = $this->connect()->prepare($query);
		$stmt->bindParam(1,$drugId);
		$stmt->bindParam(2,$quantity);
		$stmt->bindParam(3,$expirationDate);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }

    //Get all stocks;
    public function getStocks($drugId){
    	$query = "SELECT * FROM core3_pharmacy_drug_stocks WHERE drug_id = ? ORDER BY drug_id DESC";
		$stmt = $this->connect()->prepare($query);
		$stmt->bindParam(1,$drugId);
		$stmt->execute();
		return $stmt;
    }

    public function getItems($drugIds,$quantities,$cash,$amounts){
    	$transNo = null;
		$total = 0;
		$query = "SELECT transactionNo FROM core3_pharmacy_drug_transaction ORDER BY transactionNo DESC LIMIT 1";
		$pst = $this->connect()->prepare($query);
		$pst->execute();
		if($row = $pst->fetch()){
			$year = intval(date("Y"));
			$transNo = $row['transactionNo'] + 1;
			if($transNo < substr($year, -2) * 100000 + 10001){
				$transNo = substr($year, -2) * 100000 + 10001;
			}
		}else{
			$year = intval(date("Y"));
			$transNo = substr($year, -2) * 100000 + 10001;
		}

		for ($i=0; $i < count($quantities); $i++) { 
				$total += $amounts[$i];
				$sql = "INSERT INTO core3_pharmacy_drug_transaction VALUES (null,?,?,?,NOW(),?)";
				$stmt = $this->connect()->prepare($sql);
				$stmt->bindParam(1,$drugIds[$i]);
				$stmt->bindParam(2,$quantities[$i]);
				$stmt->bindParam(3,$amounts[$i]);
				$stmt->bindParam(4,$transNo);
				$stmt->execute();
		}

		$query = "INSERT INTO core3_pharmacy_payment VALUES (null,?,?,NOW(),?)";
		$stmt = $this->connect()->prepare($query);
		$stmt->bindParam(1,$total);
		$stmt->bindParam(2,$cash);
		$stmt->bindParam(3,$transNo);
		$stmt->execute();
		return $transNo;
    }


}