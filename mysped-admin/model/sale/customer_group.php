<?php
class ModelSaleCustomerGroup extends Model {
	public function addCustomerGroup($data) {
            
            $sql ="INSERT INTO " . DB_PREFIX . "customer_group ". 
                    " SET approval = '" . (int)$data['approval'] . 
                    "',  company_id_display = '" . (int)$data['company_id_display'] . 
                    "', company_id_required = '" . (int)$data['company_id_required'] . 
                    "', tax_id_display = '" . (int)$data['tax_id_display'] . 
                    "', tax_id_required = '" . (int)$data['tax_id_required'] . 
                    
                    "', priority_view = '" . (int)$data['priority_view'] . 
                    "', gift_program = '" . (int)$data['gift_program'] .
                    "', skype_assistance = '" . (int)$data['skype_assistance'] .
                    "', personal_agent = '" . (int)$data['personal_agent'] .
                    "', logo_preview = '" . (int)$data['logo_preview'] .
                    "', registration_price = '" . (int)$data['registration_price'] .
                    "', duration = '" . (int)$data['duration'] .
                    
                    "', photo_album_number = '" . (int)$data['photo_album_number'] .
                    "', products_number = '" . (int)$data['products_number'] .
                    "', freights_number = '" . (int)$data['freights_number'] .
                    "', trucks_number = '" . (int)$data['trucks_number'] .
                    "', show_views = '" . (int)$data['show_views'] .
                    "', warehouse_number = '" . (int)$data['warehouse_number'] .
                    
                     "', view_mail = '" . (int)$data['view_mail'] .
                     "', view_telephone = '" . (int)$data['view_telephone'] .
                     "', view_fax = '" . (int)$data['view_fax'] .
                     "', view_skype = '" . (int)$data['view_skype'] .
                     "', view_icq = '" . (int)$data['view_icq'] .
                     "', view_website = '" . (int)$data['view_website'] .
                     "', view_insertion_delay = '" . (int)$data['view_insertion_delay'] .
                     "', premium_design = '" . (int)$data['premium_design'] .
                     "', display_description = '" . (int)$data['display_description'] .
                    
                    "', sort_order = '" . (int)$data['sort_order'] . "'";           
            
		$this->db->query( $sql );
	
		$customer_group_id = $this->db->getLastId();
		
		foreach ($data['customer_group_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_group_description SET customer_group_id = '" . (int)$customer_group_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}	
	}
	
	public function editCustomerGroup($customer_group_id, $data) {
		
                $sql = "UPDATE " . DB_PREFIX . "customer_group SET " . 
                        " approval = '" . (int)$data['approval'] . 
                        "', company_id_display = '" . (int)$data['company_id_display'] . 
                        "', company_id_required = '" . (int)$data['company_id_required'] . 
                        "', tax_id_display = '" . (int)$data['tax_id_display'] . 
                        "', tax_id_required = '" . (int)$data['tax_id_required'] . 
                                         
                        "', priority_view = '" . (int)$data['priority_view'] . 
                        "', gift_program = '" . (int)$data['gift_program'] .
                        "', skype_assistance = '" . (int)$data['skype_assistance'] .
                        "', personal_agent = '" . (int)$data['personal_agent'] .
                        "', logo_preview = '" . (int)$data['logo_preview'] .           
                        "', registration_price = '" . (float)$data['registration_price'] .
                        "', duration = '" . (int)$data['duration'] .
                        "', sort_order = '" . (int)$data['sort_order'] . 
                        
                        "', photo_album_number = '" . (int)$data['photo_album_number'] .
                        "', products_number = '" . (int)$data['products_number'] .
                        "', freights_number = '" . (int)$data['freights_number'] .
                        "', trucks_number = '" . (int)$data['trucks_number'] .
                        "', show_views = '" . (int)$data['show_views'] .
                        "', warehouse_number = '" . (int)$data['warehouse_number'] .
                        
                        "', view_mail = '" . (int)$data['view_mail'] .
                        "', view_telephone = '" . (int)$data['view_telephone'] .
                        "', view_fax = '" . (int)$data['view_fax'] .
                        "', view_skype = '" . (int)$data['view_skype'] .
                        "', view_icq = '" . (int)$data['view_icq'] .
                        "', view_website = '" . (int)$data['view_website'] .
                        "', view_insertion_delay = '" . (int)$data['view_insertion_delay'] .
                        "', premium_design = '" . (int)$data['premium_design'] .
                        "', display_description = '" . (int)$data['display_description'] .
                        
                        "' WHERE customer_group_id = '" . (int)$customer_group_id . "'";
                        
                
                $this->db->query( $sql );
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_group_description WHERE customer_group_id = '" . (int)$customer_group_id . "'");

		foreach ($data['customer_group_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_group_description SET customer_group_id = '" . (int)$customer_group_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
	}
	
	public function deleteCustomerGroup($customer_group_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_group WHERE customer_group_id = '" . (int)$customer_group_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_group_description WHERE customer_group_id = '" . (int)$customer_group_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE customer_group_id = '" . (int)$customer_group_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE customer_group_id = '" . (int)$customer_group_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE customer_group_id = '" . (int)$customer_group_id . "'");
	}
	
	public function getCustomerGroup($customer_group_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer_group cg LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id) WHERE cg.customer_group_id = '" . (int)$customer_group_id . "' AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
	}
        
	/* public function getCustomerGroupByCustomerId($customer_id) {
		$query = $this->db->query(
                        "SELECT DISTINCT * FROM " . DB_PREFIX . "customer_group cg ".       
                        " LEFT JOIN " . DB_PREFIX . "customer c ".
                        " ON (cg.customer_group_id = c.customer_group_id) ".
                        " WHERE c.customer_id = '" . (int)$customer_id . "' "
                      //  " AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'"
                        );
		
		return $query->row;
	} */
        
	public function getCustomerGroups($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "customer_group cg LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		$sort_data = array(
			'cgd.name',
			'cg.sort_order'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY cgd.name";	
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
	}
	
	public function getCustomerGroupDescriptions($customer_group_id) {
		$customer_group_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_group_description WHERE customer_group_id = '" . (int)$customer_group_id . "'");
				
		foreach ($query->rows as $result) {
			$customer_group_data[$result['language_id']] = array(
				'name'        => $result['name'],
				'description' => $result['description']
			);
		}
		
		return $customer_group_data;
	}
		
	public function getTotalCustomerGroups() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_group");
		
		return $query->row['total'];
	}
}
?>