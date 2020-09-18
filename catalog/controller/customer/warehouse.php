<?php    
class ControllerCustomerWarehouse extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->language->load('customer/customer');
		 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('account/address');
		
    	$this->getList();
  	}
  
        public function main() {
	$this->language->load('customer/customer');
        $this->load->model('account/address');
        $this->load->model('localisation/country');
         
        $this->data['companies_by_country_text'] = 'Warehouses by country';
        $this->data['view_all_companies_text'] = 'View list';
        
        $warehouses = $this->model_account_address->getWarehousesAll();
        $this->data['countries'] = $this->model_localisation_country->getCountries();
        
        foreach($warehouses as $warehouse)
            {
              $this->data['warehouses'][] = array(
				'address_id'        => $warehouse['address_id'],
				'customer_id'       => $warehouse['customer_id'],
				'lat'      => $warehouse['lat'],
				'lng'      => $warehouse['lng'],
                                'href'     => '?route=customer/warehouse/view&address_id='.$warehouse['address_id']// $this->url->link('customer/warehouse/view', '&address_id='.$warehouse['address_id'], 'SSL')
             
			);
            
            }
       // $this->data['warehouses'] = $this->model_account_address->getWarehousesAll();
        
    	$this->document->setTitle($this->language->get('heading_title'));
		
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/warehouse_main.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/warehouse_main.tpl';
		} else {
			$this->template = 'default/template/customer/warehouse_main.tpl';
		}
		
                
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());       		
  	}  
        
  	public function insert() {
		$this->language->load('customer/customer');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('customer/customer');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	$this->model_customer_customer->addCustomer($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
		  
			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}
					
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
							
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('customer/customer', $url, 'SSL'));
		}
    	
    	$this->getForm();
  	} 
   
  	public function update() {
		$this->language->load('customer/customer');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('customer/customer');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_customer_customer->editCustomer($this->request->get['customer_id'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}
			
			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}
					
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
						
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('customer/customer',$url, 'SSL'));
		}
    
    	$this->getForm();
  	}   

  	public function delete() {
		$this->language->load('customer/customer');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('customer/customer');
			
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $customer_id) {
				$this->model_customer_customer->deleteCustomer($customer_id);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}	
				
			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}
					
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
						
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('customer/customer',$url, 'SSL'));
    	}
    
    	$this->getList();
  	}  
	
	public function approve() {
		$this->language->load('customer/customer');
    	
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('customer/customer');
		
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		} elseif (isset($this->request->post['selected'])) {
			$approved = 0;
			
			foreach ($this->request->post['selected'] as $customer_id) {
				$customer_info = $this->model_customer_customer->getCustomer($customer_id);
				
				if ($customer_info && !$customer_info['approved']) {
					$this->model_customer_customer->approve($customer_id);
					
					$approved++;
				}
			} 
			
			$this->session->data['success'] = sprintf($this->language->get('text_approved'), $approved);	
			
			$url = '';
		
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}
				
			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}
						
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
						
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
							
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}	
	
			$this->redirect($this->url->link('customer/customer', $url, 'SSL'));			
		}
		
		$this->getList();
	} 
        
        
      	public function view() {
                if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
            
                $this->language->load('account/address');
                $this->document->setTitle($this->language->get('heading_title'));
                $this->load->model('account/address');
                $this->getForm();
  	}
        
  	protected function getList() {
            
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	); 

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('account/address', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);
	
        
        if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}	
                
        if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}
                
        if (isset($this->request->get['country_id'])) {
			$country_id = $this->request->get['country_id'];
		} else {
			$country_id = '';
		}
                
    	$this->data['heading_title'] = $this->language->get('heading_title');
    	$this->data['text_address_book'] = $this->language->get('text_address_book');
    	$this->data['button_new_address'] = $this->language->get('button_new_address');
    	$this->data['button_edit'] = $this->language->get('button_edit');
    	$this->data['button_delete'] = $this->language->get('button_delete');
	$this->data['button_back'] = $this->language->get('button_back');
        $this->data['text_no_results'] = "No results";
        
        
	if (isset($this->error['warning'])) {
    		$this->data['error_warning'] = $this->error['warning'];
	} else {
			$this->data['error_warning'] = '';
		}
		
	if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
    		unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
                
		
    	$this->data['addresses'] = array();
        
        $data = array(
                     'country_id'   => $country_id,
                     'start'        => ($page - 1) * $limit,
                     'limit'        => $limit 
                     );    
        
	$results = $this->model_account_address->getWarehousesAll($data);
        $warehouse_total = $this->model_account_address->getTotalWarehousesAll($data);

        $this->load->model('customer/customer');   
        
         
    	foreach ($results as $result) {
		if ($result['address_format']) {
      			$format = $result['address_format'];
    		} else {
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
			}
		
    		$find = array(
                            '{firstname}',
                            '{lastname}',
                            '{company}',
                            '{address_1}',
                            '{address_2}',
                            '{city}',
                            '{postcode}',
                            '{zone}',
                            '{zone_code}',
                            '{country}'
			);
	
		$replace = array(
                            'firstname' => $result['firstname'],
                            'lastname'  => $result['lastname'],
                            'company'   => $result['company'],
                            'address_1' => $result['address_1'],
                            'address_2' => $result['address_2'],
                            'city'      => $result['city'],
                            'postcode'  => $result['postcode'],
                            'zone'      => $result['zone'],
                            'zone_code' => $result['zone_code'],
                            'country'   => $result['country'] 
			);
                
                $this->data['warehouses'][] = array(
                    'address_id' => $result['address_id'],
                    'customer' =>  $this->model_customer_customer->getCustomer( $result['customer_id'] ) ,
                    'firstname' => $result['firstname'],
                    'lastname' => $result['lastname'],
                    'company' => $result['company'],
                    'company_id' => $result['company_id'],
                    'address_1' => $result['address_1'],
                    'address_2' => $result['address_2'],
                    'city' => $result['city'],
                    'country_id' => $result['country_id'],
                    'zone_id' => $result['zone_id'],
                    'squaremeters' => $result['squaremeters'],
                    'wh_height' => $result['wh_height'],
                    'wh_ramp_number' => $result['wh_ramp_number'],
                    'wh_industrial_floor' => $result['wh_industrial_floor'],
                    'wh_firefighting' => $result['wh_firefighting'],
                    'zone'      => $result['zone'],
                    'country'   => $result['country'],
                    'country_image' => $result['country_image']
                    );
                    
                }

               // echo ' warehouse total ' .$warehouse_total;
              //  echo '<br> page '. $page;
                //echo '<br> limit '. $this->config->get('config_catalog_limit');
               // echo '<br> text pagination '. $this->language->get('text_pagination');
                 
                $pagination = new Pagination();
		$pagination->total = $warehouse_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_catalog_limit');
		$pagination->text = $this->language->get('text_pagination');
                //$pagination->url = $this->url->link('customer/warehouse', $url . '&page={page}'); 
                
                $countryId = "";
                if (isset($this->request->get['country_id']) ) 
                        $countryId = '&country_id='.$this->request->get['country_id'];
                
		$pagination->url = $this->url->link('customer/warehouse','&page={page}'. $countryId , 'SSL');	
		$this->data['pagination'] = $pagination->render();
                
                
                
                $this->data['insert'] = $this->url->link('account/address/insert', '', 'SSL');
		$this->data['back'] = $this->url->link('account/account', '', 'SSL');
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/warehouse_list.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/warehouse_list.tpl';
		} else {
			$this->template = 'default/template/customer/warehouse_list.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'		
		);
						
		$this->response->setOutput($this->render());		
  	}
  
  	protected function getForm() {
      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),       	
        	'separator' => false
      	); 

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('account/address', '', 'SSL'),        	
        	'separator' => $this->language->get('text_separator')
      	);
		
						
    	$this->data['heading_title'] = $this->language->get('heading_title');
    	
	$this->data['text_edit_address'] = $this->language->get('text_edit_address');
    	$this->data['text_yes'] = $this->language->get('text_yes');
    	$this->data['text_no'] = $this->language->get('text_no');
	$this->data['text_select'] = $this->language->get('text_select');
	$this->data['text_none'] = $this->language->get('text_none');
		
    	$this->data['entry_firstname'] = $this->language->get('entry_firstname');
    	$this->data['entry_lastname'] = $this->language->get('entry_lastname');
    	$this->data['entry_company'] = $this->language->get('entry_company');
	$this->data['entry_company_id'] = $this->language->get('entry_company_id');
	$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');		
    	$this->data['entry_address_1'] = $this->language->get('entry_address_1');
    	$this->data['entry_address_2'] = $this->language->get('entry_address_2');
    	$this->data['entry_postcode'] = $this->language->get('entry_postcode');
    	$this->data['entry_city'] = $this->language->get('entry_city');
    	$this->data['entry_country'] = $this->language->get('entry_country');
    	$this->data['entry_zone'] = $this->language->get('entry_zone');
    	$this->data['entry_default'] = $this->language->get('entry_default');

    	$this->data['button_continue'] = $this->language->get('button_continue');
    	$this->data['button_back'] = $this->language->get('button_back');

        $this->data['upgradeUrl'] =  $this->url->link('account/upgrade', 'SSL'); 
                $this->load->model('catalog/storedTexts');
                $this->data['upgradeSmallText'] = $this->model_catalog_storedTexts->getStoredText('upgradeSmallText'); 
                
                $cg =$this->customer->getCustomerGroup();
                if( $cg['view_telephone'] == true)
                    $this->data['view_telephone'] = true; 
                else 
                    $this->data['view_telephone'] = false;
                if( $cg['view_skype'] == true)
                    $this->data['view_skype'] = true; 
                else 
                    $this->data['view_skype'] = false; 
        
          if ($this->customer->isLogged()) {	 
                         $this->data['isLogged'] = 'true';
                    }       
                
    	if (isset($this->request->get['address_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$address_info = $this->model_account_address->getAddressAll($this->request->get['address_id']);
                       
		}
                
                
       $this->load->model('customer/customer');    
       $this->data['customer'] = $this->model_customer_customer->getCustomer( $address_info['customer_id'] ); 
                          
	
    	if (!empty($address_info)) {
      		$this->data['firstname'] = $address_info['firstname'];
    	} else {
			$this->data['firstname'] = '';
		}
                
        if (!empty($address_info)) {
      		$this->data['lastname'] = $address_info['lastname'];
    	} else {
			$this->data['lastname'] = '';
		}

    	if (!empty($address_info)) {
			$this->data['company'] = $address_info['company'];
	} else {
      		$this->data['company'] = '';
    	}
		
	if (!empty($address_info)) {
		$this->data['company_id'] = $address_info['company_id'];			
	} else {
		$this->data['company_id'] = '';
		}
		
        if (!empty($address_info)) {
		$this->data['warehouse'] = $address_info['warehouse'];			
        } else {
		$this->data['warehouse'] = '';
		}
                
        if (!empty($address_info)) {
		$this->data['wh_industrial_floor'] = $address_info['wh_industrial_floor'];			
	} else {
		$this->data['wh_industrial_floor'] = '';
		}
                
                
        if (!empty($address_info)) {
		$this->data['wh_firefighting'] = $address_info['wh_firefighting'];			
	} else {
		$this->data['wh_firefighting'] = '';
		}
                
        if (!empty($address_info)) {
		$this->data['squaremeters'] = $address_info['squaremeters'];			
	} else {
		$this->data['squaremeters'] = '';
                } 
                
        if (!empty($address_info)) {
		$this->data['wh_height'] = $address_info['wh_height'];			
	} else {
		$this->data['wh_height'] = '';
		} 
                
        if (!empty($address_info)) {
		$this->data['wh_ramp_number'] = $address_info['wh_ramp_number'];			
	} else {
		$this->data['wh_ramp_number'] = '';
		} 
                
        if (!empty($address_info)) {
		$this->data['lat'] = $address_info['lat'];			
	} else {
		$this->data['lat'] = '';
		} 
                
        if (!empty($address_info)) {
		$this->data['lng'] = $address_info['lng'];			
	} else {
		$this->data['lng'] = '';
		} 
                
	if (!empty($address_info)) {
		$this->data['tax_id'] = $address_info['tax_id'];			
	} else {
		$this->data['tax_id'] = '';
		}
		
	$this->load->model('account/customer_group');
		
	$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());
		
	if ($customer_group_info) {
		$this->data['company_id_display'] = $customer_group_info['company_id_display'];
	} else {
		$this->data['company_id_display'] = '';
	}
		
		if ($customer_group_info) {
			$this->data['tax_id_display'] = $customer_group_info['tax_id_display'];
		} else {
			$this->data['tax_id_display'] = '';
		}
	
        if (isset($this->request->post['telephone'])) {
      		$this->data['telephone'] = $this->request->post['telephone'];
    	} elseif (!empty($address_info)) {
			$this->data['telephone'] = $address_info['telephone'];
	} else {
      		$this->data['telephone'] = '';
    	}	

                
    	if (isset($this->request->post['address_1'])) {
      		$this->data['address_1'] = $this->request->post['address_1'];
    	} elseif (!empty($address_info)) {
			$this->data['address_1'] = $address_info['address_1'];
		} else {
      		$this->data['address_1'] = '';
    	}

    	if (isset($this->request->post['address_2'])) {
      		$this->data['address_2'] = $this->request->post['address_2'];
    	} elseif (!empty($address_info)) {
			$this->data['address_2'] = $address_info['address_2'];
		} else {
      		$this->data['address_2'] = '';
    	}	

        
        
    	if (isset($this->request->post['postcode'])) {
      		$this->data['postcode'] = $this->request->post['postcode'];
    	} elseif (!empty($address_info)) {
			$this->data['postcode'] = $address_info['postcode'];			
		} else {
      		$this->data['postcode'] = '';
    	}

    	if (isset($this->request->post['city'])) {
      		$this->data['city'] = $this->request->post['city'];
    	} elseif (!empty($address_info)) {
			$this->data['city'] = $address_info['city'];
		} else {
      		$this->data['city'] = '';
    	}

        $this->load->model('localisation/country');
       
        
    	if (isset($this->request->post['country_id'])) {
      		$this->data['country'] =
                          $this->model_localisation_country->getCountry( $this->request->post['country_id'] );
    	}  elseif (!empty($address_info)) {
      		$this->data['country'] = 
                         $this->model_localisation_country->getCountry( $address_info['country_id'] );			
    	} else {
      		$this->data['country'] = '---';
    	}
        
        $this->load->model('localisation/zone');
        
    	if (isset($this->request->post['zone_id'])) {
      		$this->data['zone'] = 
                        $this->model_localisation_zone->getZone(  $this->request->post['zone_id']  );
    	}  elseif (!empty($address_info)) {
      		$this->data['zone'] = 
                        $this->model_localisation_zone->getZone(  $address_info['zone_id']  );
    	} else {
      		$this->data['zone'] = '---';
    	}
			
    	$this->data['countries'] = $this->model_localisation_country->getCountries();

    	if (isset($this->request->post['default'])) {
      		$this->data['default'] = $this->request->post['default'];
    	} elseif (isset($this->request->get['address_id'])) {
      		$this->data['default'] = $this->customer->getAddressId() == $this->request->get['address_id'];
    	} else {
			$this->data['default'] = false;
		}

        $this->load->model('account/warehouseType');        
         
        if (isset($this->request->post['warehouse_type_id'])) 
            {
      		$this->data['warehouse_type'] = 
                        $this->model_account_warehouseType->getWarehouseType(
                        $this->request->post['warehouse_type_id']
                            );
            } 
        elseif (!empty($address_info)) 
            {
      		$this->data['warehouse_type'] = 
                        $this->model_account_warehouseType->getWarehouseType(
                        $address_info['warehouse_type_id'] 
                                );
            } 
        else 
            {
		$this->data['warehouse_type'] = '';
            }        
                
                
    	$this->data['back'] = $this->url->link('account/address', '', 'SSL');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/warehouse_form.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/warehouse_form.tpl';
		} else {
			$this->template = 'default/template/customer/warehouse_form.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'		
		);
						
		$this->response->setOutput($this->render());
	}
			 
  	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'customer/customer')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
      		$this->error['firstname'] = $this->language->get('error_firstname');
    	}

    	if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
      		$this->error['lastname'] = $this->language->get('error_lastname');
    	}

		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}
		
		$customer_info = $this->model_customer_customer->getCustomerByEmail($this->request->post['email']);
		
		if (!isset($this->request->get['customer_id'])) {
			if ($customer_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} else {
			if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		}
		
    	if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
      		$this->error['telephone'] = $this->language->get('error_telephone');
    	}

    	if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))) {
      		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
        		$this->error['password'] = $this->language->get('error_password');
      		}
	
	  		if ($this->request->post['password'] != $this->request->post['confirm']) {
	    		$this->error['confirm'] = $this->language->get('error_confirm');
	  		}
    	}

		if (isset($this->request->post['address'])) {
			foreach ($this->request->post['address'] as $key => $value) {
				if ((utf8_strlen($value['firstname']) < 1) || (utf8_strlen($value['firstname']) > 32)) {
					$this->error['address_firstname'][$key] = $this->language->get('error_firstname');
				}
				
				if ((utf8_strlen($value['lastname']) < 1) || (utf8_strlen($value['lastname']) > 32)) {
					$this->error['address_lastname'][$key] = $this->language->get('error_lastname');
				}	
				
				if ((utf8_strlen($value['address_1']) < 3) || (utf8_strlen($value['address_1']) > 128)) {
					$this->error['address_address_1'][$key] = $this->language->get('error_address_1');
				}
			
				if ((utf8_strlen($value['city']) < 2) || (utf8_strlen($value['city']) > 128)) {
					$this->error['address_city'][$key] = $this->language->get('error_city');
				} 
	
				$this->load->model('localisation/country');
				
				$country_info = $this->model_localisation_country->getCountry($value['country_id']);
						
				if ($country_info) {
					if ($country_info['postcode_required'] && (utf8_strlen($value['postcode']) < 2) || (utf8_strlen($value['postcode']) > 10)) {
						$this->error['address_postcode'][$key] = $this->language->get('error_postcode');
					}
					
					// VAT Validation
					$this->load->helper('vat');
					
					if ($this->config->get('config_vat') && $value['tax_id'] && (vat_validation($country_info['iso_code_2'], $value['tax_id']) == 'invalid')) {
						$this->error['address_tax_id'][$key] = $this->language->get('error_vat');
					}
				}
			
				if ($value['country_id'] == '') {
					$this->error['address_country'][$key] = $this->language->get('error_country');
				}
				
				if (!isset($value['zone_id']) || $value['zone_id'] == '') {
					$this->error['address_zone'][$key] = $this->language->get('error_zone');
				}	
			}
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}    

  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'customer/customer')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}	
	  	 
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  
  	} 
	
	public function login() {
		$json = array();
		
		if (isset($this->request->get['customer_id'])) {
			$customer_id = $this->request->get['customer_id'];
		} else {
			$customer_id = 0;
		}
		
		$this->load->model('customer/customer');
		
		$customer_info = $this->model_customer_customer->getCustomer($customer_id);
				
		if ($customer_info) {
			$token ="";// md5(mt_rand());
			
			//$this->model_customer_customer->editToken($customer_id, $token);
			
			if (isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			} else {
				$store_id = 0;
			}
					
			$this->load->model('setting/store');
			
			$store_info = $this->model_setting_store->getStore($store_id);
			
			if ($store_info) {
				$this->redirect($store_info['url'] . 'index.php?route=account/login');
			} else { 
				$this->redirect(HTTP_CATALOG . 'index.php?route=account/login');
			}
		} else {
			$this->language->load('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->data['heading_title'] = $this->language->get('heading_title');

			$this->data['text_not_found'] = $this->language->get('text_not_found');

			$this->data['breadcrumbs'] = array();

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home','', 'SSL'),
				'separator' => false
			);

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('error/not_found','', 'SSL'),
				'separator' => ' :: '
			);
		
			//$this->template = 'error/not_found.tpl';
                        
                        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                                $this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
                        } else {
                                $this->template = 'default/template/error/not_found.tpl';
                        }
		
                        
			$this->children = array(
				'common/header',
				'common/footer'
			);
		
			$this->response->setOutput($this->render());
		}
	}
	
	public function history() {
    	$this->language->load('customer/customer');
		
		$this->load->model('customer/customer');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'customer/customer')) { 
			$this->model_customer_customer->addHistory($this->request->get['customer_id'], $this->request->post['comment']);
				
			$this->data['success'] = $this->language->get('text_success');
		} else {
			$this->data['success'] = '';
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'customer/customer')) {
			$this->data['error_warning'] = $this->language->get('error_permission');
		} else {
			$this->data['error_warning'] = '';
		}		
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_comment'] = $this->language->get('column_comment');
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  
		
		$this->data['histories'] = array();
			
		$results = $this->model_customer_customer->getHistories($this->request->get['customer_id'], ($page - 1) * 10, 10);
      		
		foreach ($results as $result) {
        	$this->data['histories'][] = array(
				'comment'     => $result['comment'],
        		'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}			
		
		$transaction_total = $this->model_customer_customer->getTotalHistories($this->request->get['customer_id']);
			
		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('customer/customer/history', '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		//$this->template = 'customer/customer_history.tpl';	
                
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/customer_history.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/customer_history.tpl';
		} else {
			$this->template = 'default/template/customer/customer_history.tpl';
		}
		
		
		$this->response->setOutput($this->render());
	}
		
	public function transaction() {
    	$this->language->load('customer/customer');
		
		$this->load->model('customer/customer');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'customer/customer')) { 
			$this->model_customer_customer->addTransaction($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['amount']);
				
			$this->data['success'] = $this->language->get('text_success');
		} else {
			$this->data['success'] = '';
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'customer/customer')) {
			$this->data['error_warning'] = $this->language->get('error_permission');
		} else {
			$this->data['error_warning'] = '';
		}		
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_balance'] = $this->language->get('text_balance');
		
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_amount'] = $this->language->get('column_amount');
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  
		
		$this->data['transactions'] = array();
			
		$results = $this->model_customer_customer->getTransactions($this->request->get['customer_id'], ($page - 1) * 10, 10);
      		
		foreach ($results as $result) {
        	$this->data['transactions'][] = array(
				'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')),
				'description' => $result['description'],
        		'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}			
		
		$this->data['balance'] = $this->currency->format($this->model_customer_customer->getTransactionTotal($this->request->get['customer_id']), $this->config->get('config_currency'));
		
		$transaction_total = $this->model_customer_customer->getTotalTransactions($this->request->get['customer_id']);
			
		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('customer/customer/transaction', '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		//$this->template = 'customer/customer_transaction.tpl';	
                
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/customer_transaction.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/customer_transaction.tpl';
		} else {
			$this->template = 'default/template/customer/customer_transaction.tpl';
		}
		
		$this->response->setOutput($this->render());
	}
			
	public function reward() {
    	$this->language->load('customer/customer');
		
		$this->load->model('customer/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'customer/customer')) { 
			$this->model_customer_customer->addReward($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['points']);
				
			$this->data['success'] = $this->language->get('text_success');
		} else {
			$this->data['success'] = '';
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'customer/customer')) {
			$this->data['error_warning'] = $this->language->get('error_permission');
		} else {
			$this->data['error_warning'] = '';
		}	
				
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_balance'] = $this->language->get('text_balance');
		
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_points'] = $this->language->get('column_points');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  
		
		$this->data['rewards'] = array();
			
		$results = $this->model_customer_customer->getRewards($this->request->get['customer_id'], ($page - 1) * 10, 10);
      		
		foreach ($results as $result) {
        	$this->data['rewards'][] = array(
				'points'      => $result['points'],
				'description' => $result['description'],
        		'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}			
		
		$this->data['balance'] = $this->model_customer_customer->getRewardTotal($this->request->get['customer_id']);
		
		$reward_total = $this->model_customer_customer->getTotalRewards($this->request->get['customer_id']);
			
		$pagination = new Pagination();
		$pagination->total = $reward_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('customer/customer/reward',$this->request->get['customer_id'] . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		//$this->template = 'customer/customer_reward.tpl';
                
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/customer_reward.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/customer_reward.tpl';
		} else {
			$this->template = 'default/template/customer/customer_reward.tpl';
		}
                
		
		$this->response->setOutput($this->render());
	}
	
	public function addBanIP() {
		$this->language->load('customer/customer');
		
		$json = array();

		if (isset($this->request->post['ip'])) { 
			if (!$this->user->hasPermission('modify', 'customer/customer')) {
				$json['error'] = $this->language->get('error_permission');
			} else {
				$this->load->model('customer/customer');
				
				$this->model_customer_customer->addBanIP($this->request->post['ip']);
				
				$json['success'] = $this->language->get('text_success');
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function removeBanIP() {
		$this->language->load('customer/customer');
		
		$json = array();

		if (isset($this->request->post['ip'])) { 
			if (!$this->user->hasPermission('modify', 'customer/customer')) {
				$json['error'] = $this->language->get('error_permission');
			} else {
				$this->load->model('customer/customer');
				
				$this->model_customer_customer->removeBanIP($this->request->post['ip']);
				
				$json['success'] = $this->language->get('text_success');
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}

	public function autocomplete() {
		$json = array();
		
		if (isset($this->request->get['filter_name'])) {
			$this->load->model('customer/customer');
			
			$data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);
		
			$results = $this->model_customer_customer->getCustomers($data);
			
			foreach ($results as $result) {
				$json[] = array(
					'customer_id'       => $result['customer_id'], 
					'customer_group_id' => $result['customer_group_id'],
					'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'customer_group'    => $result['customer_group'],
					'firstname'         => $result['firstname'],
					'lastname'          => $result['lastname'],
					'email'             => $result['email'],
					'telephone'         => $result['telephone'],
					'fax'               => $result['fax'],
					'address'           => $this->model_customer_customer->getAddresses($result['customer_id'])
				);					
			}
		}

		$sort_order = array();
	  
		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->setOutput(json_encode($json));
	}		
		
	public function country() {
		$json = array();
		
		$this->load->model('localisation/country');

    	$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);
		
		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']		
			);
		}
		
		$this->response->setOutput(json_encode($json));
	}
		
	public function address() {
		$json = array();
		
		if (!empty($this->request->get['address_id'])) {
			$this->load->model('customer/customer');
			
			$json = $this->model_customer_customer->getAddress($this->request->get['address_id']);
		}

		$this->response->setOutput(json_encode($json));		
	}
}
?>