<?php
class ModelCatalogFreightOffer extends Model {
    
    
        public function getTotalCustomerOffersAll($data = array()) { 
		$sql =  " SELECT COUNT(fo.freight_offer_id) AS total";
                        

                $sql .= " FROM " . DB_PREFIX . "freight_offer fo " ;   
                $sql .= " INNER JOIN " . DB_PREFIX . "customer from_c ON (fo.customer_id = from_c.customer_id) ";
                $sql .= " INNER JOIN " . DB_PREFIX . "freight f ON (fo.freight_id = f.freight_id) ";
                $sql .= " INNER JOIN " . DB_PREFIX . "customer owner_c ON (f.customer_id = owner_c.customer_id) ";
                 

              	$query = $this->db->query($sql);
		return $query->row['total']; 
	}
        
       public function getCustomerOffersAll($data = array()) { 
		
                $sql =  " SELECT fo.*, fo.date_added AS offer_date , f.* , ";
                        
                $sql .= " from_c.customer_id AS offerer_id , ";
                $sql .= " CONCAT(from_c.firstname,' ', from_c.lastname) AS offerer_name , ";
                $sql .= " from_c.company AS offerer_company , ";
                       
                $sql .= " owner_c.customer_id AS owner_id , ";
                $sql .= " CONCAT(owner_c.firstname,' ', owner_c.lastname) AS owner_name , ";
                $sql .= " owner_c.company AS owner_company ";
                       
                       
                $sql .= " FROM " . DB_PREFIX . "freight_offer fo " ;   
                $sql .= " INNER JOIN " . DB_PREFIX . "customer from_c ON (fo.customer_id = from_c.customer_id) ";
                $sql .= " INNER JOIN " . DB_PREFIX . "freight f ON (fo.freight_id = f.freight_id) ";
                $sql .= " INNER JOIN " . DB_PREFIX . "customer owner_c ON (f.customer_id = owner_c.customer_id) ";
                 
                
                $sort_data = array(
			'fo.price',
                        'fo.date_added',
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	                      
		} else {               
			$sql .= " ORDER BY fo.date_added ";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC ";
		} else {
			$sql .= " ASC ";
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
             
    	public function updateViewed($product_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
	}
        
	public function add($data) {
            $sqlQuery =  "INSERT INTO " . DB_PREFIX . "freight_offer SET ".
                    " customer_id = '" . (int)$data['customer_id'] .                                    
                    "', freight_id = '" . (int)$data['freight_id'] . 
                    "', price = '" . (double)$data['price'] . 
                    "', date_added = NOW()" ; 
            
		$this->db->query($sqlQuery);
	}
        
        public function editShown($data) {   
            
                $sql =  " UPDATE " . DB_PREFIX . "freight_offer fo " ; 
                $sql .= " INNER JOIN " . DB_PREFIX . "freight f " ; 
                $sql .= " ON f.freight_id = fo.freight_id " ;  
                $sql .= " INNER JOIN " . DB_PREFIX . "customer c " ; 
                $sql .= " ON fo.customer_id = c.customer_id " ;
                
                $sql .= " SET fo.shown = 1 " ;
                
                $implode = array();
                if ( isset($data['customer_id'])  && $data['customer_id'] != NULL )
                    {
                    $implode[] =  " f.customer_id = ". (int)$data['customer_id'] . " " ; 
                    }  
                 if ( isset($data['freight_id'])  && $data['freight_id'] != NULL )
                    {
                    $implode[] =  " fo.freight_id = ". (int)$data['freight_id'] . " " ; 
                    }
                 if ( isset($data['shown'])  && $data['shown'] != NULL )
                    {
                    $implode[] =  " fo.shown = ". (int)$data['shown'] . " " ; 
                    }     
                    
                if ($implode) {
			$sql .= " WHERE ( " . implode(" AND ", $implode) . " ) ";
		}   

                //echo $sql;
              	$query = $this->db->query($sql); 
	}

        public function getCustomerOffers($customer_id,$freight_id) { 
		$sql = "SELECT * FROM " . DB_PREFIX . "freight_offer WHERE customer_id = ". (int)$customer_id ;                
                if ($freight_id != null) $sql .= " AND freight_id = " . (int)$freight_id ; 
		$sql .= " order by date_added ";
                
              	$query = $this->db->query($sql);
		return $query->rows;
	}
        
        public function getCustomerOffersDetailed($customer_id,$freight_id = NULL) { 
		$sql =  " SELECT *, fo.date_added AS fo_date FROM " . DB_PREFIX . "freight_offer fo " ; 
                $sql .= "INNER JOIN " . DB_PREFIX . "freight f " ; 
                $sql .= " ON f.freight_id = fo.freight_id " ;  
                $sql .= " WHERE fo.customer_id = ". (int)$customer_id ;    
		$sql .= " order by fo.date_added ";
                
                //echo $sql;
              	$query = $this->db->query($sql);
		return $query->rows;
	}
        
        public function getCustomerOffersReceivedDetailed($data) { 
		
                $sql =  " SELECT *, fo.date_added AS fo_date FROM " . DB_PREFIX . "freight_offer fo " ; 
                $sql .= " INNER JOIN " . DB_PREFIX . "freight f " ; 
                $sql .= " ON f.freight_id = fo.freight_id " ;  
                $sql .= " INNER JOIN " . DB_PREFIX . "customer c " ; 
                $sql .= " ON fo.customer_id = c.customer_id " ;
                
                
                $implode = array();
                
                
                if ( isset($data['customer_id'])  && $data['customer_id'] != NULL )
                    {
                    $implode[] =  " f.customer_id = ". (int)$data['customer_id'] . " " ; 
                   // $sql .= " WHERE f.customer_id = ". (int)$customer_id ; 
                    }
                    
                 if ( isset($data['freight_id'])  && $data['freight_id'] != NULL )
                    {
                    $implode[] =  " fo.freight_id = ". (int)$data['freight_id'] . " " ; 
                   // $sql .= " WHERE f.customer_id = ". (int)$customer_id ; 
                    }
                    
                    
                if ($implode) {
			$sql .= " WHERE ( " . implode(" AND ", $implode) . " ) ";
		}   
                
		$sql .= " ORDER BY fo.date_added ";
                
                //echo $sql;
              	$query = $this->db->query($sql);
		return $query->rows;
                
	}
        
        
        public function getTotalCustomerOffersReceivedDetailed($data) { 
	
                $sql =  " SELECT COUNT(*) AS total FROM " . DB_PREFIX . "freight_offer fo " ; 
                $sql .= " INNER JOIN " . DB_PREFIX . "freight f " ; 
                $sql .= " ON f.freight_id = fo.freight_id " ;  
                $sql .= " INNER JOIN " . DB_PREFIX . "customer c " ; 
                $sql .= " ON fo.customer_id = c.customer_id " ;
                
                
                $implode = array();
                
                
                if ( isset($data['customer_id'])  && $data['customer_id'] != NULL )
                    {
                    $implode[] =  " f.customer_id = ". (int)$data['customer_id'] . " " ; 
                    }  
                 if ( isset($data['freight_id'])  && $data['freight_id'] != NULL )
                    {
                    $implode[] =  " fo.freight_id = ". (int)$data['freight_id'] . " " ; 
                    }
                    
                 if ( isset($data['shown']) )
                    {
                    $implode[] =  " fo.shown = ". (int)$data['shown'] . " " ; 
                    }     
                    
                if ($implode) {
			$sql .= " WHERE ( " . implode(" AND ", $implode) . " ) ";
		}   
                
		$sql .= " ORDER BY fo.date_added ";
                
               // echo $sql;
              	$query = $this->db->query($sql);
		return $query->row['total'];
	}
        
         public function getTotalCustomerOffersDetailed($customer_id) { 
             
		$sql =  " SELECT COUNT(*) AS total FROM " . DB_PREFIX . "freight_offer fo " ; 
                $sql .= " INNER JOIN " . DB_PREFIX . "freight f " ; 
                $sql .= " ON f.freight_id = fo.freight_id " ;  
                $sql .= " WHERE fo.customer_id = ". (int)$customer_id ;    
		$sql .= " order by fo.date_added ";
                
              	$query = $this->db->query($sql);
		return $query->row['total'];
	}
        
     
	public function deleteFreightOffer($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "freight_offer WHERE freight_offer_id = '" . (int)$product_id . "'");
		//$this->cache->delete('product');
	}
	
	
}
?>
