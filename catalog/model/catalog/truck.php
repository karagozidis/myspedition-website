<?php
class ModelCatalogTruck extends Model {
    
    	public function updateViewed($product_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
	}
        
	public function addProduct($data) {
            
                if( isset($data['adr']) ) $adr = 1; 
                    else $adr = 0;
                if( isset($data['tir']) ) $tir = 1; 
                    else $tir = 0;
                if( isset($data['cmr']) ) $cmr = 1; 
                    else $cmr = 0;
                if( isset($data['cemt']) ) $cemt = 1; 
                    else $cemt = 0;
                if( isset($data['lift']) ) $lift = 1; 
                    else $lift = 0;
                if( isset($data['manipulator']) ) $manipulator = 1; 
                    else $manipulator = 0;
                
                    $sqlQuery =  "INSERT INTO " . DB_PREFIX . "truck SET customer_id = '" . $this->db->escape($data['customer_id']) .
                            "',  loading_country_id = '" . $this->db->escape($data['loading_country_id']) . 
                            "', loading_city = '" . $this->db->escape($data['loading_city']) . 
                            "', offloading_country_id = '" . $this->db->escape($data['offloading_country_id']) .
                            "', offloading_city = '" . $this->db->escape($data['offloading_city']) . 
                            "', loading_date = '" . $this->db->escape($data['loading_date']) .
                            "', offloading_date = '" . $this->db->escape($data['offloading_date']) .
                            "', est_date = '" . $this->db->escape($data['est_date']) .
                          //  "', freight_type_id = '" . $this->db->escape($data['freight_type_id']) .
                            "', trailer_type_id = '" . (int)$data['trailer_type_id'] . 
                            "', freight_params = '" . (int)$data['freight_params'] . 
                            "', weight_tons = '" . (int)$data['weight_tons'] . 
                            "', pallets_no = '" . (int)$data['pallets_no'] .                     
                            "', loading_zone_id = '" . (int)$data['loading_zone_id'] . 
                            "', loading_zip = '" . (int)$data['loading_zip'] . 
                            "', offloading_zone_id = '" . (int)$data['offloading_zone_id'] . 
                            "', offloading_zip = '" . (int)$data['offloading_zip'] . 
                          //  "', freight_number = '" . (int)$data['freight_number'] . 
                            "', exchangeable = '" . (int)$data['exchangeable'] . 
                            "', stackable = '" . (int)$data['stackable'] . 
                            "', volume_unit = '" . (int)$data['volume_unit'] . 
                            "', number_of_trucks = '" . (int)$data['number_of_trucks'] .
                          //  "', volume_unit_type = '" . (int)$data['volume_unit_type'] . 
                            "', adr = '" . $adr . 
                            "', tir = '" . $tir . 
                            "', cmr = '" . $cmr . 
                            "', cemt = '" . $cemt .                                                                                   
                            "', lift = '" . $lift . 
                            "', manipulator = '" . $manipulator . 
               //          "', description = '" . (int)$data['description'] . 
                            "', frequency = '" . (int)$data['frequency'] . 
                    "', date_added = NOW()" ; 
            
		$this->db->query($sqlQuery);
		
		$product_id = $this->db->getLastId();
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "truck_description WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "truck_image WHERE product_id = '" . (int)$product_id . "'");
                
		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "truck_description SET ".
                                " product_id = '" . (int)$product_id . "', ".
                                " language_id = '" . (int)$language_id . "', ".
                              //  " name = '" . $this->db->escape($value['name']) . "', ".
                              //  " meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "',". 
                              //  " meta_description = '" . $this->db->escape($value['meta_description']) . "', ".
                                " description = '" . $this->db->escape($value['description']) . "' "
                              /*  " tag = '" . $this->db->escape($value['tag']) . "'"*/);
		}
		
		
		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "truck_image SET ".
                                        " product_id = '" . (int)$product_id . "', ".
                                        " image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', ".
                                        " sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}
			         
		$this->cache->delete('product');
                
                return $product_id;
	}
	
	public function editProduct($product_id, $data) {           
                
                if( isset($data['adr']) ) $adr = 1; 
                    else $adr = 0;
                if( isset($data['tir']) ) $tir = 1; 
                    else $tir = 0;
                if( isset($data['cmr']) ) $cmr = 1; 
                    else $cmr = 0;
                if( isset($data['cemt']) ) $cemt = 1; 
                    else $cemt = 0;
                if( isset($data['lift']) ) $lift = 1; 
                    else $lift = 0;
                if( isset($data['manipulator']) ) $manipulator = 1; 
                    else $manipulator = 0;
                
                 $sqlQuery = "UPDATE " . DB_PREFIX . "truck SET " .
                         
                   "  loading_country_id = '" . $this->db->escape($data['loading_country_id']) . 
                    "', loading_city = '" . $this->db->escape($data['loading_city']) . 
                    "', offloading_country_id = '" . $this->db->escape($data['offloading_country_id']) .
                    "', offloading_city = '" . $this->db->escape($data['offloading_city']) . 
                    "', loading_date = '" . $this->db->escape($data['loading_date']) .
                    "', offloading_date = '" . $this->db->escape($data['offloading_date']) .
                    "', est_date = '" . $this->db->escape($data['est_date']) .
                  //  "', freight_type_id = '" . $this->db->escape($data['freight_type_id']) .
                    "', trailer_type_id = '" . (int)$data['trailer_type_id'] . 
                    "', freight_params = '" . (int)$data['freight_params'] . 
                    "', weight_tons = '" . (int)$data['weight_tons'] . 
                    "', pallets_no = '" . (int)$data['pallets_no'] . 
                    
                            "', loading_zone_id = '" . (int)$data['loading_zone_id'] . 
                            "', loading_zip = '" . (int)$data['loading_zip'] . 
                            "', offloading_zone_id = '" . (int)$data['offloading_zone_id'] . 
                            "', offloading_zip = '" . (int)$data['offloading_zip'] . 
                          //  "', freight_number = '" . (int)$data['freight_number'] . 
                            "', exchangeable = '" . (int)$data['exchangeable'] . 
                            "', stackable = '" . (int)$data['stackable'] . 
                            "', volume_unit = '" . (int)$data['volume_unit'] . 
                            "', number_of_trucks = '" . (int)$data['number_of_trucks'] .
                          //  "', volume_unit_type = '" . (int)$data['volume_unit_type'] . 
                            "', adr = '" . $adr . 
                            "', tir = '" . $tir . 
                            "', cmr = '" . $cmr . 
                            "', cemt = '" . $cemt .                                                                                   
                            "', lift = '" . $lift . 
                            "', manipulator = '" . $manipulator . 
               //          "', description = '" . (int)$data['description'] . 
                            "', frequency = '" . (int)$data['frequency'] .                                                                                          
                            "', date_modified = NOW() " .
                            "WHERE truck_id = '" . (int)$product_id . "'";
                 
                 
              //  echo  $sqlQuery;
            
		$this->db->query($sqlQuery);

		/*if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "truck SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE truck_id = '" . (int)$product_id . "'");
		}*/
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "truck_description WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "truck_description SET ".
                                " product_id = '" . (int)$product_id . "', ".
                                " language_id = '" . (int)$language_id . "', ".
                                //" name = '" . $this->db->escape($value['name']) . "', ".
                               // " meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', ".
                              //  " meta_description = '" . $this->db->escape($value['meta_description']) . "', ".
                                " description = '" . $this->db->escape($value['description']) . "' "
                               /* " tag = '" . $this->db->escape($value['tag']) . "'" */);
		}

		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		/*if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}*/
	
		/*$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");

		if (!empty($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");
					
					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {				
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}*/

		/*$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");
				
					$product_option_id = $this->db->getLastId();
				
					if (isset($product_option['product_option_value'])  && count($product_option['product_option_value']) > 0 ) {
						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}else{
						$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_option_id = '".$product_option_id."'");
					}
				} else { 
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int)$product_option['required'] . "'");
				}					
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
 
		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}*/
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "truck_image WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "truck_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}
		
		/* $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}		
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}		
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}*/
						
		$this->cache->delete('product');
	}
	
	public function copyProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "truck p LEFT JOIN " . DB_PREFIX . "truck_description pd ON (p.truck_id = pd.product_id) WHERE p.truck_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$data['sku'] = '';
			$data['upc'] = '';
			$data['viewed'] = '0';
			$data['keyword'] = '';
			$data['status'] = '0';
						
			//$data = array_merge($data, array('product_attribute' => $this->getProductAttributes($product_id)));
			$data = array_merge($data, array('product_description' => $this->getProductDescriptions($product_id)));			
			//$data = array_merge($data, array('product_discount' => $this->getProductDiscounts($product_id)));
			//$data = array_merge($data, array('product_filter' => $this->getProductFilters($product_id)));
			$data = array_merge($data, array('product_image' => $this->getProductImages($product_id)));		
			//$data = array_merge($data, array('product_option' => $this->getProductOptions($product_id)));
			//$data = array_merge($data, array('product_related' => $this->getProductRelated($product_id)));
			//$data = array_merge($data, array('product_reward' => $this->getProductRewards($product_id)));
			//$data = array_merge($data, array('product_special' => $this->getProductSpecials($product_id)));
			//$data = array_merge($data, array('product_category' => $this->getProductCategories($product_id)));
			//$data = array_merge($data, array('product_download' => $this->getProductDownloads($product_id)));
			//$data = array_merge($data, array('product_layout' => $this->getProductLayouts($product_id)));
			//$data = array_merge($data, array('product_store' => $this->getProductStores($product_id)));
			
			$this->addProduct($data);
		}
	}
	
	public function deleteProduct($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "truck WHERE truck_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "truck_description WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "truck_image WHERE product_id = '" . (int)$product_id . "'");
	
		$this->cache->delete('product');
	}
	
	public function getProduct($product_id) {

           /* $query = $this->db->query(
                        "SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias " . 
                        " WHERE query = 'truck_id=" . (int)$product_id . "') AS keyword " . 
                        " FROM " . DB_PREFIX . "truck p LEFT JOIN " . DB_PREFIX . "truck_description pd ON (p.truck_id = pd.product_id) WHERE p.truck_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");*/
            
                $sql =  "SELECT * FROM " . DB_PREFIX . "truck WHERE truck_id= '" . $product_id . "' "; 
            
		$query = $this->db->query( $sql );
		
		return $query->row;
	}
        
       public function getProductDetails($product_id) {
		//$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.truck_id = pd.product_id) WHERE p.truck_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
           $sql =  "SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " .
                        DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.truck_id " . 
                        " AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW())" .
                        " AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) " .
                        "ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps ".
                        "WHERE ps.product_id = p.truck_id ".
                        "AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) " .
                        "ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr ".
                        "WHERE pr.product_id = p.truck_id ) AS reward, ".
                        "(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id " . 
                        "AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, ". 
                        "(SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd ".
                        "WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') .
                        "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd ".
                        "WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') .
                        "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE ".
                        "r1.product_id = p.truck_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total ".
                        "FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.truck_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews,".
                        " p.sort_order FROM " . DB_PREFIX . "freight p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.truck_id = pd.product_id) ".
                        "LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.truck_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE".
                        " p.truck_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND".
                        " p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" .
                        (int)$this->config->get('config_store_id') . "'";
                
                $query = $this->db->query($sql);
                        
                
             //   echo $sql; 
		return $query->row;
	}
	
	public function getProducts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "truck p LEFT JOIN " . DB_PREFIX . "truck_description pd ON (p.truck_id = pd.product_id)";
                
		$sql .= " LEFT JOIN " . DB_PREFIX . "customer c ON (p.customer_id = c.customer_id)";			
		$sql .= " INNER JOIN " . DB_PREFIX . "customer_group cg ON (c.customer_group_id = cg.customer_group_id)";
                /*if (!empty($data['filter_category_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.truck_id = p2c.product_id)";			
		}*/
                
		$sql .=	" WHERE (1=1) " ;	
	    //	$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (!empty($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
                if (isset($data['customer_id']) && !is_null($data['customer_id'])) {
                        $sql .= " And p.customer_id = '" . $this->db->escape($data['customer_id']) . "' ";
                }
                
                             
                
                
                if (isset($data['loading_country_id']) && !is_null($data['loading_country_id'])  ) {
                    if ($data['loading_country_id'] != -1)
                        $sql .= " And p.loading_country_id = '" . $this->db->escape($data['loading_country_id']) . "' ";
                }
                
                if (isset($data['loading_zone_id']) && !is_null($data['loading_zone_id'])  ) {
                    if ($data['loading_zone_id'] != -1)
                        $sql .= " And p.loading_zone_id = '" . $this->db->escape($data['loading_zone_id']) . "' ";
                }
                
                if (isset($data['loading_city']) && !is_null($data['loading_city'])) {
                     if ($data['loading_city'] != "")
                        $sql .= " And p.loading_city = '" . $this->db->escape($data['loading_city']) . "' ";
                }
                
                
                if (isset($data['offloading_country_id']) && !is_null($data['offloading_country_id'])) {
                    if ($data['offloading_country_id'] != -1)
                        $sql .= " And p.offloading_country_id = '" . $this->db->escape($data['offloading_country_id']) . "' ";
                }
                
                if (isset($data['offloading_zone_id']) && !is_null($data['offloading_zone_id'])) {
                    if ($data['offloading_zone_id'] != -1)
                        $sql .= " And p.offloading_zone_id = '" . $this->db->escape($data['offloading_zone_id']) . "' ";
                }
                
                if (isset($data['offloading_city']) && !is_null($data['offloading_city'])) {
                    if ($data['offloading_city'] != "")
                        $sql .= " And p.offloading_city = '" . $this->db->escape($data['offloading_city']) . "' ";
                }
                
                
                if (isset($data['loading_date_from']) && !is_null($data['loading_date_from'])  ) {
                    if ($data['loading_date_from'] != "")
                        $sql .= " And p.loading_date >= '" . $this->db->escape($data['loading_date_from']) . "' ";
                }
                
                
                if (isset($data['loading_date_to']) && !is_null($data['loading_date_to'])) {
                    if ($data['loading_date_to'] != "")
                        $sql .= " And p.loading_date <= '" . $this->db->escape($data['loading_date_to']) . "' ";
                }
                
                
                
                if (isset($data['trailer_type_id']) && !is_null($data['trailer_type_id'])) {
                    if ($data['trailer_type_id'] != "")
                    { 
                       if(count($data['trailer_type_id']) > 0 && $data['trailer_type_id'][0] != null) $sql .= " And ( p.trailer_type_id = '" . $data['trailer_type_id'][0] . "'";
                       
                        for($i=1;$i<count($data['trailer_type_id']);$i++)
                        if($data['trailer_type_id'][$i] != null)
                            $sql .= " or p.trailer_type_id = '" . $data['trailer_type_id'][$i] . "' ";
                        
                       if(count($data['trailer_type_id']) > 0 && $data['trailer_type_id'][0] != null) $sql .=" ) ";
                    }
                       // $sql .= "And p.loading_date < '" . $this->db->escape($data['loading_date_to']) . "' ";
                }
                
               // $sql .= " And p.type = '1' ";
                
		$sql .= " GROUP BY p.truck_id";
					
		$sort_data = array(
			'pd.name'           ,
			'p.model'           ,
			'p.price'           ,
			'p.quantity'        ,
			'p.status'          ,
			'p.sort_order'      ,
                        'cg.priority_view'  ,
                        'DATE(p.date_added),cg.priority_view'
		);	
		     
		if (isset($data['sort'])) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {                  
			$sql .= " ORDER BY DATE(p.date_added),cg.priority_view ";	
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
		            
                //echo $sql;
		$query = $this->db->query($sql);
	
		return $query->rows;
	}
	
	public function getProductsByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "truck p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.truck_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.truck_id = p2c.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");
								  
		return $query->rows;
	} 
	
	public function getProductDescriptions($product_id) {
		$product_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "truck_description WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'tag'              => $result['tag']
			);
		}
		
		return $product_description_data;
	}
		
	public function getProductCategories($product_id) {
		$product_category_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_category_data[] = $result['category_id'];
		}

		return $product_category_data;
	}
	
	public function getProductFilters($product_id) {
		$product_filter_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_filter_data[] = $result['filter_id'];
		}
				
		return $product_filter_data;
	}
	
	public function getProductAttributes($product_id) {
		$product_attribute_data = array();
		
		$product_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' GROUP BY attribute_id");
		
		foreach ($product_attribute_query->rows as $product_attribute) {
			$product_attribute_description_data = array();
			
			$product_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");
			
			foreach ($product_attribute_description_query->rows as $product_attribute_description) {
				$product_attribute_description_data[$product_attribute_description['language_id']] = array('text' => $product_attribute_description['text']);
			}
			
			$product_attribute_data[] = array(
				'attribute_id'                  => $product_attribute['attribute_id'],
				'product_attribute_description' => $product_attribute_description_data
			);
		}
		
		return $product_attribute_data;
	}
	
	public function getProductOptions($product_id) {
		$product_option_data = array();
		
		$product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();	
				
			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE product_option_id = '" . (int)$product_option['product_option_id'] . "'");
				
			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'points'                  => $product_option_value['points'],
					'points_prefix'           => $product_option_value['points_prefix'],						
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']					
				);
			}
				
			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],			
				'product_option_value' => $product_option_value_data,
				'option_value'         => $product_option['option_value'],
				'required'             => $product_option['required']				
			);
		}
		
		return $product_option_data;
	}
			
	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "truck_image WHERE product_id = '" . (int)$product_id . "'");
		
		return $query->rows;
	}
	
	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' ORDER BY quantity, priority, price");
		
		return $query->rows;
	}
	
	public function getProductSpecials($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");
		
		return $query->rows;
	}
	
	public function getProductRewards($product_id) {
		$product_reward_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}
		
		return $product_reward_data;
	}
		
	public function getProductDownloads($product_id) {
		$product_download_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_download_data[] = $result['download_id'];
		}
		
		return $product_download_data;
	}

	public function getProductStores($product_id) {
		$product_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_store_data[] = $result['store_id'];
		}
		
		return $product_store_data;
	}

	public function getProductLayouts($product_id) {
		$product_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $product_layout_data;
	}

	public function getProductRelated($product_id) {
		$product_related_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}
		
		return $product_related_data;
	}
	
	public function getTotalProducts($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.truck_id) AS total FROM " . DB_PREFIX . "truck p LEFT JOIN " . DB_PREFIX . "truck_description pd ON (p.truck_id = pd.product_id)";

		if (!empty($data['filter_category_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.truck_id = p2c.product_id)";			
		}
		 
		//$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$sql .= " WHERE (1=1) ";
                 
		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (!empty($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		//if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
		//	$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
		//}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
                if (isset($data['customer_id']) && !is_null($data['customer_id'])) {
                        $sql .= " and p.customer_id = " . $this->db->escape($data['customer_id']) . " ";
                }
                
               
                if (isset($data['loading_country_id']) && !is_null($data['loading_country_id'])  ) {
                    if ($data['loading_country_id'] != -1)
                        $sql .= "And p.loading_country_id = '" . $this->db->escape($data['loading_country_id']) . "' ";
                }
                
                if (isset($data['loading_zone_id']) && !is_null($data['loading_zone_id'])  ) {
                    if ($data['loading_zone_id'] != -1)
                        $sql .= "And p.loading_zone_id = '" . $this->db->escape($data['loading_zone_id']) . "' ";
                }
                
                if (isset($data['loading_city']) && !is_null($data['loading_city'])) {
                     if ($data['loading_city'] != "")
                        $sql .= "And p.loading_city = '" . $this->db->escape($data['loading_city']) . "' ";
                }
                
                
                if (isset($data['offloading_country_id']) && !is_null($data['offloading_country_id'])) {
                    if ($data['offloading_country_id'] != -1)
                        $sql .= "And p.offloading_country_id = '" . $this->db->escape($data['offloading_country_id']) . "' ";
                }
                
                if (isset($data['offloading_zone_id']) && !is_null($data['offloading_zone_id'])) {
                    if ($data['offloading_zone_id'] != -1)
                        $sql .= "And p.offloading_zone_id = '" . $this->db->escape($data['offloading_zone_id']) . "' ";
                }
                
                if (isset($data['offloading_city']) && !is_null($data['offloading_city'])) {
                    if ($data['offloading_city'] != "")
                        $sql .= "And p.offloading_city = '" . $this->db->escape($data['offloading_city']) . "' ";
                }
                
                
                if (isset($data['loading_date_from']) && !is_null($data['loading_date_from'])  ) {
                    if ($data['loading_date_from'] != "")
                        $sql .= "And p.loading_date > '" . $this->db->escape($data['loading_date_from']) . "' ";
                }
                
                
                if (isset($data['loading_date_to']) && !is_null($data['loading_date_to'])) {
                    if ($data['loading_date_to'] != "")
                        $sql .= "And p.loading_date < '" . $this->db->escape($data['loading_date_to']) . "' ";
                }                           
                
                if (isset($data['trailer_type_id']) && !is_null($data['trailer_type_id'])) {
                    if ($data['trailer_type_id'] != "")
                    { 
                       if(count($data['trailer_type_id']) > 0) $sql .= " And ( p.trailer_type_id = '" . $data['trailer_type_id'][0] . "'";
                       
                        for($i=1;$i<count($data['trailer_type_id']);$i++)
                            $sql .= " or p.trailer_type_id = '" . $data['trailer_type_id'][$i] . "' ";
                        
                       if(count($data['trailer_type_id']) > 0) $sql .=" ) ";
                    }
                       // $sql .= "And p.loading_date < '" . $this->db->escape($data['loading_date_to']) . "' ";
                }
                
              // $sql .= " And p.type = '1' "; 
                
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	
	public function getTotalProductsByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}
		
	public function getTotalProductsByStockStatusId($stock_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE stock_status_id = '" . (int)$stock_status_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalProductsByWeightClassId($weight_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalProductsByLengthClassId($length_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE length_class_id = '" . (int)$length_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_download WHERE download_id = '" . (int)$download_id . "'");
		
		return $query->row['total'];
	}
	
	public function getTotalProductsByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalProductsByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row['total'];
	}	
	
	public function getTotalProductsByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_option WHERE option_id = '" . (int)$option_id . "'");

		return $query->row['total'];
	}	
	
	public function getTotalProductsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}
?>
