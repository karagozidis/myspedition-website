<?php
class ModelCatalogProductRequest extends Model {
	public function addProductRequest($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest SET ".
                        " model = '" . $this->db->escape($data['model']) . 
                        "', sku = '" . $this->db->escape($data['sku']) . 
                        "', upc = '" . $this->db->escape($data['upc']) . 
                        "', ean = '" . $this->db->escape($data['ean']) . 
                        "', jan = '" . $this->db->escape($data['jan']) .
                        "', isbn = '" . $this->db->escape($data['isbn']) . 
                        "', mpn = '" . $this->db->escape($data['mpn']) . 
                        "', location = '" . $this->db->escape($data['location']) . 
                        "', quantity = '" . (int)$data['quantity'] . 
                        "', minimum = '" . (int)$data['minimum'] . 
                        "', subtract = '" . (int)$data['subtract'] . 
                        "', stock_status_id = '" . (int)$data['stock_status_id'] . 
                        "', date_available = '" . $this->db->escape($data['date_available']) . 
                        "', manufacturer_id = '" . (int)$data['manufacturer_id'] . 
                        "', shipping = '" . (int)$data['shipping'] . 
                        "', price = '" . (float)$data['price'] . 
                        "', points = '" . (int)$data['points'] . 
                        "', weight = '" . (float)$data['weight'] . 
                        "', weight_class_id = '" . (int)$data['weight_class_id'] . 
                        "', length = '" . (float)$data['length'] . 
                        "', width = '" . (float)$data['width'] . 
                        "', height = '" . (float)$data['height'] . 
                        "', length_class_id = '" . (int)$data['length_class_id'] . 
                        "', status = '" . (int)$data['status'] . 
                        "', tax_class_id = '" . $this->db->escape($data['tax_class_id']) . 
                        "', sort_order = '" . (int)$data['sort_order'] . 
                        "', country_id = '" . (int)$data['country_id'] . 
                        "', zone_id = '" . (int)$data['zone_id'] . 
                        "', date_added = NOW()");
		
		$productRequest_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "productRequest SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		}
		
		foreach ($data['productRequest_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_description SET productRequest_id = '" . (int)$productRequest_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}
		
		if (isset($data['productRequest_store'])) {
			foreach ($data['productRequest_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_to_store SET productRequest_id = '" . (int)$productRequest_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['productRequest_attribute'])) {
			foreach ($data['productRequest_attribute'] as $productRequest_attribute) {
				if ($productRequest_attribute['attribute_id']) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_attribute WHERE productRequest_id = '" . (int)$productRequest_id . "' AND attribute_id = '" . (int)$productRequest_attribute['attribute_id'] . "'");
					
					foreach ($productRequest_attribute['productRequest_attribute_description'] as $language_id => $productRequest_attribute_description) {				
						$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_attribute SET productRequest_id = '" . (int)$productRequest_id . "', attribute_id = '" . (int)$productRequest_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($productRequest_attribute_description['text']) . "'");
					}
				}
			}
		}
	
		if (isset($data['productRequest_option'])) {
			foreach ($data['productRequest_option'] as $productRequest_option) {
				if ($productRequest_option['type'] == 'select' || $productRequest_option['type'] == 'radio' || $productRequest_option['type'] == 'checkbox' || $productRequest_option['type'] == 'image') {
					$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_option SET productRequest_id = '" . (int)$productRequest_id . "', option_id = '" . (int)$productRequest_option['option_id'] . "', required = '" . (int)$productRequest_option['required'] . "'");
				
					$productRequest_option_id = $this->db->getLastId();
				
					if (isset($productRequest_option['productRequest_option_value']) && count($productRequest_option['productRequest_option_value']) > 0 ) {
						foreach ($productRequest_option['productRequest_option_value'] as $productRequest_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_option_value SET productRequest_option_id = '" . (int)$productRequest_option_id . "', productRequest_id = '" . (int)$productRequest_id . "', option_id = '" . (int)$productRequest_option['option_id'] . "', option_value_id = '" . (int)$productRequest_option_value['option_value_id'] . "', quantity = '" . (int)$productRequest_option_value['quantity'] . "', subtract = '" . (int)$productRequest_option_value['subtract'] . "', price = '" . (float)$productRequest_option_value['price'] . "', price_prefix = '" . $this->db->escape($productRequest_option_value['price_prefix']) . "', points = '" . (int)$productRequest_option_value['points'] . "', points_prefix = '" . $this->db->escape($productRequest_option_value['points_prefix']) . "', weight = '" . (float)$productRequest_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($productRequest_option_value['weight_prefix']) . "'");
						} 
					}else{
						$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_option WHERE productRequest_option_id = '".$productRequest_option_id."'");
					}
				} else { 
					$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_option SET productRequest_id = '" . (int)$productRequest_id . "', option_id = '" . (int)$productRequest_option['option_id'] . "', option_value = '" . $this->db->escape($productRequest_option['option_value']) . "', required = '" . (int)$productRequest_option['required'] . "'");
				}
			}
		}
		
		if (isset($data['productRequest_discount'])) {
			foreach ($data['productRequest_discount'] as $productRequest_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_discount SET productRequest_id = '" . (int)$productRequest_id . "', customer_group_id = '" . (int)$productRequest_discount['customer_group_id'] . "', quantity = '" . (int)$productRequest_discount['quantity'] . "', priority = '" . (int)$productRequest_discount['priority'] . "', price = '" . (float)$productRequest_discount['price'] . "', date_start = '" . $this->db->escape($productRequest_discount['date_start']) . "', date_end = '" . $this->db->escape($productRequest_discount['date_end']) . "'");
			}
		}

		if (isset($data['productRequest_special'])) {
			foreach ($data['productRequest_special'] as $productRequest_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_special SET productRequest_id = '" . (int)$productRequest_id . "', customer_group_id = '" . (int)$productRequest_special['customer_group_id'] . "', priority = '" . (int)$productRequest_special['priority'] . "', price = '" . (float)$productRequest_special['price'] . "', date_start = '" . $this->db->escape($productRequest_special['date_start']) . "', date_end = '" . $this->db->escape($productRequest_special['date_end']) . "'");
			}
		}
		
		if (isset($data['productRequest_image'])) {
			foreach ($data['productRequest_image'] as $productRequest_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_image SET productRequest_id = '" . (int)$productRequest_id . "', image = '" . $this->db->escape(html_entity_decode($productRequest_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$productRequest_image['sort_order'] . "'");
			}
		}
		
		if (isset($data['productRequest_download'])) {
			foreach ($data['productRequest_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_to_download SET productRequest_id = '" . (int)$productRequest_id . "', download_id = '" . (int)$download_id . "'");
			}
		}
		
		if (isset($data['productRequest_category'])) {
			foreach ($data['productRequest_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_to_category SET productRequest_id = '" . (int)$productRequest_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
		
		if (isset($data['productRequest_filter'])) {
			foreach ($data['productRequest_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_filter SET productRequest_id = '" . (int)$productRequest_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}
		
		if (isset($data['productRequest_related'])) {
			foreach ($data['productRequest_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_related WHERE productRequest_id = '" . (int)$productRequest_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_related SET productRequest_id = '" . (int)$productRequest_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_related WHERE productRequest_id = '" . (int)$related_id . "' AND related_id = '" . (int)$productRequest_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_related SET productRequest_id = '" . (int)$related_id . "', related_id = '" . (int)$productRequest_id . "'");
			}
		}

		if (isset($data['productRequest_reward'])) {
			foreach ($data['productRequest_reward'] as $customer_group_id => $productRequest_reward) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_reward SET productRequest_id = '" . (int)$productRequest_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$productRequest_reward['points'] . "'");
			}
		}

		if (isset($data['productRequest_layout'])) {
			foreach ($data['productRequest_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_to_layout SET productRequest_id = '" . (int)$productRequest_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'productRequest_id=" . (int)$productRequest_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
						
		$this->cache->delete('productRequest');
	}
	
	public function editProductRequest($productRequest_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "productRequest SET ".
                        " model = '" . $this->db->escape($data['model']) . 
                        "', sku = '" . $this->db->escape($data['sku']) . 
                        "', upc = '" . $this->db->escape($data['upc']) . 
                        "', ean = '" . $this->db->escape($data['ean']) . 
                        "', jan = '" . $this->db->escape($data['jan']) . 
                        "', isbn = '" . $this->db->escape($data['isbn']) . 
                        "', mpn = '" . $this->db->escape($data['mpn']) . 
                        "', location = '" . $this->db->escape($data['location']) .
                        "', quantity = '" . (int)$data['quantity'] . 
                        "', minimum = '" . (int)$data['minimum'] . 
                        "', subtract = '" . (int)$data['subtract'] . 
                        "', stock_status_id = '" . (int)$data['stock_status_id'] . 
                        "', date_available = '" . $this->db->escape($data['date_available']) . 
                        "', manufacturer_id = '" . (int)$data['manufacturer_id'] . 
                        "', shipping = '" . (int)$data['shipping'] . 
                        "', price = '" . (float)$data['price'] . 
                        "', points = '" . (int)$data['points'] . 
                        "', weight = '" . (float)$data['weight'] . 
                        "', weight_class_id = '" . (int)$data['weight_class_id'] .
                        "', length = '" . (float)$data['length'] . 
                        "', width = '" . (float)$data['width'] . 
                        "', height = '" . (float)$data['height'] .
                        "', length_class_id = '" . (int)$data['length_class_id'] .
                        "', status = '" . (int)$data['status'] . 
                        "', tax_class_id = '" . $this->db->escape($data['tax_class_id']) . 
                        "', sort_order = '" . (int)$data['sort_order'] . 
                        "', country_id = '" . (int)$data['country_id'] . 
                        "', zone_id = '" . (int)$data['zone_id'] . 
                        "', date_modified = NOW() ".
                        " WHERE productRequest_id = '" . (int)$productRequest_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "productRequest SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_description WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		foreach ($data['productRequest_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_description SET productRequest_id = '" . (int)$productRequest_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_to_store WHERE productRequest_id = '" . (int)$productRequest_id . "'");

		if (isset($data['productRequest_store'])) {
			foreach ($data['productRequest_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_to_store SET productRequest_id = '" . (int)$productRequest_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_attribute WHERE productRequest_id = '" . (int)$productRequest_id . "'");

		if (!empty($data['productRequest_attribute'])) {
			foreach ($data['productRequest_attribute'] as $productRequest_attribute) {
				if ($productRequest_attribute['attribute_id']) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_attribute WHERE productRequest_id = '" . (int)$productRequest_id . "' AND attribute_id = '" . (int)$productRequest_attribute['attribute_id'] . "'");
					
					foreach ($productRequest_attribute['productRequest_attribute_description'] as $language_id => $productRequest_attribute_description) {				
						$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_attribute SET productRequest_id = '" . (int)$productRequest_id . "', attribute_id = '" . (int)$productRequest_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($productRequest_attribute_description['text']) . "'");
					}
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_option WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_option_value WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		if (isset($data['productRequest_option'])) {
			foreach ($data['productRequest_option'] as $productRequest_option) {
				if ($productRequest_option['type'] == 'select' || $productRequest_option['type'] == 'radio' || $productRequest_option['type'] == 'checkbox' || $productRequest_option['type'] == 'image') {
					$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_option SET productRequest_option_id = '" . (int)$productRequest_option['productRequest_option_id'] . "', productRequest_id = '" . (int)$productRequest_id . "', option_id = '" . (int)$productRequest_option['option_id'] . "', required = '" . (int)$productRequest_option['required'] . "'");
				
					$productRequest_option_id = $this->db->getLastId();
				
					if (isset($productRequest_option['productRequest_option_value'])  && count($productRequest_option['productRequest_option_value']) > 0 ) {
						foreach ($productRequest_option['productRequest_option_value'] as $productRequest_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_option_value SET productRequest_option_value_id = '" . (int)$productRequest_option_value['productRequest_option_value_id'] . "', productRequest_option_id = '" . (int)$productRequest_option_id . "', productRequest_id = '" . (int)$productRequest_id . "', option_id = '" . (int)$productRequest_option['option_id'] . "', option_value_id = '" . (int)$productRequest_option_value['option_value_id'] . "', quantity = '" . (int)$productRequest_option_value['quantity'] . "', subtract = '" . (int)$productRequest_option_value['subtract'] . "', price = '" . (float)$productRequest_option_value['price'] . "', price_prefix = '" . $this->db->escape($productRequest_option_value['price_prefix']) . "', points = '" . (int)$productRequest_option_value['points'] . "', points_prefix = '" . $this->db->escape($productRequest_option_value['points_prefix']) . "', weight = '" . (float)$productRequest_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($productRequest_option_value['weight_prefix']) . "'");
						}
					}else{
						$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_option WHERE productRequest_option_id = '".$productRequest_option_id."'");
					}
				} else { 
					$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_option SET productRequest_option_id = '" . (int)$productRequest_option['productRequest_option_id'] . "', productRequest_id = '" . (int)$productRequest_id . "', option_id = '" . (int)$productRequest_option['option_id'] . "', option_value = '" . $this->db->escape($productRequest_option['option_value']) . "', required = '" . (int)$productRequest_option['required'] . "'");
				}					
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_discount WHERE productRequest_id = '" . (int)$productRequest_id . "'");
 
		if (isset($data['productRequest_discount'])) {
			foreach ($data['productRequest_discount'] as $productRequest_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_discount SET productRequest_id = '" . (int)$productRequest_id . "', customer_group_id = '" . (int)$productRequest_discount['customer_group_id'] . "', quantity = '" . (int)$productRequest_discount['quantity'] . "', priority = '" . (int)$productRequest_discount['priority'] . "', price = '" . (float)$productRequest_discount['price'] . "', date_start = '" . $this->db->escape($productRequest_discount['date_start']) . "', date_end = '" . $this->db->escape($productRequest_discount['date_end']) . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_special WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		if (isset($data['productRequest_special'])) {
			foreach ($data['productRequest_special'] as $productRequest_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_special SET productRequest_id = '" . (int)$productRequest_id . "', customer_group_id = '" . (int)$productRequest_special['customer_group_id'] . "', priority = '" . (int)$productRequest_special['priority'] . "', price = '" . (float)$productRequest_special['price'] . "', date_start = '" . $this->db->escape($productRequest_special['date_start']) . "', date_end = '" . $this->db->escape($productRequest_special['date_end']) . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_image WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		if (isset($data['productRequest_image'])) {
			foreach ($data['productRequest_image'] as $productRequest_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_image SET productRequest_id = '" . (int)$productRequest_id . "', image = '" . $this->db->escape(html_entity_decode($productRequest_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$productRequest_image['sort_order'] . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_to_download WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		if (isset($data['productRequest_download'])) {
			foreach ($data['productRequest_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_to_download SET productRequest_id = '" . (int)$productRequest_id . "', download_id = '" . (int)$download_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_to_category WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		if (isset($data['productRequest_category'])) {
			foreach ($data['productRequest_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_to_category SET productRequest_id = '" . (int)$productRequest_id . "', category_id = '" . (int)$category_id . "'");
			}		
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_filter WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		if (isset($data['productRequest_filter'])) {
			foreach ($data['productRequest_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_filter SET productRequest_id = '" . (int)$productRequest_id . "', filter_id = '" . (int)$filter_id . "'");
			}		
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_related WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_related WHERE related_id = '" . (int)$productRequest_id . "'");

		if (isset($data['productRequest_related'])) {
			foreach ($data['productRequest_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_related WHERE productRequest_id = '" . (int)$productRequest_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_related SET productRequest_id = '" . (int)$productRequest_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_related WHERE productRequest_id = '" . (int)$related_id . "' AND related_id = '" . (int)$productRequest_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_related SET productRequest_id = '" . (int)$related_id . "', related_id = '" . (int)$productRequest_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_reward WHERE productRequest_id = '" . (int)$productRequest_id . "'");

		if (isset($data['productRequest_reward'])) {
			foreach ($data['productRequest_reward'] as $customer_group_id => $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_reward SET productRequest_id = '" . (int)$productRequest_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_to_layout WHERE productRequest_id = '" . (int)$productRequest_id . "'");

		if (isset($data['productRequest_layout'])) {
			foreach ($data['productRequest_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "productRequest_to_layout SET productRequest_id = '" . (int)$productRequest_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'productRequest_id=" . (int)$productRequest_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'productRequest_id=" . (int)$productRequest_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
						
		$this->cache->delete('productRequest');
	}
	
	public function copyProductRequest($productRequest_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "productRequest p LEFT JOIN " . DB_PREFIX . "productRequest_description pd ON (p.productRequest_id = pd.productRequest_id) WHERE p.productRequest_id = '" . (int)$productRequest_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$data['sku'] = '';
			$data['upc'] = '';
			$data['viewed'] = '0';
			$data['keyword'] = '';
			$data['status'] = '0';
						
			$data = array_merge($data, array('productRequest_attribute' => $this->getProductRequestAttributes($productRequest_id)));
			$data = array_merge($data, array('productRequest_description' => $this->getProductRequestDescriptions($productRequest_id)));			
			$data = array_merge($data, array('productRequest_discount' => $this->getProductRequestDiscounts($productRequest_id)));
			$data = array_merge($data, array('productRequest_filter' => $this->getProductRequestFilters($productRequest_id)));
			$data = array_merge($data, array('productRequest_image' => $this->getProductRequestImages($productRequest_id)));		
			$data = array_merge($data, array('productRequest_option' => $this->getProductRequestOptions($productRequest_id)));
			$data = array_merge($data, array('productRequest_related' => $this->getProductRequestRelated($productRequest_id)));
			$data = array_merge($data, array('productRequest_reward' => $this->getProductRequestRewards($productRequest_id)));
			$data = array_merge($data, array('productRequest_special' => $this->getProductRequestSpecials($productRequest_id)));
			$data = array_merge($data, array('productRequest_category' => $this->getProductRequestCategories($productRequest_id)));
			$data = array_merge($data, array('productRequest_download' => $this->getProductRequestDownloads($productRequest_id)));
			$data = array_merge($data, array('productRequest_layout' => $this->getProductRequestLayouts($productRequest_id)));
			$data = array_merge($data, array('productRequest_store' => $this->getProductRequestStores($productRequest_id)));
			
			$this->addProductRequest($data);
		}
	}
	
	public function deleteProductRequest($productRequest_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_attribute WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_description WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_discount WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_filter WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_image WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_option WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_option_value WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_related WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_related WHERE related_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_reward WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_special WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_to_category WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_to_download WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_to_layout WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "productRequest_to_store WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "requestReview WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'productRequest_id=" . (int)$productRequest_id. "'");
		
		$this->cache->delete('productRequest');
	}
	
	public function getProductRequest($productRequest_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'productRequest_id=" . (int)$productRequest_id . "') AS keyword FROM " . DB_PREFIX . "productRequest p LEFT JOIN " . DB_PREFIX . "productRequest_description pd ON (p.productRequest_id = pd.productRequest_id) WHERE p.productRequest_id = '" . (int)$productRequest_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				
		return $query->row;
	}
	
	public function getProductRequests($data = array()) { 
            
		$sql = "SELECT *,p.status AS productRequest_status , CONCAT(cu.firstname, ' ', cu.lastname) AS customer_name FROM " . DB_PREFIX . "productRequest p LEFT JOIN " . DB_PREFIX . "productRequest_description pd ON (p.productRequest_id = pd.productRequest_id)";
		
                $sql .= " LEFT JOIN " . DB_PREFIX . "customer cu ON (p.customer_id = cu.customer_id)";	
                
		if (!empty($data['filter_category_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "productRequest_to_category p2c ON (p.productRequest_id = p2c.productRequest_id)";			
		}
				
		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
		
                if (!empty($data['filter_email'])) {
			$sql .= " AND cu.email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
                
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
                
		$sql .= " And p.type = 0 ";
		$sql .= " GROUP BY p.productRequest_id";
				
               
		$sort_data = array(
			'pd.name',
			'p.model',
			'p.price',
			'p.quantity',
			'p.status',
			'p.sort_order',
                        'p.date_added'
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
	
	public function getProductRequestsByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest p LEFT JOIN " . DB_PREFIX . "productRequest_description pd ON (p.productRequest_id = pd.productRequest_id) LEFT JOIN " . DB_PREFIX . "productRequest_to_category p2c ON (p.productRequest_id = p2c.productRequest_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");
								  
		return $query->rows;
	} 
	
	public function getProductRequestDescriptions($productRequest_id) {
		$productRequest_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_description WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		foreach ($query->rows as $result) {
			$productRequest_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'tag'              => $result['tag']
			);
		}
		
		return $productRequest_description_data;
	}
		
	public function getProductRequestCategories($productRequest_id) {
		$productRequest_category_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_to_category WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		foreach ($query->rows as $result) {
			$productRequest_category_data[] = $result['category_id'];
		}

		return $productRequest_category_data;
	}
	
	public function getProductRequestFilters($productRequest_id) {
		$productRequest_filter_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_filter WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		foreach ($query->rows as $result) {
			$productRequest_filter_data[] = $result['filter_id'];
		}
				
		return $productRequest_filter_data;
	}
	
	public function getProductRequestAttributes($productRequest_id) {
		$productRequest_attribute_data = array();
		
		$productRequest_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "productRequest_attribute WHERE productRequest_id = '" . (int)$productRequest_id . "' GROUP BY attribute_id");
		
		foreach ($productRequest_attribute_query->rows as $productRequest_attribute) {
			$productRequest_attribute_description_data = array();
			
			$productRequest_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_attribute WHERE productRequest_id = '" . (int)$productRequest_id . "' AND attribute_id = '" . (int)$productRequest_attribute['attribute_id'] . "'");
			
			foreach ($productRequest_attribute_description_query->rows as $productRequest_attribute_description) {
				$productRequest_attribute_description_data[$productRequest_attribute_description['language_id']] = array('text' => $productRequest_attribute_description['text']);
			}
			
			$productRequest_attribute_data[] = array(
				'attribute_id'                  => $productRequest_attribute['attribute_id'],
				'productRequest_attribute_description' => $productRequest_attribute_description_data
			);
		}
		
		return $productRequest_attribute_data;
	}
	
	public function getProductRequestOptions($productRequest_id) {
		$productRequest_option_data = array();
		
		$productRequest_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "productRequest_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.productRequest_id = '" . (int)$productRequest_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		foreach ($productRequest_option_query->rows as $productRequest_option) {
			$productRequest_option_value_data = array();	
				
			$productRequest_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_option_value WHERE productRequest_option_id = '" . (int)$productRequest_option['productRequest_option_id'] . "'");
				
			foreach ($productRequest_option_value_query->rows as $productRequest_option_value) {
				$productRequest_option_value_data[] = array(
					'productRequest_option_value_id' => $productRequest_option_value['productRequest_option_value_id'],
					'option_value_id'         => $productRequest_option_value['option_value_id'],
					'quantity'                => $productRequest_option_value['quantity'],
					'subtract'                => $productRequest_option_value['subtract'],
					'price'                   => $productRequest_option_value['price'],
					'price_prefix'            => $productRequest_option_value['price_prefix'],
					'points'                  => $productRequest_option_value['points'],
					'points_prefix'           => $productRequest_option_value['points_prefix'],						
					'weight'                  => $productRequest_option_value['weight'],
					'weight_prefix'           => $productRequest_option_value['weight_prefix']					
				);
			}
				
			$productRequest_option_data[] = array(
				'productRequest_option_id'    => $productRequest_option['productRequest_option_id'],
				'option_id'            => $productRequest_option['option_id'],
				'name'                 => $productRequest_option['name'],
				'type'                 => $productRequest_option['type'],			
				'productRequest_option_value' => $productRequest_option_value_data,
				'option_value'         => $productRequest_option['option_value'],
				'required'             => $productRequest_option['required']				
			);
		}
		
		return $productRequest_option_data;
	}
			
	public function getProductRequestImages($productRequest_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_image WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		return $query->rows;
	}
	
	public function getProductRequestDiscounts($productRequest_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_discount WHERE productRequest_id = '" . (int)$productRequest_id . "' ORDER BY quantity, priority, price");
		
		return $query->rows;
	}
	
	public function getProductRequestSpecials($productRequest_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_special WHERE productRequest_id = '" . (int)$productRequest_id . "' ORDER BY priority, price");
		
		return $query->rows;
	}
	
	public function getProductRequestRewards($productRequest_id) {
		$productRequest_reward_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_reward WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		foreach ($query->rows as $result) {
			$productRequest_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}
		
		return $productRequest_reward_data;
	}
		
	public function getProductRequestDownloads($productRequest_id) {
		$productRequest_download_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_to_download WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		foreach ($query->rows as $result) {
			$productRequest_download_data[] = $result['download_id'];
		}
		
		return $productRequest_download_data;
	}

	public function getProductRequestStores($productRequest_id) {
		$productRequest_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_to_store WHERE productRequest_id = '" . (int)$productRequest_id . "'");

		foreach ($query->rows as $result) {
			$productRequest_store_data[] = $result['store_id'];
		}
		
		return $productRequest_store_data;
	}

	public function getProductRequestLayouts($productRequest_id) {
		$productRequest_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_to_layout WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		foreach ($query->rows as $result) {
			$productRequest_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $productRequest_layout_data;
	}

	public function getProductRequestRelated($productRequest_id) {
		$productRequest_related_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "productRequest_related WHERE productRequest_id = '" . (int)$productRequest_id . "'");
		
		foreach ($query->rows as $result) {
			$productRequest_related_data[] = $result['related_id'];
		}
		
		return $productRequest_related_data;
	}
	
	public function getTotalProductRequests($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.productRequest_id) AS total FROM " . DB_PREFIX . "productRequest p LEFT JOIN " . DB_PREFIX . "productRequest_description pd ON (p.productRequest_id = pd.productRequest_id)";
                
                $sql .= " LEFT JOIN " . DB_PREFIX . "customer cu ON (p.customer_id = cu.customer_id)";	
                
		if (!empty($data['filter_category_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "productRequest_to_category p2c ON (p.productRequest_id = p2c.productRequest_id)";			
		}
		 
		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
               	  
                if (!empty($data['filter_email'])) {
			$sql .= " AND cu.email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
                
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
		
                $sql .= " And p.type = 0 "; 
                
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	
	public function getTotalProductRequestsByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}
		
	public function getTotalProductRequestsByStockStatusId($stock_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest WHERE stock_status_id = '" . (int)$stock_status_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalProductRequestsByWeightClassId($weight_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalProductRequestsByLengthClassId($length_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest WHERE length_class_id = '" . (int)$length_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductRequestsByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest_to_download WHERE download_id = '" . (int)$download_id . "'");
		
		return $query->row['total'];
	}
	
	public function getTotalProductRequestsByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalProductRequestsByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row['total'];
	}	
	
	public function getTotalProductRequestsByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest_option WHERE option_id = '" . (int)$option_id . "'");

		return $query->row['total'];
	}	
	
	public function getTotalProductRequestsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "productRequest_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}
?>
