<?php
class ModelAccountVerification extends Model {
	public function getVerification($customer_id) {
	$query = $this->db->query(
             "SELECT * FROM " . DB_PREFIX . "verification WHERE customer_id = '".$customer_id."' "
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
        

	return $verification ; //$query->row;
	}	
	
        public function getVerifications($customer_id) {  
	$query = $this->db->query(
                "SELECT * FROM " . DB_PREFIX . "verification ".
                "WHERE customer_id = '". $customer_id . "'".
                " ORDER BY date_added DESC" 
                );
        $results = $query->rows; 
        
        $verifications = array();
        foreach ($results as $verification) 
            {
            $subquery = $this->db->query(
                " SELECT * FROM " . DB_PREFIX . "verification_doc ".
                " WHERE verification_id = '". $verification['verification_id'] . "'".
                " ORDER BY sort_order" 
                );
            
            $verifications[] = array(
                    'verification_id' => $verification['verification_id'],
                    'customer_id'         => $verification['customer_id'],
                    'description' => $verification['description'],
                    'date_added'         => $verification['date_added'],	
                    'status'         => $verification['status'],
                    'docs'             =>  $subquery->rows 
                    );
            }
        
	return $verifications;
	}            
        
        public function addVerificaiton($data) {
        $sqlQuery =  "INSERT INTO " . DB_PREFIX . "verification SET ".
                " customer_id = '" .$this->customer->getId() .
                "', description = '" . $this->db->escape($data['description']) .                    
                "', date_added = NOW()" ; 

        $this->db->query($sqlQuery);
        
        $verification_id = $this->db->getLastId();
        $order =  0;
        foreach ($data['docs'] as $doc)
            {
            $sql = "INSERT INTO " . DB_PREFIX . "verification_doc SET ".  
              " verification_id = '" .$verification_id .
              "', document = '" . $this->db->escape($doc) .                    
              "', sort_order = " . $order++ . "" ; 
            
             $this->db->query($sql);
            }
	}
        
        public function editVerificaiton($customer_id, $data) {
        
        $sqlQuery =  "UPDATE " . DB_PREFIX . "verification SET ".
                " description = '" . $this->db->escape($data['description']) .                    
                "', date_added = NOW() ".
                " WHERE customer_id = '" . (int)$customer_id . "'"; 
                
        $this->db->query($sqlQuery);
        
         
        $verification_id = $this->db->getLastId();
        $order =  0;
        
        foreach ($data['docs'] as $doc)
            {
            $sql = "INSERT INTO " . DB_PREFIX . "verification_doc SET ".  
              " verification_id = '" .$verification_id .
              "', document = '" . $this->db->escape($doc) .                    
              "', sort_order = " . $order++ . "" ; 
            
             $this->db->query($sql);
            }
        
	}  
        
        
        public function getVerificationTotal($customer_id) {
        $query = $this->db->query(
                "SELECT  COUNT(DISTINCT verification_id) AS total  FROM " . DB_PREFIX . "verification WHERE customer_id = '".$customer_id."' "
                );
        
		return $query->row['total'];
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