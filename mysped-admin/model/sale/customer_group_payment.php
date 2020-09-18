<?php
class ModelSaleCustomerGroupPayment extends Model {
    
	public function addCustomerGroupPayment($data) {
            
		$this->db->query(
                        " INSERT INTO " . DB_PREFIX . "customer_group_payment SET ". 
                        " customer_group_id = '" . (int)$data['customer_group_id'] . 
                        "', customer_id = '" . (int)$data['customer_id'] . 
                        "', price = '" . (float)$data['price'] . 
                       // "', date_success = '" . $data['date_success'] . 
                        "', description = '" . (int)$data['description'] . 
                        "', date_inserted =  NOW() "
                        );
	}
	
	public function editCustomerGroupPayment($customer_group_payment_id, $data) {
		$this->db->query(
                        
                        "UPDATE " . DB_PREFIX . "customer_group_payment SET ".
                        " customer_group_id = '" . (int)$data['customer_group_id'] . 
                        "', customer_id = '" . (int)$data['customer_id'] . 
                        "', price = '" . (float)$data['price'] . 
                       // "', date_success = '" . $data['date_success'] . 
                        "', description = '" . (int)$data['description'] . 
                        "' WHERE customer_group_payment_id = '" . (int)$customer_group_payment_id . "'"
                        
                        );		
	}
	
        
        public function changeStatus($customer_group_payment_id, $status) {
		$this->db->query(
                        "UPDATE " . DB_PREFIX . "customer_group_payment SET ".
                        " status = '" . (int)$status . 
                        "' WHERE customer_group_payment_id = '" . (int)$customer_group_payment_id . "'"
                        );		
	}
        
        
	public function deleteCustomerGroupPayment($customer_group_payment_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_group_payment WHERE customer_group_payment_id = '" . (int)$customer_group_payment_id . "'");		
	}
	
        
	public function getCustomerGroupPayment($customer_group_payment_id) {
		$query = $this->db->query(                 
                        "SELECT DISTINCT * FROM " . DB_PREFIX . "customer_group_payment WHERE customer_group_payment_id = '". $customer_group_payment_id ."'"
                        );
		
		return $query->row;
	}
	
	public function getCustomerGroupPayments( $data = array() ) {
                $implode = array();
                
                $sql =  "SELECT  * , cgp.status AS status FROM " . DB_PREFIX . "customer_group_payment cgp ".
                        " INNER JOIN ". DB_PREFIX . "customer c ".
                        " ON c.customer_id = cgp.customer_id ";
                
                
                if (!empty($data['filter_email'])) {
			$implode[] = " c.email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
                
                if (  isset($data['filter_status']) && !is_null($data['filter_status'])  ) {
			$implode[] = " cgp.status LIKE '%" . $this->db->escape($data['filter_status']) . "%'";
		}
                
                if (!empty($data['filter_date_added'])) {
			$implode[] = " DATE(cgp.date_inserted) = DATE('" . $this->db->escape($data['filter_date_added']) . "') ";
		}
                
                if ($implode) {
			$sql .= " WHERE ". implode(" AND ", $implode);
		}
                
		$sort_data = array(
			'date_inserted'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY date_inserted";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
        public function getTotalCustomerGroupPayments( $data = array() ) {
               // $sql =  "SELECT COUNT(*) AS total  FROM " . DB_PREFIX . "customer_group_payment ";
                $implode = array();
                
                $sql =  "SELECT  COUNT(*) AS total  FROM " . DB_PREFIX . "customer_group_payment cgp ".
                        " INNER JOIN ". DB_PREFIX . "customer c ".
                        " ON c.customer_id = cgp.customer_id ";
                   
                if (!empty($data['filter_email'])) {
			$implode[] = " c.email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
                
                if (  isset($data['filter_status']) && !is_null($data['filter_status'])  ) {
			$implode[] = " cgp.status LIKE '%" . $this->db->escape($data['filter_status']) . "%'";
		}
                
                if (!empty($data['filter_date_added'])) {
			$implode[] = " DATE(cgp.date_inserted) = DATE('" . $this->db->escape($data['filter_date_added']) . "') ";
		}
                
                if ($implode) {
			$sql .= " WHERE ". implode(" AND ", $implode);
		}
                
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
        
        public function ipnReceived($customer_group_payment_id) {
		$this->db->query(
                        "UPDATE " . DB_PREFIX . "customer_group_payment SET ".
                        " ipn_received = '1' ," .
                        " date_ipn =  NOW() ".
                        " WHERE customer_group_payment_id = '" . (int)$customer_group_payment_id . "'"
                        );
	}
        
        public function cancelReceived($customer_group_payment_id) {
		$this->db->query(
                        "UPDATE " . DB_PREFIX . "customer_group_payment SET ".
                        " cancel_received = '1' ," .
                        " date_cancel =  NOW() ".
                        " WHERE customer_group_payment_id = '" . (int)$customer_group_payment_id . "'"
                        );
	}
        
        public function successReceived($customer_group_payment_id) {
		$this->db->query(
                        "UPDATE " . DB_PREFIX . "customer_group_payment SET ".
                        " success_received = '1' ," .
                        " date_success =  NOW() ".
                        " WHERE customer_group_payment_id = '" . (int)$customer_group_payment_id . "'"
                        );
	}
        
      /*  public function getPayedCustomerGroups($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "customer_group cg LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'".
                       
                        " AND cg.registration_price != 0";
                        
		$sort_data = array(
			'cgd.name',
			'cg.sort_order'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY cg.sort_order";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
		$query = $this->db->query($sql);
		
		return $query->rows;
	} */
        
        
	/*public function getCustomerGroupDescriptions($customer_group_id) {
		$customer_group_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_group_description WHERE customer_group_id = '" . (int)$customer_group_id . "'");
				
		foreach ($query->rows as $result) {
			$customer_group_data[$result['language_id']] = array(
				'name'        => $result['name'],
				'description' => $result['description']
			);
		}
		
		return $customer_group_data;
	} */
		
	/*public function getTotalCustomerGroups() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_group");
		
		return $query->row['total'];
	}
        
        public function getCustomerGroupByCustomerId($customer_id) {
		$query = $this->db->query(
                        "SELECT DISTINCT * FROM " . DB_PREFIX . "customer_group cg ".       
                        " LEFT JOIN " . DB_PREFIX . "customer c ".
                        " ON (cg.customer_group_id = c.customer_group_id) ".
                        " WHERE c.customer_id = '" . (int)$customer_id . "' "
                      //  " AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'"
                        );
		
		return $query->row;
	} */
        
}
?>