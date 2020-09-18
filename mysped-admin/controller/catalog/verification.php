<?php 
class ControllerCatalogVerification extends Controller {
	private $error = array(); 
     
  	public function index() {
            
		$this->language->load('catalog/truck');
    	
		$this->document->setTitle('Verification requests'); 
		
		$this->load->model('catalog/verification');               
		
		$this->getList();
  	}
  
  	public function insert() {
    	$this->language->load('catalog/truck');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/truck');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {   
                       // echo $this->request->post['loading_country_id'];
                       // echo $this->request->post['jan'];
			$this->model_catalog_truck->addProduct($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			
                        $this->redirect($this->url->link('sale/customer/update','customer_id='. $this->request->post['customer_id']  .'&token=' . $this->session->data['token'] . $url, 'SSL'));
			//$this->redirect($this->url->link('catalog/truck', 'token=' . $this->session->data['token'] .  $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->language->load('catalog/truck');
        
    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/verification');
            
                
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_truck->editProduct($this->request->get['product_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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
                        
			$this->redirect($this->url->link('sale/customer/update','customer_id='. $this->request->post['customer_id']   .'&token=' . $this->session->data['token'] . $url, 'SSL'));
			//$this->redirect($this->url->link('catalog/truck', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

        public function verifyCompany() {
            $this->load->model('sale/customer');
               
            if (isset($this->request->get['customer_id']) ) {
			//	$this->model_catalog_verification->deleteVerification($verification_id);
	  		        $this->model_sale_customer->verifyCustomer( $this->request->get['customer_id'] ) ;
                                $this->session->data['success'] = "Customer verified";
		}
            
        $this->getForm(); 
        }
        
  	public function delete() {
    	//$this->language->load('catalog/truck');

    	$this->document->setTitle('Verification requests');
	$this->load->model('catalog/verification');
		
		if (isset($this->request->post['selected']) ) {
			foreach ($this->request->post['selected'] as $verification_id) {
				$this->model_catalog_verification->deleteVerification($verification_id);
	  		}

			$this->session->data['success'] = "Verification requests deleted";//$this->language->get('text_success');
			/*
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			*/
                        $this->redirect($this->url->link('catalog/verification',  '&token=' . $this->session->data['token'] , 'SSL'));
		}
    	$this->getList();
  	}

  	public function copy() {
    	$this->language->load('catalog/truck');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/truck');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_truck->copyProduct($product_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		  
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			
                         $this->redirect($this->url->link('sale/customer/update','customer_id='. $this->request->get['customer_id']   .'&token=' . $this->session->data['token'] . $url, 'SSL'));
			//$this->redirect($this->url->link('catalog/truck', 'token=' . $this->session->data['token'] .  $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	protected function getList() {	

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
		
  		$this->data['breadcrumbs'] = array();
                $this->data['delete'] = $this->url->link('catalog/verification/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['verifications'] = array();

		$data = array(
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$verificationsTotal = $this->model_catalog_verification->getTotalVerifications();
		$results = $this->model_catalog_verification->getVerifications();
		
                $this->load->model('sale/customer'); 
               
                
		foreach ($results as $result) {
			$action = array();
                        
                       
                         
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/verification/update', 'token=' . $this->session->data['token'] . '&verification_id=' . $result['verification_id'] . $url, 'SSL')
			);
     
                $customer = $this->model_sale_customer->getCustomer($result['customer_id']);
                
                $customer['url']= $this->url->link('sale/customer/update','customer_id='. $result['customer_id']  .'&token=' . $this->session->data['token'] . $url, 'SSL');

      		$this->data['verifications'][] = array(
				'verification_id'   => $result['verification_id'],
                                'customer_id'       => $result['customer_id'],
                                'description'       => $result['description'],
				'date_added'        => $result['date_added'],
                                'customer'          =>  $customer,
				'action'     => $action                       
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');		
			
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_model'] = $this->language->get('column_model');		
		$this->data['column_price'] = $this->language->get('column_price');		
		$this->data['column_quantity'] = $this->language->get('column_quantity');		
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
		
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

		/*
                  if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		*/
                
		/*if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}*/
					
		//$this->data['sort_name'] = $this->url->link('catalog/truck', 'token=' . $this->session->data['token'] . '&sort=pd.name' .  $url, 'SSL');
		//$this->data['sort_model'] = $this->url->link('catalog/truck', 'token=' . $this->session->data['token'] . '&sort=p.model' .  $url, 'SSL');
		//$this->data['sort_price'] = $this->url->link('catalog/truck',  'token=' . $this->session->data['token'] . '&sort=p.price' .  $url, 'SSL');
		//$this->data['sort_quantity'] = $this->url->link('catalog/truck',  'token=' . $this->session->data['token'] . '&sort=p.quantity' .  $url, 'SSL');
		//$this->data['sort_status'] = $this->url->link('catalog/truck',  'token=' . $this->session->data['token'] . '&sort=p.status' .  $url, 'SSL');
		//$this->data['sort_order'] = $this->url->link('catalog/truck',  'token=' . $this->session->data['token'] . '&sort=p.sort_order' .  $url, 'SSL');
		
		$url = '';

		/*if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		} */
				
		$pagination = new Pagination();
		$pagination->total = $verificationsTotal;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/truck', 'token=' . $this->session->data['token'] .  $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	

              
		$this->template = 'catalog/verification_list.tpl';
          
		//$this->template = 'catalog/truck_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	protected function getForm() {
            
       $this->data['heading_title'] = "Verification requests"; 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                
		$url = '';
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

                $this->data['breadcrumbs'][] = array(
       		'text'      => ' account',
			'href'      => $this->url->link('account/account', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

                                
   		$this->data['breadcrumbs'][] = array(
       		'text'      => "Insert new freight ",
			'href'      => $this->url->link('catalog/truck/insert','token=' . $this->session->data['token'] .  $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
                
                if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
                
                
                if (isset($this->request->get['customer_id'])) {
			$this->data['customer_id'] = $this->request->get['customer_id'];
		} else {
			$this->data['customer_id'] = 0;
		}  
                
                $this->load->model('catalog/verification');
		if (isset($this->request->get['verification_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$verification_info = $this->model_catalog_verification->getVerification($this->request->get['verification_id']);
                }
        
                
		$this->data['token'] = $this->session->data['token'];
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
                
                
		
        
        if (isset($this->request->post['verification_id'])) {
      		$this->data['weight_tons'] = $this->request->post['verification_id'];
    	} elseif (!empty($verification_info)) {
			$this->data['verification_id'] = $verification_info['verification_id'];
	} else {
      		$this->data['verification_id'] = '';
    	}  
        
        
        if (isset($this->request->post['customer_id'])) {
      		$this->data['customer_id'] = $this->request->post['customer_id'];
    	} elseif (!empty($verification_info)) {
			$this->data['customer_id'] = $verification_info['customer_id'];
	} else {
      		$this->data['customer_id'] = '';
    	}  
        
        $this->load->model('sale/customer'); 
        $this->data['customer'] = $this->model_sale_customer->getCustomer($this->data['customer_id']);
        $this->data['customer']['url']= $this->url->link('sale/customer/update','customer_id='. $this->data['customer_id']  .'&token=' . $this->session->data['token'] . $url, 'SSL');
         
        $this->data['cancel'] =  $this->url->link('catalog/verification','token=' . $this->session->data['token'] .'&customer_id='. $this->data['customer_id'] . $url, 'SSL');
        $this->data['verify'] =  $this->url->link('catalog/verification/verifyCompany','token=' . $this->session->data['token'] .'&customer_id='. $this->data['customer_id'] .'&verification_id='. $this->request->get['verification_id'] .$url, 'SSL');

        
        
        if (isset($this->request->post['description'])) {
      		$this->data['description'] = $this->request->post['description'];
    	} elseif (!empty($verification_info)) {
			$this->data['description'] = $verification_info['description'];
	} else {
      		$this->data['description'] = '';
    	}  
        
        
        if (isset($this->request->post['verification_docs'])) {
      		$this->data['verification_docs'] = $this->request->post['verification_docs'];
    	} elseif (!empty($verification_info)) {
			$this->data['verification_docs'] = $verification_info['docs'];
	} else {
      		$this->data['verification_docs'] = NULL;
    	}  
        
        
        if (isset($this->request->post['date_added'])) {
      		$this->data['date_added'] = $this->request->post['date_added'];
    	} elseif (!empty($verification_info)) {
			$this->data['date_added'] = $verification_info['date_added'];
	} else {
      		$this->data['date_added'] = '';
    	}  
        
      	
        $this->data['docs'] = $this->getFiles($this->data['customer_id']);
    	 	      	
	if (isset($this->request->post['date_available'])) {
       		$this->data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($product_info)) {
			$this->data['date_available'] = date('Y-m-d', strtotime($product_info['date_available']));
		} else {
			$this->data['date_available'] = date('Y-m-d', time() - 86400);
		} 
											
                $this->template = 'catalog/verification_form.tpl';
                
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	protected function validateForm() { 
    	/*if (!$this->user->hasPermission('modify', 'catalog/truck')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}*/

        /*    foreach ($this->request->post['product_description'] as $language_id => $value) {
                    if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
                            $this->error['name'][$language_id] = $this->language->get('error_name');
                    }
            }

            if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
                    $this->error['model'] = $this->language->get('error_model');
            }

                    if ($this->error && !isset($this->error['warning'])) {
                            $this->error['warning'] = $this->language->get('error_warning');
                    }

            if (!$this->error) {
                            return true;
            } else {
                    return false;
            }*/
            return true;
  	}
	
  	protected function validateDelete() {
    /*	if (!$this->user->hasPermission('modify', 'catalog/truck')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}*/
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	protected function validateCopy() {
    	/*if (!$this->user->hasPermission('modify', 'catalog/truck')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}*/
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
		
	public function autocomplete() {
		$json = array();
		
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
			$this->load->model('catalog/truck');
			$this->load->model('catalog/option');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}
			
			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			
						
			$data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);
			
			$results = $this->model_catalog_truck->getProducts($data);
			
			foreach ($results as $result) {
				$option_data = array();
				
				$product_options = $this->model_catalog_truck->getProductOptions($result['product_id']);	
				
				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);
					
					if ($option_info) {				
						if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
							$option_value_data = array();
							
							foreach ($product_option['product_option_value'] as $product_option_value) {
								$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);
						
								if ($option_value_info) {
									$option_value_data[] = array(
										'product_option_value_id' => $product_option_value['product_option_value_id'],
										'option_value_id'         => $product_option_value['option_value_id'],
										'name'                    => $option_value_info['name'],
										'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
										'price_prefix'            => $product_option_value['price_prefix']
									);
								}
							}
						
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $option_value_data,
								'required'          => $product_option['required']
							);	
						} else {
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $product_option['option_value'],
								'required'          => $product_option['required']
							);				
						}
					}
				}
					
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
        
        
       public function getFiles($customer_id) {
		$docs = array();
             //  if (isset($this->request->get['subf']))
             //             $this->subfolder = $this->request->get['subf'] . '/';
                 
		if (!empty($this->request->post['directory'])) {
			$directory = DIR_IMAGE . 'docs/' . 'company_'.$customer_id.'/'. str_replace('../', '', $this->request->post['directory']);
		} else {
			$directory = DIR_IMAGE . 'docs/'  . 'company_'.$customer_id.'/' ;
		}
		
		$allowed = array(
			'.jpg',
			'.jpeg',
			'.png',
			'.gif'
		);
		
		$files = glob(rtrim($directory, '/') . '/*');
		
		if ($files) {
			foreach ($files as $file) {
				if (is_file($file)) {
					$ext = strrchr($file, '.');
				} else {
					$ext = '';
				}	
				
				//if (in_array(strtolower($ext), $allowed)) {
					$size = filesize($file);
		
					$i = 0;
		
					$suffix = array(
						'B',
						'KB',
						'MB',
						'GB',
						'TB',
						'PB',
						'EB',
						'ZB',
						'YB'
					);
		
					while (($size / 1024) > 1) {
						$size = $size / 1024;
						$i++;
					}
						
					$docs[] = array(
						'filename' => basename($file),
						'file'     => utf8_substr($file, utf8_strlen(DIR_IMAGE . 'data/')),
                                                'link'     => HTTP_CATALOG_DIR_IMAGE . 'docs/'  . 'company_'.$customer_id.'/'. basename($file),
						'size'     => round(utf8_substr($size, 0, utf8_strpos($size, '.') + 4), 2) . $suffix[$i]    
					);
				//}
			}
		}
                return $docs;
		//$this->response->setOutput(json_encode($json));	
	}	
	
        
        
        
        
}
?>
