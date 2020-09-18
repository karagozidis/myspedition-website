<?php  
class ControllerModuleLastEntered extends Controller {
	protected function index($setting) {
		$this->language->load('module/category');
		
    	$this->data['heading_title'] ='Newly registered members';// $this->language->get('heading_title');
		
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}
		
		if (isset($parts[0])) {
			$this->data['category_id'] = $parts[0];
		} else {
			$this->data['category_id'] = 0;
		}
		
		if (isset($parts[1])) {
			$this->data['child_id'] = $parts[1];
		} else {
			$this->data['child_id'] = 0;
		}
							
		$this->load->model('customer/customer');
                $this->load->model('localisation/country');
                
		//$this->load->model('catalog/product');

		$this->data['categories'] = array();

                $data = array(                       
                            'sort'                     => 'date_added',
                            'order'                    => 'DESC',
                            'start'                    => 0,
                            'limit'                    => 13,
                            'filter_approved'          => 1,
                            'filter_status'            => 1,  
                            );
                
		$results = $this->model_customer_customer->getCustomers($data);

                
                    	foreach ($results as $result) {
			$action = array();
		
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => ''  //$this->url->link('customer/customer/update', '&customer_id=' . $result['customer_id'] . $url, 'SSL')
			);
                        
                      //  $addresses = $this->model_customer_customer->getAddresses($result['customer_id']);
			                      
                        $country = $this->model_localisation_country->getCountry($result['country_id']);
                                            
			$this->data['customers'][] = array(
				'customer_id'    => $result['customer_id'],
				'name'           => $result['name'],
				'email'          => $result['email'],
				'customer_group' => $result['customer_group'],
				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'approved'       => ($result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'ip'             => $result['ip'],
				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected'       => isset($this->request->post['selected']) && in_array($result['customer_id'], $this->request->post['selected']),
				'action'         => $action,
                                'company'        =>$result['company'],// $addresses[1]['company'],
                                'description'    => $result['description'],// $addresses[1]['address_1'],
                                'country'        => $country                           
			);
		}	
                
                
		/*foreach ($categories as $category) {
			$total = $this->model_catalog_product->getTotalProducts(array('filter_category_id' => $category['category_id']));

			$children_data = array();

			$children = $this->model_catalog_category->getCategories($category['category_id']);

			foreach ($children as $child) {
				$data = array(
					'filter_category_id'  => $child['category_id'],
					'filter_sub_category' => true
				);

				$product_total = $this->model_catalog_product->getTotalProducts($data);

				$total += $product_total;

				$children_data[] = array(
					'category_id' => $child['category_id'],
					'name'        => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
					'href'        => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])	
				);		
			}

			$this->data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $total . ')' : ''),
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
			);	
		}*/
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/lastEntered.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/lastEntered.tpl';
		} else {
			$this->template = 'default/template/module/lastEntered.tpl';
		}
		
		$this->render();
  	}
}
?>