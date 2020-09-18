<?php
class ModelAccountInterestCountries extends Model {
    
	public function addInterestCountries($customer_id, $data) {
            
           if ( isset($data['countries']) )
            foreach ( $data['countries'] as $country_id ) {
                
                  $this->db->query(
                          "INSERT INTO " . DB_PREFIX . "customer_interest_countries ".
                          " SET customer_id = '" . (int)$customer_id . 
                          "', country_id = '" . (int)$country_id . "' " );
		} 
     
	}
	
	public function editInterestCountries($customer_id, $data) {
       
            /*foreach ( $data['countries'] as $country_id ) {
             $this->deleteInterestCountry($customer_id,$country_id); 
             } */
            
             $this->deleteInterestCountries($customer_id);
             $this->addInterestCountries($customer_id,$data);

	}
	
	public function deleteInterestCountry( $customer_id , $country_id ) {
            $this->db->query(
                "DELETE FROM " . DB_PREFIX . "customer_interest_countries WHERE customer_id = '" . (int)$customer_id . "' AND country_id = '" . (int)$country_id . "'");
	}	
	
        public function deleteInterestCountries( $customer_id ) {
            $this->db->query(
                " DELETE FROM " . DB_PREFIX . "customer_interest_countries WHERE customer_id = '" . (int)$customer_id . "' ");
	}
        
        public function getInterestCountries($customer_id) {

		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "country c ".
                        "INNER JOIN ". DB_PREFIX . "customer_interest_countries cic ".
                        "ON cic.country_id = c.country_id ".
                        " WHERE cic.customer_id = '" . (int)$customer_id . "'");
                
			return $query->rows;	
            }
        
 
	
	public function getAddresses() {
		$address_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$this->customer->getId() . "'");
	
		foreach ($query->rows as $result) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$result['country_id'] . "'");
			
			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';	
				$address_format = '';
			}
			
			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$result['zone_id'] . "'");
			
			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}		
		
			$address_data[$result['address_id']] = array(
				'address_id'     => $result['address_id'],
				'firstname'      => $result['firstname'],
				'lastname'       => $result['lastname'],
				'company'        => $result['company'],
				'company_id'     => $result['company_id'],
				'tax_id'         => $result['tax_id'],				
				'address_1'      => $result['address_1'],
				'address_2'      => $result['address_2'],
				'postcode'       => $result['postcode'],
				'city'           => $result['city'],
				'zone_id'        => $result['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $result['country_id'],
				'country'        => $country,	
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
                                'customer_id'      => $result['customer_id'],
                                'warehouse'             => $result['warehouse'],
                                'squaremeters'          => $result['squaremeters'],
                                "wh_height"             => $result['wh_height'] , 
                                "wh_ramp_number"        => $result['wh_ramp_number'] ,
                                "wh_industrial_floor"   => $result['wh_industrial_floor'] , 
                                "wh_firefighting"       => $result['wh_firefighting'] , 
                                "lat"                   => $result['lat'] ,
                                "lng"                   => $result['lng'] , 
                                "telephone"             => $result['telephone']
			);
		}		
		
		return $address_data;
	}	
	        
	public function getTotalAddresses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$this->customer->getId() . "'");
	
		return $query->row['total'];
	}
        
        public function getWarehouses() {
		$address_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$this->customer->getId() . "' AND warehouse = '1' ");
	
		foreach ($query->rows as $result) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$result['country_id'] . "'");
			
			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';	
				$address_format = '';
			}
			
			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$result['zone_id'] . "'");
			
			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}		
		
			$address_data[$result['address_id']] = array(
				'address_id'     => $result['address_id'],
				'firstname'      => $result['firstname'],
				'lastname'       => $result['lastname'],
				'company'        => $result['company'],
				'company_id'     => $result['company_id'],
				'tax_id'         => $result['tax_id'],				
				'address_1'      => $result['address_1'],
				'address_2'      => $result['address_2'],
				'postcode'       => $result['postcode'],
				'city'           => $result['city'],
				'zone_id'        => $result['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $result['country_id'],
				'country'        => $country,	
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
                                
                                'warehouse'             => $result['warehouse'],
                                'squaremeters'          => $result['squaremeters'],
                                "wh_height"             => $result['wh_height'] , 
                                "wh_ramp_number"        => $result['wh_ramp_number'] ,
                                "wh_industrial_floor"   => $result['wh_industrial_floor'] , 
                                "wh_firefighting"       => $result['wh_firefighting'] , 
                                "lat"                   => $result['lat'] ,
                                "lng"                   => $result['lng'] ,
                                "telephone"             => $result['telephone']
			);
		}		
		
		return $address_data;
	}
      
        public function getTotalWarehouses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$this->customer->getId() . "' AND warehouse = '1' ");
	
		return $query->row['total'];
	}
        
        public function getWarehousesAll($data = array()) {
		$address_data = array();
		$sql = "SELECT * FROM " . DB_PREFIX . "address WHERE  warehouse = '1' ";
                
                if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
                        
                if ( !empty($data['country_id'] ) && $data['country_id'] != "" ) {
                        $sql .= " AND  country_id = '" . $data['country_id'] . "' " ;
		} 
                

                        
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
                

                
		$query = $this->db->query($sql);
	
		foreach ($query->rows as $result) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$result['country_id'] . "'");
			
			if ($country_query->num_rows) {
                                $country_image = strtolower( $country_query->row['iso_code_2'].".png" );
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';	
				$address_format = '';
                                $country_image = '';
			}
			
			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$result['zone_id'] . "'");
			
			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}		
		
			$address_data[$result['address_id']] = array(
				'address_id'     => $result['address_id'],
				'firstname'      => $result['firstname'],
				'lastname'       => $result['lastname'],
				'company'        => $result['company'],
				'company_id'     => $result['company_id'],
				'tax_id'         => $result['tax_id'],				
				'address_1'      => $result['address_1'],
				'address_2'      => $result['address_2'],
				'postcode'       => $result['postcode'],
				'city'           => $result['city'],
				'zone_id'        => $result['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $result['country_id'],
				'country'        => $country,	
                                'country_image'  => $country_image,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
                                'customer_id'    =>      $result['customer_id'],
                                'warehouse'             => $result['warehouse'],
                                'squaremeters'          => $result['squaremeters'],
                                "wh_height"             => $result['wh_height'] , 
                                "wh_ramp_number"        => $result['wh_ramp_number'] ,
                                "wh_industrial_floor"   => $result['wh_industrial_floor'] , 
                                "wh_firefighting"       => $result['wh_firefighting'] , 
                                "lat"                   => $result['lat'] ,
                                "lng"                   => $result['lng'] ,
                                "telephone"             => $result['telephone']
			);
		}		
		
		return $address_data;
	}
      
        public function getTotalWarehousesAll($data = array()) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE warehouse = '1' ");
	
		return $query->row['total'];
	}
        
        public function getAddressByCustomer($customer_id) {
               
		$address_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "' ");
               // echo "SELECT DISTINCT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "' ";
               //echo  $address_query->rows;
               // return $address_query->rows;
                
                
		if ($address_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$address_query->row['country_id'] . "'");
			
			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';	
				$address_format = '';
			}
			
			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'");
			
			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}		

                            $address_data = array(
                                    'address_id'     => $address_query->rows[0]['address_id'],
                                    'firstname'      => $address_query->rows[0]['firstname'],
                                    'lastname'       => $address_query->rows[0]['lastname'],
                                    'company'        => $address_query->rows[0]['company'],
                                    'company_id'     => $address_query->rows[0]['company_id'],
                                    'tax_id'         => $address_query->rows[0]['tax_id'],				
                                    'address_1'      => $address_query->rows[0]['address_1'],
                                    'address_2'      => $address_query->rows[0]['address_2'],
                                    'postcode'       => $address_query->rows[0]['postcode'],
                                    'city'           => $address_query->rows[0]['city'],
                                    'zone_id'        => $address_query->rows[0]['zone_id'],
                                    'zone'           => $zone,
                                    'zone_code'      => $zone_code,
                                    'country_id'     => $address_query->rows[0]['country_id'],
                                    'country'        => $country,	
                                    'iso_code_2'     => $iso_code_2,
                                    'iso_code_3'     => $iso_code_3,
                                    'address_format' => $address_format,
                                    'customer_id'      => $address_query->rows[0]['customer_id'],
                                    'warehouse'             => $address_query->rows[0]['warehouse'],
                                    'squaremeters'          => $address_query->rows[0]['squaremeters'],
                                    "wh_height"             => $address_query->rows[0]['wh_height'] , 
                                    "wh_ramp_number"        => $address_query->rows[0]['wh_ramp_number'] ,
                                    "wh_industrial_floor"   => $address_query->rows[0]['wh_industrial_floor'] , 
                                    "wh_firefighting"       => $address_query->rows[0]['wh_firefighting'] , 
                                    "lat"                   => $address_query->rows[0]['lat'] ,
                                    "lng"                   => $address_query->rows[0]['lng'] ,
                                     "telephone"             => $address_query->row['telephone']
                                    );
      
			return $address_data;
		} else {
			return false;	
		} 
	}
        
        
        public function getAddressAll($address_id) {
               
		$address_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "' ");
               // echo "SELECT DISTINCT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "' ";
               //echo  $address_query->rows;
               // return $address_query->rows;
                
                
		if ($address_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$address_query->row['country_id'] . "'");
			
			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';	
				$address_format = '';
			}
			
			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'");
			
			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}		

                            $address_data = array(
                                    'address_id'     => $address_query->rows[0]['address_id'],
                                    'firstname'      => $address_query->rows[0]['firstname'],
                                    'lastname'       => $address_query->rows[0]['lastname'],
                                    'company'        => $address_query->rows[0]['company'],
                                    'company_id'     => $address_query->rows[0]['company_id'],
                                    'tax_id'         => $address_query->rows[0]['tax_id'],				
                                    'address_1'      => $address_query->rows[0]['address_1'],
                                    'address_2'      => $address_query->rows[0]['address_2'],
                                    'postcode'       => $address_query->rows[0]['postcode'],
                                    'city'           => $address_query->rows[0]['city'],
                                    'zone_id'        => $address_query->rows[0]['zone_id'],
                                    'zone'           => $zone,
                                    'zone_code'      => $zone_code,
                                    'country_id'     => $address_query->rows[0]['country_id'],
                                    'country'        => $country,	
                                    'iso_code_2'     => $iso_code_2,
                                    'iso_code_3'     => $iso_code_3,
                                    'address_format' => $address_format,
                                    'customer_id'      => $address_query->rows[0]['customer_id'],
                                    'warehouse'             => $address_query->rows[0]['warehouse'],
                                    'squaremeters'          => $address_query->rows[0]['squaremeters'],
                                    "wh_height"             => $address_query->rows[0]['wh_height'] , 
                                    "wh_ramp_number"        => $address_query->rows[0]['wh_ramp_number'] ,
                                    "wh_industrial_floor"   => $address_query->rows[0]['wh_industrial_floor'] , 
                                    "wh_firefighting"       => $address_query->rows[0]['wh_firefighting'] , 
                                    "lat"                   => $address_query->rows[0]['lat'] ,
                                    "lng"                   => $address_query->rows[0]['lng'] ,
                                    "telephone"             => $address_query->row['telephone']
                                    );
      
			return $address_data;
		} else {
			return false;	
		} 
	}
}

?>