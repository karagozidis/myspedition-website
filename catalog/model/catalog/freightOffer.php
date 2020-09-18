<?php
class ModelCatalogFreightOffer extends Model {
    
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
        
        
	
	public function editProduct($product_id, $data) {           
                
                    if( isset($data['adr']) ) $adr = 1; 
                        else $adr = 0;
                    if( isset($data['tir']) ) $tir = 1; 
                        else $tir = 0;
                    if( isset($data['cmr']) ) $cmr = 1; 
                        else $cmr = 0;
                    if( isset($data['cemt']) ) $cemt = 1; 
                        else $cemt = 0;
                    if( isset($data['t1']) ) $t1 = 1; 
                        else $t1 = 0;
                    if( isset($data['ex1']) ) $ex1 = 1; 
                        else $ex1 = 0;
                    if( isset($data['lift']) ) $lift = 1; 
                        else $lift = 0;
                    if( isset($data['manipulator']) ) $manipulator = 1; 
                        else $manipulator = 0;
                        
                
                 $sqlQuery = "UPDATE " . DB_PREFIX . "freight SET " .
                   
                    " loading_country_id = '" . $this->db->escape($data['loading_country_id']) . 
                    "', loading_city = '" . $this->db->escape($data['loading_city']) . 
                    "', offloading_country_id = '" . $this->db->escape($data['offloading_country_id']) .
                    "', offloading_city = '" . $this->db->escape($data['offloading_city']) . 
                    "', loading_date = '" . $this->db->escape($data['loading_date']) .
                    "', est_date = '" . $this->db->escape($data['est_date']) .
                    "', freight_type_id = '" . $this->db->escape($data['freight_type_id']) .
                    "', trailer_type_id = '" . (int)$data['trailer_type_id'] . 
                    "', freight_params = '" . (int)$data['freight_params'] . 
                    "', weight_tons = '" . (int)$data['weight_tons'] . 
                    "', pallets_no = '" . (int)$data['pallets_no'] . 
                    "', loading_zone_id = '" . (int)$data['loading_zone_id'] . 
                    "', loading_zip = '" . (int)$data['loading_zip'] . 
                    "', offloading_zone_id = '" . (int)$data['offloading_zone_id'] . 
                    "', offloading_zip = '" . (int)$data['offloading_zip'] . 
                    "', exchangeable = '" . (int)$data['exchangeable'] . 
                    "', stackable = '" . (int)$data['stackable'] . 
                    "', volume_unit = '" . (int)$data['volume_unit'] . 
                    "', adr = '" . $adr . 
                    "', tir = '" . $tir . 
                    "', cmr = '" . $cmr . 
                    "', cemt = '" . $cemt . 
                    "', t1 = '" . $t1 . 
                    "', ex1 = '" . $ex1 . 
                    "', freight_loading_type_id = '" . (int)$data['freight_loading_type_id'] . 
                    "', freight_rate = '" . (int)$data['freight_rate'] .                    
                    "', payment_terms_id = '" . (int)$data['payment_terms_id'] . 
                    "', payment_method_id = '" . (int)$data['payment_method_id'] . 
                    "', lift = '" . $lift . 
                    "', manipulator = '" . $manipulator . 
                    "', frequency = '" . (int)$data['frequency'] . 
                    "', rate_currency = '" . (int)$data['rate_currency'] .                          
                    "', date_modified = NOW() " .
                    "WHERE freight_id = '" . (int)$product_id . "'";
                 
                 
            
		$this->db->query($sqlQuery);

		
		$this->db->query("DELETE FROM " . DB_PREFIX . "freight_description WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($data['product_description'] as $language_id => $value) {
                    
			$this->db->query("INSERT INTO " . DB_PREFIX . "freight_description SET ".
                                "product_id = '" . (int)$product_id . "',".
                                " language_id = '" . (int)$language_id . "', ".
                                " description = '" . $this->db->escape($value['description']) . "' ");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "freight_image WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_image'])) {     
                   
			foreach ($data['product_image'] as $product_image) {
                            
                            $sql = "INSERT INTO " . DB_PREFIX . "freight_image " .
                                    "SET product_id = '" . (int)$product_id . 
                                    "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . 
                                    "', sort_order = '" . (int)$product_image['sort_order'] . "'";                       
				$this->db->query($sql);
			}
		}
		
		
						
		$this->cache->delete('product');
	}
	
	public function copyProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "freight p LEFT JOIN " . DB_PREFIX . "freight_description pd ON (p.freight_id = pd.product_id) WHERE p.freight_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
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
		$this->db->query("DELETE FROM " . DB_PREFIX . "freight WHERE freight_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "freight_description WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "freight_image WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");
		
		//$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id. "'");
		
		$this->cache->delete('product');
	}
	
	public function getProduct($product_id) {
           $sql = "SELECT * FROM " . DB_PREFIX . "freight WHERE freight_id = ' " . (int)$product_id ." '";
         /*   $sql = "SELECT DISTINCT *, ".
                    " (SELECT keyword FROM " . DB_PREFIX . "url_alias " . 
                    " WHERE query = 'product_id=" . (int)$product_id . "') ".
                    " AS keyword " . 
                    " FROM " . DB_PREFIX . "freight p LEFT JOIN " . DB_PREFIX . "freight_description pd ".
                    " ON (p.freight_id = pd.product_id) ".
                    " WHERE p.freight_id = '" . (int)$product_id . 
                    "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";*/
           
               
            
               // echo $sql;
                
		$query = $this->db->query( $sql );
		
		return $query->row;
	}
        
       	public function getTotalProductFreigthsByLoadingCountry($product_id) {
           $sql = "SELECT * FROM " . DB_PREFIX . "freight  WHERE freight_id = ' " . (int)$product_id ." '";           
		$query = $this->db->query( $sql );
		
		return $query->row;
	} 
        
        
       public function getProductDetails($product_id) {
		//$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.freight_id = pd.product_id) WHERE p.freight_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
           $sql =  "SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " .
                        DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.freight_id " . 
                        " AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW())" .
                        " AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) " .
                        "ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps ".
                        "WHERE ps.product_id = p.freight_id ".
                        "AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) " .
                        "ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr ".
                        "WHERE pr.product_id = p.freight_id ) AS reward, ".
                        "(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id " . 
                        "AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, ". 
                        "(SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd ".
                        "WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') .
                        "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd ".
                        "WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') .
                        "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE ".
                        "r1.product_id = p.freight_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total ".
                        "FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.freight_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews,".
                        " p.sort_order FROM " . DB_PREFIX . "freight p LEFT JOIN " . DB_PREFIX . "freight_description pd ON (p.freight_id = pd.product_id) ".
                        "LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.freight_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE".
                        " p.freight_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND".
                        " p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" .
                        (int)$this->config->get('config_store_id') . "'";
                
                $query = $this->db->query($sql);
                        
                
             
		return $query->row;
	}
        
             
	public function getProducts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "freight p LEFT JOIN " . DB_PREFIX . "freight_description pd ON (p.freight_id = pd.product_id)";
		
                $sql .= " LEFT JOIN " . DB_PREFIX . "customer c ON (p.customer_id = c.customer_id)";			
		$sql .= " INNER JOIN " . DB_PREFIX . "customer_group cg ON (c.customer_group_id = cg.customer_group_id)";
                
		if (!empty($data['filter_category_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.freight_id = p2c.product_id)";			
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
		
		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
                if (isset($data['customer_id']) && !is_null($data['customer_id'])) {
                        $sql .= "And p.customer_id = '" . $this->db->escape($data['customer_id']) . "' ";
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
                       if( count($data['trailer_type_id']) > 0 && $data['trailer_type_id'][0] != null) $sql .= " And ( p.trailer_type_id = '" . $data['trailer_type_id'][0] . "'";
                       
                        for($i=1;$i<count($data['trailer_type_id']);$i++)
                         if($data['trailer_type_id'][$i] != null)
                            $sql .= " or p.trailer_type_id = '" . $data['trailer_type_id'][$i] . "' ";
                        
                       if(count($data['trailer_type_id']) > 0 && $data['trailer_type_id'][0] != null) $sql .=" ) ";
                    }
                       // $sql .= "And p.loading_date < '" . $this->db->escape($data['loading_date_to']) . "' ";
                }
                
                
                             
                
               // $sql .= " And p.type = '1' ";
                
		$sql .= " GROUP BY p.freight_id";
					
		$sort_data = array(
			'pd.name',
			'p.price',
			'p.status',
			'p.sort_order',
                        'p.date_added',
                        'p.loading_date'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	                      
		} else {               
			$sql .= " ORDER BY p.date_added";	
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
	
	public function getProductsByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.freight_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.freight_id = p2c.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");
								  
		return $query->rows;
	} 
	
	public function getProductDescriptions($product_id) {
		$product_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_description WHERE product_id = '" . (int)$product_id . "'");
		
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
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_image WHERE product_id = '" . (int)$product_id . "'");
		
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
		$sql = "SELECT COUNT(DISTINCT p.freight_id) AS total FROM " . DB_PREFIX . "freight p LEFT JOIN " . DB_PREFIX . "freight_description pd ON (p.freight_id = pd.product_id)";

		if (!empty($data['filter_category_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.freight_id = p2c.product_id)";			
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
                
                
                
                if (isset($data['trailer_type_id']) && !is_null($data['trailer_type_id'])) 
                {
                    if ($data['trailer_type_id'] != "")
                    { 
                       if( count($data['trailer_type_id']) > 0) $sql .= " And ( p.trailer_type_id = '" . $data['trailer_type_id'][0] . "'";
                       
                        for($i=1;$i<count($data['trailer_type_id']);$i++)
                            $sql .= " or p.trailer_type_id = '" . $data['trailer_type_id'][$i] . "' ";
                        
                       if( count($data['trailer_type_id']) > 0) $sql .=" ) ";
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
