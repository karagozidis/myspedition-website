<?php    
class ControllerAccountFavoriteCustomer extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->language->load('customer/customer');
		 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('customer/customer');
		
    	$this->getList();
  	}
  
        public function main() {
	$this->language->load('customer/customer');

        $this->data['companies_by_country_text'] = $this->language->get('companies_by_country_text');
        $this->data['view_all_companies_text'] = $this->language->get('view_all_companies_text');
        
    	$this->document->setTitle($this->language->get('heading_title'));
		
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/customer_main.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/customer_main.tpl';
		} else {
			$this->template = 'default/template/customer/customer_main.tpl';
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
   
        
        public function addInterestCustomer() {
		$json = array();

		if (isset($this->request->post['customer_id'])) {
			$customer_id = $this->request->post['customer_id'];
		} else {
                        $json['error'] = 'Error'; 
                        $this->response->setOutput(json_encode($json));
                        return;
		}

                $data = array(
                 'customer_id' => $this->customer->getId(),
                 'interest_customer_id' => $customer_id   
                );
                
		$this->load->model('account/customer');
                $result = $this->model_account_customer->checkInterestCustomer($data);
                
                if ($result == true)  
                    {
                    $this->model_account_customer->deleteInterestCustomers($customer_id);
                     $json['added'] = false;
                    }
                else 
                    {
                    $this->model_account_customer->addInterestCustomer($data);
                    $json['added'] = true;
                    }  
                    
                $json['success'] = 'Success fields';
          
                
		$this->response->setOutput(json_encode($json));
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
    
  	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = null;
		}
		
		if (isset($this->request->get['filter_customer_group_id'])) {
			$filter_customer_group_id = $this->request->get['filter_customer_group_id'];
		} else {
			$filter_customer_group_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->get['filter_approved'])) {
			$filter_approved = $this->request->get['filter_approved'];
		} else {
			$filter_approved = null;
		}
		
		if (isset($this->request->get['filter_ip'])) {
			$filter_ip = $this->request->get['filter_ip'];
		} else {
			$filter_ip = null;
		}
				
		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}		
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'cg.priority_view, c.verified DESC, c.company';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', '', 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('customer/customer', $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['approve'] = $this->url->link('customer/customer/approve', $url, 'SSL');
		$this->data['insert'] = $this->url->link('customer/customer/insert',  $url, 'SSL');
		$this->data['delete'] = $this->url->link('customer/customer/delete', $url, 'SSL');

		$this->data['customers'] = array();

               $this->load->model('localisation/country');
                
              /*  if(isset($this->request->get['country_id']))
                {
                   $data = array(
			'filter_name'              => $filter_name, 
			'filter_email'             => $filter_email, 
			'filter_customer_group_id' => $filter_customer_group_id, 
			'filter_status'            => $filter_status, 
			'filter_approved'          => $filter_approved, 
			'filter_date_added'        => $filter_date_added,
			'filter_ip'                => $filter_ip,
                        'filter_country_id'        => $this->request->get['country_id'],
			'sort'                     => $sort,
			'order'                    => $order,
			'start'                    => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                    => $this->config->get('config_admin_limit')                     
                        ); 
                   
                   $country = $this->model_localisation_country->getCountry($this->request->get['country_id']);                                 
                   $this->data['country'] =  $country;                  
                }
                else
                {     */           
                    $data = array(
                            //'filter_name'              => $filter_name, 
                           // 'filter_email'             => $filter_email, 
                           // 'filter_customer_group_id' => $filter_customer_group_id, 
                            'filter_status'            => $filter_status, 
                            'filter_approved'          => $filter_approved, 
                            //'filter_date_added'        => $filter_date_added,
                            //'filter_ip'                => $filter_ip,
                            'in_interest_customer'     => $this->customer->getId(),
                            'sort'                     => $sort,
                            'order'                    => $order,
                            'start'                    => ($page - 1) * $this->config->get('config_admin_limit'),
                            'limit'                    => $this->config->get('config_admin_limit')
                            );
             //   }
		

                
		$customer_total = $this->model_customer_customer->getTotalCustomers($data);
	
		$results = $this->model_customer_customer->getCustomers($data);
 
                $this->load->model('catalog/companyType');
                
                
                
                
    	foreach ($results as $result) {
			$action = array();
		
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('customer/customer/update', '&customer_id=' . $result['customer_id'] . $url, 'SSL')
			);
                        
                      //  $addresses = $this->model_customer_customer->getAddresses($result['customer_id']);
			                      
                        $country = $this->model_localisation_country->getCountry($result['country_id']);
                        $company_type = $this->model_catalog_companyType->getCompanyType($result['company_type_id']) ;
                        
			$this->data['customers'][] = array(
				'customer_id'    => $result['customer_id'],
				'name'           => $result['name'],
				'email'          => $result['email'],
                                'verified'          => $result['verified'],
				'customer_group' => $result['customer_group'],
				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'approved'       => ($result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'ip'             => $result['ip'],
				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected'       => isset($this->request->post['selected']) && in_array($result['customer_id'], $this->request->post['selected']),
				'action'         => $action,
                                'company'        => $result['company'],// $addresses[1]['company'],
                                'description'    => $result['c_description'],// $addresses[1]['address_1'],
                                'country'        => $country , 
                                'company_type'   => $company_type
			);
		}	
					
		$this->data['heading_title'] = "My favorite Companies";
                $this->data['country_selected_text'] = $this->language->get('country_selected_text');
		$this->data['back_to_map_text'] = $this->language->get('back_to_map_text');
		$this->data['country_text'] = $this->language->get('country_text');
		$this->data['company_text'] = $this->language->get('company_text');
                $this->data['company_name_text'] = $this->language->get('company_name_text');
		$this->data['manager_name_text'] = $this->language->get('manager_name_text');
		$this->data['description_text'] = $this->language->get('description_text');
		$this->data['view_text'] = $this->language->get('view_text');
                $this->data['general_text'] = $this->language->get('general_text');
		$this->data['freights_text'] = $this->language->get('freights_text');
		$this->data['trucks_text'] = $this->language->get('trucks_text');
		$this->data['loading_date_text'] = $this->language->get('loading_date_text');
                $this->data['trailer_text'] = $this->language->get('trailer_text');
		$this->data['loading_country_text'] = $this->language->get('loading_country_text');
		$this->data['region_state_text'] = $this->language->get('region_state_text');
		$this->data['city_area_text'] = $this->language->get('city_area_text');
                $this->data['offloading_country_text'] = $this->language->get('offloading_country_text');
                $this->data['company_text'] = $this->language->get('company_text');
                $this->data['loading_date_text'] = $this->language->get('loading_date_text');
                $this->data['trailer_text'] = $this->language->get('trailer_text');
                $this->data['owner_text'] = $this->language->get('owner_text');
                $this->data['company_address_text'] = $this->language->get('company_address_text');
                $this->data['company_name_text'] = $this->language->get('company_name_text');
                $this->data['type_text'] = $this->language->get('type_text');
                $this->data['country_text'] = $this->language->get('country_text');
                $this->data['description_text'] = $this->language->get('description_text');
                $this->data['column_email'] = $this->language->get('column_email');
                $this->data['text_no_results'] = $this->language->get('text_no_results');
                
		//$this->data['token'] = "";//$this->session->data['token'];

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
			
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_name'] = $this->url->link('customer/customer','&sort=name' . $url, 'SSL');
		$this->data['sort_email'] = $this->url->link('customer/customer','&sort=c.email' . $url, 'SSL');
		$this->data['sort_customer_group'] = $this->url->link('customer/customer','&sort=customer_group' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('customer/customer','&sort=c.status' . $url, 'SSL');
		$this->data['sort_approved'] = $this->url->link('customer/customer','&sort=c.approved' . $url, 'SSL');
		$this->data['sort_ip'] = $this->url->link('customer/customer','&sort=c.ip' . $url, 'SSL');
		$this->data['sort_date_added'] = $this->url->link('customer/customer','&sort=c.date_added' . $url, 'SSL');
		
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

		$pagination = new Pagination();
		$pagination->total = $customer_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
                 
                $countryId = "";
                if (isset($this->request->get['country_id']) ) 
                        $countryId = '&country_id='.$this->request->get['country_id'];
                
		$pagination->url = $this->url->link('customer/customer',$url . '&page={page}'. $countryId , 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		$this->data['filter_name'] = $filter_name;
		$this->data['filter_email'] = $filter_email;
		$this->data['filter_customer_group_id'] = $filter_customer_group_id;
		$this->data['filter_status'] = $filter_status;
		$this->data['filter_approved'] = $filter_approved;
		$this->data['filter_ip'] = $filter_ip;
		$this->data['filter_date_added'] = $filter_date_added;
		
		$this->load->model('customer/customer_group');
		
    	$this->data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
				
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		//$this->template = 'customer/customer_list.tpl';
                
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/favorite_customer_list.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/favorite_customer_list.tpl';
		} else {
			$this->template = 'default/template/account/favorite_customer_list.tpl';
		}
		
                
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
  
  	protected function getForm() {
            
    	$this->data['entry_firstname'] = $this->language->get('entry_firstname');
    	$this->data['entry_lastname'] = $this->language->get('entry_lastname');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_telephone'] = $this->language->get('entry_telephone');
    	$this->data['entry_fax'] = $this->language->get('entry_fax');
    	$this->data['entry_password'] = $this->language->get('entry_password');
    	$this->data['entry_confirm'] = $this->language->get('entry_confirm');
		$this->data['entry_newsletter'] = $this->language->get('entry_newsletter');
    	$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_company_id'] = $this->language->get('entry_company_id');
		$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_default'] = $this->language->get('entry_default');
		$this->data['entry_comment'] = $this->language->get('entry_comment');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_amount'] = $this->language->get('entry_amount');
		$this->data['entry_points'] = $this->language->get('entry_points');
                $this->data['heading_title'] = $this->language->get('heading_title');
                $this->data['general_text'] = $this->language->get('general_text');
                $this->data['freights_text'] = $this->language->get('freights_text');
                $this->data['trucks_text'] = $this->language->get('trucks_text');
                $this->data['loading_date_text'] = $this->language->get('loading_date_text');
                $this->data['trailer_text'] = $this->language->get('trailer_text');
                $this->data['loading_country_text'] = $this->language->get('loading_country_text');
                $this->data['region_state_text'] = $this->language->get('region_state_text');
                $this->data['city_area_text'] = $this->language->get('city_area_text');
                $this->data['offloading_country_text'] = $this->language->get('offloading_country_text');
                $this->data['company_text'] = $this->language->get('company_text');
                $this->data['loading_date_text'] = $this->language->get('loading_date_text');
                $this->data['trailer_text'] = $this->language->get('trailer_text');
                $this->data['owner_text'] = $this->language->get('owner_text');
                $this->data['company_address_text'] = $this->language->get('company_address_text');
                $this->data['company_name_text'] = $this->language->get('company_name_text');
                $this->data['type_text'] = $this->language->get('type_text');
                $this->data['country_text'] = $this->language->get('country_text');
                $this->data['description_text'] = $this->language->get('description_text');
                $this->data['register_login_text'] = $this->language->get('register_login_text');
                   
                                                                                                           
		if (isset($this->request->get['customer_id'])) {
			$this->data['customer_id'] = $this->request->get['customer_id'];
		} else {
			$this->data['customer_id'] = 0;
		}

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['firstname'])) {
			$this->data['error_firstname'] = $this->error['firstname'];
		} else {
			$this->data['error_firstname'] = '';
		}

 		if (isset($this->error['lastname'])) {
			$this->data['error_lastname'] = $this->error['lastname'];
		} else {
			$this->data['error_lastname'] = '';
		}
		
 		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}
		
 		if (isset($this->error['telephone'])) {
			$this->data['error_telephone'] = $this->error['telephone'];
		} else {
			$this->data['error_telephone'] = '';
		}
		
 		if (isset($this->error['password'])) {
			$this->data['error_password'] = $this->error['password'];
		} else {
			$this->data['error_password'] = '';
		}
		
 		if (isset($this->error['confirm'])) {
			$this->data['error_confirm'] = $this->error['confirm'];
		} else {
			$this->data['error_confirm'] = '';
		}
		
		if (isset($this->error['address_firstname'])) {
			$this->data['error_address_firstname'] = $this->error['address_firstname'];
		} else {
			$this->data['error_address_firstname'] = '';
		}

 		if (isset($this->error['address_lastname'])) {
			$this->data['error_address_lastname'] = $this->error['address_lastname'];
		} else {
			$this->data['error_address_lastname'] = '';
		}
		
  		if (isset($this->error['address_tax_id'])) {
			$this->data['error_address_tax_id'] = $this->error['address_tax_id'];
		} else {
			$this->data['error_address_tax_id'] = '';
		}
				
		if (isset($this->error['address_address_1'])) {
			$this->data['error_address_address_1'] = $this->error['address_address_1'];
		} else {
			$this->data['error_address_address_1'] = '';
		}
		
		if (isset($this->error['address_city'])) {
			$this->data['error_address_city'] = $this->error['address_city'];
		} else {
			$this->data['error_address_city'] = '';
		}
		
		if (isset($this->error['address_postcode'])) {
			$this->data['error_address_postcode'] = $this->error['address_postcode'];
		} else {
			$this->data['error_address_postcode'] = '';
		}
		
		if (isset($this->error['address_country'])) {
			$this->data['error_address_country'] = $this->error['address_country'];
		} else {
			$this->data['error_address_country'] = '';
		}
		
		if (isset($this->error['address_zone'])) {
			$this->data['error_address_zone'] = $this->error['address_zone'];
		} else {
			$this->data['error_address_zone'] = '';
		}
		
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
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', '', 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('customer/customer', $url, 'SSL'),
      		'separator' => ' :: '
   		);

		if (!isset($this->request->get['customer_id'])) {
			$this->data['action'] = $this->url->link('customer/customer/insert', $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('customer/customer/update','&customer_id=' . $this->request->get['customer_id'] . $url, 'SSL');
		}
		  
    	$this->data['cancel'] = $this->url->link('customer/customer', $url, 'SSL');

    	if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$customer_info = $this->model_customer_customer->getCustomer($this->request->get['customer_id']);
    	}
			
        if (isset($this->request->post['description'])) {
      		$this->data['description'] =$this->data['description'] = html_entity_decode( $this->request->post['description'], ENT_QUOTES, 'UTF-8');
		} elseif (!empty($customer_info)) { 
			$this->data['description'] =  html_entity_decode(  $customer_info['description'], ENT_QUOTES, 'UTF-8');
		} else {
      		$this->data['description'] = '';
                }
                
      if (isset($this->request->post['company'])) {
      		$this->data['company'] = $this->request->post['company'];
		} elseif (!empty($customer_info)) { 
			$this->data['company'] = $customer_info['company'];
		} else {
      		$this->data['company'] = '';  
                }
                
     if (isset($this->request->post['verified'])) {
      		$this->data['verified'] = $this->request->post['verified'];
		} elseif (!empty($customer_info)) { 
			$this->data['verified'] = $customer_info['verified'];
		} else {
      		$this->data['verified'] = '';  
                }               
            
                $this->load->model('localisation/country');
                $country = $this->model_localisation_country->getCountry($customer_info['country_id']);               
                $this->data['country'] = $country;  


                $this->load->model('catalog/companyType');
                $company_type = $this->model_catalog_companyType->getCompanyType($customer_info['company_type_id']);           
                $this->data['company_type'] = $company_type ;
                
                
                $data = array(
                    'customer_id'           => $this->customer->getId(),
                    'interest_customer_id'  => $customer_info['customer_id']
                );
                $this->load->model('account/customer');
                $this->data['isFavorite'] = $this->model_account_customer->checkInterestCustomer($data);
                
                
                
                
                
                if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}
				
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.date_added';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
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
                
          			$this->data['products'] = array();
			
                        
                        if ( isset($this->request->post['search']) )
                            {
                            
                            if(isset($this->request->post['trailer_type_id']))
                                {                                
                                $data = array(
                                    'filter_category_id' => $category_id,
                                    'filter_filter'      => $filter, 
                                    'sort'               => $sort,
                                    'order'              => $order,
                                    'start'              => ($page - 1) * $limit,
                                    'limit'              => $limit , 
                                    'loading_country_id' => $this->request->post['loading_country_id'],
                                    'loading_zone_id' => $this->request->post['loading_zone_id'],
                                    'loading_city'       =>     $this->request->post['loading_city'],
                                    'offloading_country_id' => $this->request->post['offloading_country_id'],
                                    'offloading_zone_id' => $this->request->post['offloading_zone_id'],
                                    'offloading_city' => $this->request->post['offloading_city'],
                                    'loading_date_from' => $this->request->post['loading_date_from'],
                                    'loading_date_to' => $this->request->post['loading_date_to'],
                                    'trailer_type_id' => $this->request->post['trailer_type_id']
                                    );    
                                }
                            else
                                {
                                $data = array(
                                    'filter_category_id' => $category_id,
                                    'filter_filter'      => $filter, 
                                    'sort'               => $sort,
                                    'order'              => $order,
                                    'start'              => ($page - 1) * $limit,
                                    'limit'              => $limit , 
                                    'loading_country_id' => $this->request->post['loading_country_id'],
                                    'loading_zone_id' => $this->request->post['loading_zone_id'],
                                    'loading_city'       =>     $this->request->post['loading_city'],
                                    'offloading_country_id' => $this->request->post['offloading_country_id'],
                                    'offloading_zone_id' => $this->request->post['offloading_zone_id'],
                                    'offloading_city' => $this->request->post['offloading_city'],
                                    'loading_date_from' => $this->request->post['loading_date_from'],
                                    'loading_date_to' => $this->request->post['loading_date_to']
                                    );
                                }
                            }  
                        else
                            {
                            $data = array(
				
				'filter_filter'      => $filter, 
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit,
                                'customer_id'       => $customer_info['customer_id']
                                );
                            } 
                            
                         if ($this->customer->isLogged()) {	 
                            $this->data['isLogged'] = 'true';
                            } 
          
			$this->load->model('catalog/freight');		
			$product_total = $this->model_catalog_freight->getTotalProducts($data); 
			
			$results = $this->model_catalog_freight->getProducts($data);
			
                        $this->load->model('localisation/country');                     
                       
        		foreach ($results as $result) {
	
                                
                                $loading_country = $this->model_localisation_country->getCountry($result['loading_country_id']);
                                $offloading_country = $this->model_localisation_country->getCountry($result['offloading_country_id']);
                                
                                $this->load->model('localisation/zone');                 
                                $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                                $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );
                                
                                $this->load->model('catalog/treiler');             
                                $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;   

                                $this->load->model('account/customer');             
                                $owner = $this->model_account_customer->getCustomerByFreight($result['freight_id'])   ;  
                                
				$this->data['freights'][] = array(
					'product_id'  => $result['product_id'],
			//		'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'loading_date' => $result['loading_date'],
                                        'loading_country' => $loading_country,
                                        'loading_city' => $result['loading_city'],
                                        'offloading_country' => $offloading_country,
                                        'offloading_city' => $result['offloading_city'],
                                        'href'         => '?route=product/freight&product_id='.$result['product_id'],
                                        'loading_zone'       =>  $loading_zone,
                                        'offloading_zone'    =>  $offloading_zone,
                                        'trailer'            =>  $trailer,
                                        'owner' => $owner							
				);
			}
			
                        
                        
        
                        $data = array(			
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit'),
                        'customer_id'     => $customer_info['customer_id']
		);
		
                $this->load->model('catalog/truck');
		$this->load->model('tool/image');
		
		$product_total = $this->model_catalog_truck->getTotalProducts($data);
			
		$results = $this->model_catalog_truck->getProducts($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$product_specials = $this->model_catalog_truck->getProductSpecials($result['product_id']);
					
                        $this->load->model('localisation/country');                               
                        $loading_coutry = $this->model_localisation_country->getCountry( $result['loading_country_id'] );
                        $offloading_coutry = $this->model_localisation_country->getCountry( $result['offloading_country_id'] );

                        $this->load->model('localisation/zone');                 
                        $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                        $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );

                        $this->load->model('catalog/treiler');             
                        $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         

                        $this->load->model('account/customer');             
                        $owner = $this->model_account_customer->getCustomerByTruck($result['truck_id'])   ;  

                        $this->data['trucks'][] = array(
                                        'product_id' => $result['product_id'],
                                        'name'       => $result['name'],
                                        'action' => $action,
                                        'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                                        'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
                                        'action'     => $action,                        
                                        'loading_city' => $result['loading_city'],
                                        'offloading_city' => $result['offloading_city'],
                                        'loading_date' => $result['loading_date'],
                                        'est_date' => $result['est_date'],
                                        'loading_country' => $loading_coutry,
                                        'offloading_country' => $offloading_coutry,
                                        'loading_zone'       =>  $loading_zone,
                                        'offloading_zone'    =>  $offloading_zone,
                                        'trailer'           =>  $trailer,
                                        'owner' => $owner,
                                        'href' => '?route=product/truck&product_id='.$result['product_id']
                                );
    	}
		
                        
                        
                        
                        
                        
                        
			$url = '';
			
                        $this->data['countries']  = $this->model_localisation_country->getCountries();
                        
                               
                                                                        
      if (!empty($customer_info)) { 
                if($customer_info['company_logo'] == '')   $this->data['company_logo'] = 'companyLogo.png';
                else    $this->data['company_logo'] = $customer_info['company_logo'];
      } else {
      		$this->data['company_logo'] = 'companyLogo.png';
      }                   
        
        
        
    	if (isset($this->request->post['firstname'])) {
      		$this->data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($customer_info)) { 
			$this->data['firstname'] = $customer_info['firstname'];
		} else {
      		$this->data['firstname'] = '';
    	}

    	if (isset($this->request->post['lastname'])) {
      		$this->data['lastname'] = $this->request->post['lastname'];
    	} elseif (!empty($customer_info)) { 
			$this->data['lastname'] = $customer_info['lastname'];
		} else {
      		$this->data['lastname'] = '';
    	}

    	if (isset($this->request->post['email'])) {
      		$this->data['email'] = $this->request->post['email'];
    	} elseif (!empty($customer_info)) { 
			$this->data['email'] = $customer_info['email'];
		} else {
      		$this->data['email'] = '';
    	}

    	if (isset($this->request->post['telephone'])) {
      		$this->data['telephone'] = $this->request->post['telephone'];
    	} elseif (!empty($customer_info)) { 
			$this->data['telephone'] = $customer_info['telephone'];
		} else {
      		$this->data['telephone'] = '';
    	}

    	if (isset($this->request->post['fax'])) {
      		$this->data['fax'] = $this->request->post['fax'];
    	} elseif (!empty($customer_info)) { 
			$this->data['fax'] = $customer_info['fax'];
		} else {
      		$this->data['fax'] = '';
    	}

        
        if (!empty($customer_info)) { 
		$this->data['skype'] = $customer_info['skype'];
	} else {
      		$this->data['skype'] = '';
    	}
        
        if (!empty($customer_info)) { 
		$this->data['icq'] = $customer_info['icq'];
	} else {
      		$this->data['icq'] = '';
    	}
        
        if (!empty($customer_info)) { 
		$this->data['website'] = $customer_info['website'];
	} else {
      		$this->data['website'] = '';
    	}
        
        
        
    	if (isset($this->request->post['newsletter'])) {
      		$this->data['newsletter'] = $this->request->post['newsletter'];
    	} elseif (!empty($customer_info)) { 
			$this->data['newsletter'] = $customer_info['newsletter'];
		} else {
      		$this->data['newsletter'] = '';
    	}
		
		$this->load->model('customer/customer_group');
			
		$this->data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

    	if (isset($this->request->post['customer_group_id'])) {
      		$this->data['customer_group_id'] = $this->request->post['customer_group_id'];
    	} elseif (!empty($customer_info)) { 
			$this->data['customer_group_id'] = $customer_info['customer_group_id'];
		} else {
      		$this->data['customer_group_id'] = $this->config->get('config_customer_group_id');
    	}
		
    	if (isset($this->request->post['status'])) {
      		$this->data['status'] = $this->request->post['status'];
    	} elseif (!empty($customer_info)) { 
			$this->data['status'] = $customer_info['status'];
		} else {
      		$this->data['status'] = 1;
    	}

    	if (isset($this->request->post['password'])) { 
			$this->data['password'] = $this->request->post['password'];
		} else {
			$this->data['password'] = '';
		}
		
		if (isset($this->request->post['confirm'])) { 
    		$this->data['confirm'] = $this->request->post['confirm'];
		} else {
			$this->data['confirm'] = '';
		}
		
		$this->load->model('localisation/country');
		
		$this->data['countries'] = $this->model_localisation_country->getCountries();
			
                
                $this->load->model('localisation/zone');
                $this->load->model('localisation/country');
                
                $addresses = $this->model_customer_customer->getAddresses($this->request->get['customer_id']);
                foreach ($addresses as $address)
                {
                  $address['zone'] = $this->model_localisation_zone->getZone($address['zone_id']);                     
                }
                $this->data['addresses'] = $addresses ; 
                
                
                
                
                $warehouses = $this->model_customer_customer->getWarehouses($this->request->get['customer_id']);
                $this->data['warehouses'] = $warehouses ; 
             
                
                $data = array(
                        'filter_status'        => 1,
                        'customer_id'     => $this->request->get['customer_id']
		);
		
		$this->load->model('tool/image');
                $this->load->model('catalog/productAdmin');
                
		$product_total = $this->model_catalog_productAdmin->getTotalProducts($data);
		$results = $this->model_catalog_productAdmin->getProducts($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/product/update',  '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
	
			$special = false;
			
			$product_specials = $this->model_catalog_productAdmin->getProductSpecials($result['product_id']);
			
			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
					$special = $product_special['price'];
			
					break;
				}					
			}
	
      		$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'special'    => $special,
				'image'      => $image,
				'quantity'   => $result['quantity'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'     => $action
			);
                }
                
                
                
                     
                
                
    	if (isset($this->request->post['address_id'])) {
      		$this->data['address_id'] = $this->request->post['address_id'];
    	} elseif (!empty($customer_info)) { 
			$this->data['address_id'] = $customer_info['address_id'];
		} else {
      		$this->data['address_id'] = '';
    	}
		
		$this->data['ips'] = array();
    	
		if (!empty($customer_info)) {
			$results = $this->model_customer_customer->getIpsByCustomerId($this->request->get['customer_id']);
		
			foreach ($results as $result) {
				$ban_ip_total = $this->model_customer_customer->getTotalBanIpsByIp($result['ip']);
				
				$this->data['ips'][] = array(
					'ip'         => $result['ip'],
					'total'      => $this->model_customer_customer->getTotalCustomersByIp($result['ip']),
					'date_added' => date('d/m/y', strtotime($result['date_added'])),
					'filter_ip'  => $this->url->link('customer/customer', '&filter_ip=' . $result['ip'], 'SSL'),
					'ban_ip'     => $ban_ip_total
				);
			}
		}		
		
		//$this->template = 'customer/customer_form.tpl';
                
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/customer_form.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/customer_form.tpl';
		} else {
			$this->template = 'default/template/customer/customer_form.tpl';
		}
		
                
		$this->children = array(
			'common/header',
			'common/footer'
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