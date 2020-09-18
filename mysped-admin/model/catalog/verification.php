<?php
class ModelCatalogVerification extends Model {
	public function getVerificationByCustomer($customer_id) {
	$query = $this->db->query(
             "SELECT * FROM " . DB_PREFIX . "verification WHERE customer_id = '".$customer_id."' "
             );
        
	return $query->row;
	}	

        public function getVerification($verification_id) {
	$query = $this->db->query(
             "SELECT * FROM " . DB_PREFIX . "verification WHERE verification_id = '".$verification_id."' "
             );
        
        
        $result = $query->row ; 
           $subquery = $this->db->query(
                " SELECT * FROM " . DB_PREFIX . "verification_doc ".
                " WHERE verification_id = '". $result['verification_id'] . "'".
                " ORDER BY sort_order" 
                );
            
            $verification = array(
                    'verification_id' => $result['verification_id'],
                    'customer_id'         => $result['customer_id'],
                    'description' => $result['description'],
                    'date_added'         => $result['date_added'],	
                    'status'         => $result['status'],
                    'docs'          =>  $subquery->rows
                    );
        

	return $verification ; 
        
        
        
	//return $query->row;
	}
        
        public function getVerifications() {  
	$query = $this->db->query(
                "SELECT * FROM " . DB_PREFIX . "verification ORDER BY date_added DESC" 
                );
	
		return $query->rows;     
	} 
        
        public function getTotalVerifications() {  
	$query = $this->db->query(
                "SELECT COUNT(verification_id) AS total FROM " . DB_PREFIX . "verification ORDER BY date_added" 
                );
        
		return $query->row['total'];  
	}    
        
        
        public function addVerificaiton($data) {
        $sqlQuery =  "INSERT INTO " . DB_PREFIX . "verification SET ".
                " customer_id = '" .$this->customer->getId() .
                "', description = '" . $this->db->escape($data['description']) .                    
                "', date_added = NOW()" ; 

        $this->db->query($sqlQuery);
	}
        
        public function editVerificaiton($customer_id, $data) {
        $sqlQuery =  "UPDATE " . DB_PREFIX . "verification SET ".
                " description = '" . $this->db->escape($data['description']) .                    
                "', date_added = NOW() ".
                " WHERE customer_id = '" . (int)$customer_id . "'"; 
                
        $this->db->query($sqlQuery);
	}  
        
        
        public function getVerificationTotal($customer_id) {
        $query = $this->db->query(
                "SELECT  COUNT(DISTINCT verification_id) AS total  FROM " . DB_PREFIX . "verification WHERE customer_id = '".$customer_id."' "
                );
        
		return $query->row['total'];
	}
        
        
        public function deleteVerification($verification_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "verification WHERE verification_id = '" . (int)$verification_id . "'");
              //  echo "DELETE FROM " . DB_PREFIX . "verification WHERE verification_id = '" . (int)$verification_id . "'";
	}
        
        
        
        /*
         * 0 Not required
         * 1 Failed
         * 2 Pending
         * 3 Verified
         * 4 Trusted
         */
        public function editCustomerStatus($customer_id) {
        $sqlQuery =  "UPDATE " . DB_PREFIX . "customer SET ".
                " verified = '2' " .                 //2 = Pending
                " WHERE customer_id = '" . (int)$customer_id . "'"; 
                
        $this->db->query($sqlQuery);
	}
        
        public function getCustomerStatus($customer_id) {
        $sqlQuery =  " SELECT DISTINCT verified FROM " . DB_PREFIX . "customer ".
                " WHERE customer_id = '" . (int)$customer_id . "' "; 
                
        $query = $this->db->query($sqlQuery);
        
        return $query->row['verified'];
	}
        
        
}
?>