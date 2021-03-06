<?php 
class ControllerCatalogShip extends Controller {
	private $error = array(); 
     
  	public function index() {
            
                if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
        
		$this->language->load('catalog/ship');
    	
		$this->document->setTitle('Ship route list'); 
		
		$this->load->model('catalog/ship');               
		
		$this->getList();
  	}
  
  	public function insert() {
            
             if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
                
                
    	$this->language->load('catalog/ship');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
	$this->load->model('catalog/ship');
        $this->load->model('customer/customer_group');
        
        $data = array(
			'filter_name'	  => '', 
			'filter_model'	  => '',
			'filter_price'	  => '',
			'filter_quantity' => '',
			'filter_status'   => '',
			'sort'            => '',
			'order'           => '',
			//'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			//'limit'           => $this->config->get('config_admin_limit'),
                        'customer_id'     => $this->customer->getId()
		);
        

        $customer_group = $this->model_customer_customer_group->getCustomerGroupByCustomerId( $this->customer->getId() );
        $total = $this->model_catalog_ship->getTotalProducts($data);
        
          if ( $total >= $customer_group['trucks_number'] ) {        
            $this->error['warning']  = str_replace( "%s" , $customer_group['trucks_number'] , $this->language->get('error_truck_number') );
           // $this->error['warning'] = "Warning !! You can not add more products Max product number  "; 
            $this->getList();  
            return;
            }     
            
        
        
        
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {   

                       if ( $this->customer->getId() != $this->request->post['customer_id'])
                            {
                            $this->redirect($this->url->link('freight/upgrade', '', 'SSL'));   
                            }
                            
			$this->model_catalog_ship->addProduct($this->request->post);
	  		
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
			
                        
			$this->redirect($this->url->link('catalog/ship', /*'token=' . $this->session->data['token'] . */ $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
            
             if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
                
    	$this->language->load('catalog/ship');
        
    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/ship');
            
                
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
                       if ( $this->customer->getId() != $this->request->post['customer_id'])
                            {
                            $this->redirect($this->url->link('freight/upgrade', '', 'SSL'));   
                            }
            
			$this->model_catalog_ship->editProduct($this->request->get['product_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('catalog/ship', /*'token=' . $this->session->data['token'] . */$url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
            
             if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
                
    	$this->language->load('catalog/ship');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/ship');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_id) {
                            
                             $ship = $this->model_catalog_ship->getProduct($product_id);
                            
                             if ( $this->customer->getId() != $ship['customer_id'] )
                                {
                                $this->redirect($this->url->link('truck/upgrade', '', 'SSL'));   
                                }
                            
				$this->model_catalog_ship->deleteProduct($product_id);
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
			
			$this->redirect($this->url->link('catalog/ship',/* 'token=' . $this->session->data['token'] .*/ $url, 'SSL'));
		}

    	$this->getList();
  	}

  	public function copy() {
            
             if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
                
    	$this->language->load('catalog/ship');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/ship');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
                    
			foreach ($this->request->post['selected'] as $product_id) {
                            
                             $ship = $this->model_catalog_ship->getProduct($product_id);
                             if ( $this->customer->getId() != $ship['customer_id'] )
                                {
                                $this->redirect($this->url->link('ship/upgrade', '', 'SSL'));   
                                }
                                
                            
				$this->model_catalog_ship->copyProduct($product_id);
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
			
			$this->redirect($this->url->link('catalog/ship',/* 'token=' . $this->session->data['token'] . */ $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	protected function getList() {				
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}
		
		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', /*'token=' . $this->session->data['token']*/'', 'SSL'),
      		'separator' => false
   		);

                $this->data['breadcrumbs'][] = array(
       		'text'      => ' account',
			'href'      => $this->url->link('account/account', /*'token=' . $this->session->data['token']*/'', 'SSL'),
      		'separator' => ' :: '
   		);

                                
   		$this->data['breadcrumbs'][] = array(
       		'text'      => " Ship list",
			'href'      => $this->url->link('catalog/ship',/* 'token=' . $this->session->data['token'] . */ $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('catalog/ship/insert',/* 'token=' . $this->session->data['token'] .*/ $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/ship/copy',/* 'token=' . $this->session->data['token'] .*/ $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/ship/delete',/* 'token=' . $this->session->data['token'] . */$url, 'SSL');
    	
		$this->data['products'] = array();

		$data = array(
			'filter_name'	  => $filter_name, 
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
			'filter_quantity' => $filter_quantity,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit'),
                        'customer_id'     => $this->customer->getId()
		);
		
		$this->load->model('tool/image');
		
		$product_total = $this->model_catalog_ship->getTotalProducts($data);
			
		$results = $this->model_catalog_ship->getProducts($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/ship/update', /*'token=' . $this->session->data['token'] .*/ '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
	
			$special = false;
			
			$product_specials = $this->model_catalog_ship->getProductSpecials($result['product_id']);
			
			/*foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
					$special = $product_special['price'];
			
					break;
				}					
			}*/
	
                $this->load->model('localisation/country');                               
                $loading_coutry = $this->model_localisation_country->getCountry( $result['loading_country_id'] );
                $offloading_coutry = $this->model_localisation_country->getCountry( $result['offloading_country_id'] );
                
                $this->load->model('localisation/zone');                 
                $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );
                
                $this->load->model('catalog/treiler');             
             //   $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         
                
                $this->load->model('account/customer');             
                $owner = $this->model_account_customer->getCustomerByShip($result['ship_id'])   ;  
                
                if( $result['frequency'] == 1 ) $loading_date = '[Regular]';
                else  $loading_date =  $result['loading_date'];
                
      		$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				//'model'      => $result['model'],
				//'price'      => $result['price'],
				'special'    => $special,
				'image'      => $image,
				//'quantity'   => $result['quantity'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'     => $action,                        
                                'loading_city' => $result['loading_city'],
                                'offloading_city' => $result['offloading_city'],
                               // 'zip_code' => $result['zip_code'],
                                'loading_date' => $loading_date,
                                'est_date' => $result['est_date'],
                                'loading_country' => $loading_coutry,
                                'offloading_country' => $offloading_coutry,
                                'loading_zone'       =>  $loading_zone,
                                'offloading_zone'    =>  $offloading_zone,
                             // 'trailer'           =>  $trailer,
                                'owner' => $owner
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		/*$this->data['text_enabled'] = $this->language->get('text_enabled');		
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
		$this->data['button_filter'] = $this->language->get('button_filter');*/
                
                $this->data['text_no_results'] = $this->language->get('text_no_results');
                
		$this->data['column_image'] = $this->language->get('column_image');
                $this->data['column_action'] = $this->language->get('column_action');		
                
		$this->data['insert_text'] = $this->language->get('insert_text');		
		$this->data['copy_text'] = $this->language->get('copy_text');		
		$this->data['delete_text'] = $this->language->get('delete_text');		
		$this->data['edit_text'] = $this->language->get('edit_text');		
			
		$this->data['loading_date_text'] = $this->language->get('loading_date_text');		
	//	$this->data['trailer_text'] = $this->language->get('trailer_text');		
		$this->data['loading_country_text'] = $this->language->get('loading_country_text');		
		$this->data['region_state_text'] = $this->language->get('region_state_text');		
		$this->data['city_area_text'] = $this->language->get('city_area_text');		
		$this->data['offloading_country_text'] = $this->language->get('offloading_country_text');		
		$this->data['company_text'] = $this->language->get('company_text');	
                
 		$this->data['token'] = /*$this->session->data['token']*/'';
		
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
								
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_name'] = $this->url->link('catalog/ship', /*'token=' . $this->session->data['token'] . '&sort=pd.name' . */ $url, 'SSL');
		$this->data['sort_model'] = $this->url->link('catalog/ship',/* 'token=' . $this->session->data['token'] . '&sort=p.model' . */ $url, 'SSL');
		$this->data['sort_price'] = $this->url->link('catalog/ship', /* 'token=' . $this->session->data['token'] . '&sort=p.price' . */ $url, 'SSL');
		$this->data['sort_quantity'] = $this->url->link('catalog/ship', /* 'token=' . $this->session->data['token'] . '&sort=p.quantity' . */ $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/ship', /* 'token=' . $this->session->data['token'] . '&sort=p.status' . */ $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/ship', /* 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . */ $url, 'SSL');
		
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
				
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/ship',/* 'token=' . $this->session->data['token'] . */ $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_model'] = $filter_model;
		$this->data['filter_price'] = $filter_price;
		$this->data['filter_quantity'] = $filter_quantity;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/catalog/ship_list.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/catalog/ship_list.tpl';
		} else {
			$this->template = 'default/template/catalog/ship_list.tpl';
		}
                
		//$this->template = 'catalog/ship_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	protected function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
                
                $this->data['tab_general'] = $this->language->get('tab_general');
                $this->data['tab_image'] = $this->language->get('tab_image');	
                $this->data['truck_parameters_text'] = $this->language->get('truck_parameters_text');
                
                //$this->data['stackable_text'] = $this->language->get('stackable_text');
                   
            	$this->data['save_text'] = $this->language->get('save_text');
                $this->data['cancel_text'] = $this->language->get('cancel_text');
		$this->data['location_and_date_text'] = $this->language->get('location_and_date_text');
		$this->data['freight_parameters_text'] = $this->language->get('freight_parameters_text');
		$this->data['frequency_text'] = $this->language->get('frequency_text');
		$this->data['loading_area_text'] = $this->language->get('loading_area_text');
		$this->data['loading_country_text'] = $this->language->get('loading_country_text');
		$this->data['loading_region_state_text'] = $this->language->get('loading_region_state_text');
		$this->data['loading_city_text'] = $this->language->get('loading_city_text');
		
                $this->data['zip_code_text'] = $this->language->get('zip_code_text');
                $this->data['offloading_area_text'] = $this->language->get('offloading_area_text');
		$this->data['offloading_country_text'] = $this->language->get('offloading_country_text');
		$this->data['offloading_region_state_text'] = $this->language->get('offloading_region_state_text');		
		$this->data['offloading_city_text'] = $this->language->get('offloading_city_text');
		$this->data['date_text'] = $this->language->get('date_text');
                $this->data['loading_date_text'] = $this->language->get('loading_date_text');		
		$this->data['estimation_date_text'] = $this->language->get('estimation_date_text');
		$this->data['offloading_date_text'] = $this->language->get('offloading_date_text');
		//$this->data['trailer_type_text'] = $this->language->get('trailer_type_text'); 
        
                $this->data['lift_text'] = $this->language->get('lift_text');
                $this->data['manipulator_text'] = $this->language->get('manipulator_text');
		$this->data['freight_type_text'] = $this->language->get('freight_type_text');
		$this->data['loading_type_text'] = $this->language->get('loading_type_text');		
		$this->data['freight_parameters_text'] = $this->language->get('freight_parameters_text');
		$this->data['weight_tons_text'] = $this->language->get('weight_tons_text');
                $this->data['pallets_no_text'] = $this->language->get('pallets_no_text');		
	//	$this->data['exchangeable_text'] = $this->language->get('exchangeable_text');
		$this->data['volume_unit_text'] = $this->language->get('volume_unit_text');
		$this->data['freight_rate_text'] = $this->language->get('freight_rate_text'); 
		 
                $this->data['currency_text'] = $this->language->get('currency_text');
                $this->data['payment_terms_text'] = $this->language->get('payment_terms_text');
		$this->data['payment_method_text'] = $this->language->get('payment_method_text');
	//	$this->data['non_exchangeable_text'] = $this->language->get('non_exchangeable_text');		
		//$this->data['non_stackable_text'] = $this->language->get('non_stackable_text');
        
                $this->data['entry_name'] = $this->language->get('entry_name');
                $this->data['entry_description'] = $this->language->get('entry_description');
                $this->data['entry_image'] = $this->language->get('entry_image');
                $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
                $this->data['button_add_image'] = $this->language->get('button_add_image');
                $this->data['button_remove'] = $this->language->get('button_remove');
                $this->data['text_browse'] = $this->language->get('text_browse');
                $this->data['text_clear'] = $this->language->get('text_clear');
                $this->data['text_image_manager'] = $this->language->get('text_image_manager');  
                
                $this->data['text_select'] = $this->language->get('text_select');
                $this->data['text_none'] = $this->language->get('text_none');
                $this->data['text_image_manager'] = $this->language->get('text_image_manager');  
                
 	if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                                                                                         
                if (isset($this->error['error_loading_city'])) {
			$this->data['error_loading_city'] = $this->error['error_loading_city'];
		} else {
			$this->data['error_loading_city'] = '';
		}	
		
                if (isset($this->error['error_offloading_city'])) {
			$this->data['error_offloading_city'] = $this->error['error_offloading_city'];
		} else {
			$this->data['error_offloading_city'] = '';
		}
                
                if (isset($this->error['error_offloading_country'])) {
			$this->data['error_offloading_country'] = $this->error['error_offloading_country'];
		} else {
			$this->data['error_offloading_country'] = '';
		}	
                
                if (isset($this->error['error_loading_country'])) {
			$this->data['error_loading_country'] = $this->error['error_loading_country'];
		} else {
			$this->data['error_loading_country'] = '';
		}
                                           
               if (isset($this->error['error_loading_date'])) {
			$this->data['error_loading_date'] = $this->error['error_loading_date'];
		} else {
			$this->data['error_loading_date'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

 		if (isset($this->error['meta_description'])) {
			$this->data['error_meta_description'] = $this->error['meta_description'];
		} else {
			$this->data['error_meta_description'] = array();
		}		
   
   		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}	
		
   		if (isset($this->error['model'])) {
			$this->data['error_model'] = $this->error['model'];
		} else {
			$this->data['error_model'] = '';
		}		
     	
		if (isset($this->error['date_available'])) {
			$this->data['error_date_available'] = $this->error['date_available'];
		} else {
			$this->data['error_date_available'] = '';
		}	

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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', /*'token=' . $this->session->data['token']*/'', 'SSL'),
      		'separator' => false
   		);

                $this->data['breadcrumbs'][] = array(
       		'text'      => ' account',
			'href'      => $this->url->link('account/account', /*'token=' . $this->session->data['token']*/'', 'SSL'),
      		'separator' => ' :: '
   		);

                                
   		$this->data['breadcrumbs'][] = array(
       		'text'      => "Insert new ship route ",
			'href'      => $this->url->link('catalog/ship/insert',/* 'token=' . $this->session->data['token'] . */ $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['product_id'])) {
			$this->data['action'] = $this->url->link('catalog/ship/insert', /*'token=' . $this->session->data['token'] . */$url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/ship/update', /*'token=' . $this->session->data['token'] . */'&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/ship', /*'token=' . $this->session->data['token'] .*/ $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$product_info = $this->model_catalog_ship->getProduct($this->request->get['product_id']);
    	}
        
                              
                
		$this->data['token'] = /*$this->session->data['token']*/'';
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['product_description'])) {
			$this->data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_description'] = $this->model_catalog_ship->getProductDescriptions($this->request->get['product_id']);
		} else {
			$this->data['product_description'] = array();
		}
		
                
                $this->load->model('localisation/country');    
                $coutries_total = $this->model_localisation_country->getCountries();                    
                
                $this->data['coutries_total'] = $coutries_total;
                
                if (isset($this->request->post['loading_country_id'])) 
                    {
                    $loading_coutry = $this->model_localisation_country->getCountry( $this->request->post['loading_country_id'] );
                    if (isset($loading_coutry['name']))
                            {
                            $this->data['loading_country_id'] = $this->request->post['loading_country_id'];
                            $this->data['loading_country'] = $loading_coutry['name'];
                            }
                    } 
                elseif (!empty($product_info)) 
                    {
                        $loading_coutry = $this->model_localisation_country->getCountry( $product_info['loading_country_id'] );
			if (isset($loading_coutry['name']))
                            {
                            $this->data['loading_country_id'] =  $product_info['loading_country_id'];
                            $this->data['loading_country'] =  $loading_coutry['name'];
                            }
                    } 
                else 
                    {
                    $this->data['loading_country_id'] = '';
                     $this->data['loading_country'] = '';
                    }
        
                    
                if (isset($this->request->post['loading_city'])) 
                    {
                    $this->data['loading_city'] = $this->request->post['loading_city'];
                    } 
                elseif (!empty($product_info)) 
                    {
                    $this->data['loading_city'] = $product_info['loading_city'];
                    }
                else 
                    {
                    $this->data['loading_city'] = '';
                    }
        
                    
               if (isset($this->request->post['offloading_country_id'])) 
                    {
                   $offloading_coutry = $this->model_localisation_country->getCountry( $this->request->post['offloading_country_id'] );
                   if (isset($offloading_coutry['name']))
                            {
                            $this->data['offloading_country_id'] = $this->request->post['offloading_country_id'];
                            $this->data['offloading_country'] = $offloading_coutry['name'];
                            }
                    } 
               elseif (!empty($product_info)) 
                    {
                    $offloading_coutry = $this->model_localisation_country->getCountry( $product_info['offloading_country_id'] );  
                    if (isset($offloading_coutry['name']))
                        {
                        $this->data['offloading_country_id'] = $product_info['offloading_country_id'];
                        $this->data['offloading_country'] = $loading_coutry['name'];
                        }
                    }
              else  {
                    $this->data['offloading_country_id'] = '';
                    $this->data['offloading_country'] = '';
                    }
                    
        
                      if (isset($this->request->post['offloading_city'])) {
      		$this->data['offloading_city'] = $this->request->post['offloading_city'];
    	} elseif (!empty($product_info)) {
			$this->data['offloading_city'] = $product_info['offloading_city'];
		} else {
      		$this->data['offloading_city'] = '';
    	}
               
        if (isset($this->request->post['loading_date'])) {
                        $this->data['loading_date'] = $this->request->post['loading_date'];
    	} elseif (!empty($product_info)) {
			$this->data['loading_date'] = $product_info['loading_date'];
	} else {
                        $this->data['loading_date'] = '';
    	}
        
        if (isset($this->request->post['offloading_date'])) {
                        $this->data['offloading_date'] = $this->request->post['offloading_date'];
    	} elseif (!empty($product_info)) {
			$this->data['offloading_date'] = $product_info['offloading_date'];
	} else {
                        $this->data['offloading_date'] = '';
    	}
        
        
                        if (isset($this->request->post['est_date'])) {
      		$this->data['est_date'] = $this->request->post['est_date'];
    	} elseif (!empty($product_info)) {
			$this->data['est_date'] = $product_info['est_date'];
		} else {
      		$this->data['est_date'] = '';
    	}
        
     /*   if (isset($this->request->post['freight_type_id'])) {
      		$this->data['freight_type_id'] = $this->request->post['freight_type_id'];
    	} elseif (!empty($product_info)) {
			$this->data['freight_type_id'] = $product_info['freight_type_id'];
		} else {
      		$this->data['freight_type_id'] = '';
    	}  */
        
        if (isset($this->request->post['freight_params'])) {
      		$this->data['freight_params'] = $this->request->post['freight_params'];
    	} elseif (!empty($product_info)) {
			$this->data['freight_params'] = $product_info['freight_params'];
		} else {
      		$this->data['freight_params'] = '';
    	}  
        
        if (isset($this->request->post['weight_tons'])) {
      		$this->data['weight_tons'] = $this->request->post['weight_tons'];
    	} elseif (!empty($product_info)) {
			$this->data['weight_tons'] = $product_info['weight_tons'];
		} else {
      		$this->data['weight_tons'] = '';
    	}  
        
        if (isset($this->request->post['pallets_no'])) {
      		$this->data['pallets_no'] = $this->request->post['pallets_no'];
    	} elseif (!empty($product_info)) {
			$this->data['pallets_no'] = $product_info['pallets_no'];
		} else {
      		$this->data['pallets_no'] = '';
    	}  
              
        if (isset($this->request->post['loading_zone_id'])) {
      		$this->data['loading_zone_id'] = $this->request->post['loading_zone_id'];
    	} elseif (!empty($product_info)) {
			$this->data['loading_zone_id'] = $product_info['loading_zone_id'];
		} else {
      		$this->data['loading_zone_id'] = '';
    	}  
        
        if (isset($this->request->post['loading_zip'])) {
      		$this->data['loading_zip'] = $this->request->post['loading_zip'];
    	} elseif (!empty($product_info)) {
			$this->data['loading_zip'] = $product_info['loading_zip'];
		} else {
      		$this->data['loading_zip'] = '';
    	}  
        
        if (isset($this->request->post['loading_time'])) {
      		$this->data['loading_time'] = $this->request->post['loading_time'];
    	} elseif (!empty($product_info)) {
			$this->data['loading_time'] = $product_info['loading_time'];
		} else {
      		$this->data['loading_time'] = '';
    	}  
        
        if (isset($this->request->post['offloading_zone_id'])) {
      		$this->data['offloading_zone_id'] = $this->request->post['offloading_zone_id'];
    	} elseif (!empty($product_info)) {
			$this->data['offloading_zone_id'] = $product_info['offloading_zone_id'];
		} else {
      		$this->data['offloading_zone_id'] = '';
    	} 
        
        if (isset($this->request->post['offloading_zip'])) {
      		$this->data['offloading_zip'] = $this->request->post['offloading_zip'];
    	} elseif (!empty($product_info)) {
			$this->data['offloading_zip'] = $product_info['offloading_zip'];
		} else {
      		$this->data['offloading_zip'] = '';
    	} 
        
        if (isset($this->request->post['offloading_time'])) {
      		$this->data['offloading_time'] = $this->request->post['offloading_time'];
    	} elseif (!empty($product_info)) {
			$this->data['offloading_time'] = $product_info['offloading_time'];
		} else {
      		$this->data['offloading_time'] = '';
    	} 
        
        if (isset($this->request->post['freight_number'])) {
      		$this->data['freight_number'] = $this->request->post['freight_number'];
    	} elseif (!empty($product_info)) {
			$this->data['freight_number'] = $product_info['freight_number'];
		} else {
      		$this->data['freight_number'] = '';
    	} 
        
       /* if (isset($this->request->post['exchangeable'])) {
      		$this->data['exchangeable'] = $this->request->post['exchangeable'];
    	} elseif (!empty($product_info)) {
			$this->data['exchangeable'] = $product_info['exchangeable'];
		} else {
      		$this->data['exchangeable'] = '';
    	} */
        
      /*  if (isset($this->request->post['stackable'])) {
      		$this->data['stackable'] = $this->request->post['stackable'];
    	} elseif (!empty($product_info)) {
			$this->data['stackable'] = $product_info['stackable'];
		} else {
      		$this->data['stackable'] = '';
    	} */
        
        if (isset($this->request->post['volume_unit'])) {
      		$this->data['volume_unit'] = $this->request->post['volume_unit'];
    	} elseif (!empty($product_info)) {
			$this->data['volume_unit'] = $product_info['volume_unit'];
		} else {
      		$this->data['volume_unit'] = '';
    	} 
        
        if (isset($this->request->post['volume_unit_type'])) {
      		$this->data['volume_unit_type'] = $this->request->post['volume_unit_type'];
    	} elseif (!empty($product_info)) {
			$this->data['volume_unit_type'] = $product_info['volume_unit_type'];
		} else {
      		$this->data['volume_unit_type'] = '';
    	} 
                      
        
        if (isset($this->request->post['adr'])) {
      		$this->data['adr'] = $this->request->post['adr'];
    	} elseif (!empty($product_info)) {
			$this->data['adr'] = $product_info['adr'];
		} else {
      		$this->data['adr'] = '';
    	} 
        
                if (isset($this->request->post['tir'])) {
      		$this->data['tir'] = $this->request->post['tir'];
    	} elseif (!empty($product_info)) {
			$this->data['tir'] = $product_info['tir'];
		} else {
      		$this->data['tir'] = '';
    	} 
        
        
                if (isset($this->request->post['cmr'])) {
      		$this->data['cmr'] = $this->request->post['cmr'];
    	} elseif (!empty($product_info)) {
			$this->data['cmr'] = $product_info['cmr'];
		} else {
      		$this->data['cmr'] = '';
    	} 
        
        
                if (isset($this->request->post['cemt'])) {
      		$this->data['cemt'] = $this->request->post['cemt'];
    	} elseif (!empty($product_info)) {
			$this->data['cemt'] = $product_info['cemt'];
		} else {
      		$this->data['cemt'] = '';
    	} 
        
      /*  if (isset($this->request->post['trailer_type_id'])) {
      		$this->data['trailer_type_id'] = $this->request->post['trailer_type_id'];
    	} elseif (!empty($product_info)) {
			$this->data['trailer_type_id'] = $product_info['trailer_type_id'];
		} else {
      		$this->data['trailer_type_id'] = '-1';
    	} */
        
       /*         if (isset($this->request->post['t1'])) {
      		$this->data['t1'] = $this->request->post['t1'];
    	} elseif (!empty($product_info)) {
			$this->data['t1'] = $product_info['t1'];
		} else {
      		$this->data['t1'] = '';
    	} */
        
        /*        if (isset($this->request->post['ex1'])) {
      		$this->data['ex1'] = $this->request->post['ex1'];
    	} elseif (!empty($product_info)) {
			$this->data['ex1'] = $product_info['ex1'];
		} else {
      		$this->data['ex1'] = '';
    	} */
        
        /*        if (isset($this->request->post['freight_loading_type_id'])) {
      		$this->data['freight_loading_type_id'] = $this->request->post['freight_loading_type_id'];
    	} elseif (!empty($product_info)) {
			$this->data['freight_loading_type_id'] = $product_info['freight_loading_type_id'];
		} else {
      		$this->data['freight_loading_type_id'] = '';
    	} 
        */
          /*      if (isset($this->request->post['freight_rate'])) {
      		$this->data['freight_rate'] = $this->request->post['freight_rate'];
    	} elseif (!empty($product_info)) {
			$this->data['freight_rate'] = $product_info['freight_rate'];
		} else {
      		$this->data['freight_rate'] = '';
    	} */
        
       /*         if (isset($this->request->post['payment_terms_id'])) {
      		$this->data['payment_terms_id'] = $this->request->post['payment_terms_id'];
    	} elseif (!empty($product_info)) {
			$this->data['payment_terms_id'] = $product_info['payment_terms_id'];
		} else {
      		$this->data['payment_terms_id'] = '';
    	} */
        
         /*       if (isset($this->request->post['payment_method_id'])) {
      		$this->data['payment_method_id'] = $this->request->post['payment_method_id'];
    	} elseif (!empty($product_info)) {
			$this->data['payment_method_id'] = $product_info['payment_method_id'];
		} else {
      		$this->data['payment_method_id'] = '';
    	} */
                                 
                        if (isset($this->request->post['lift'])) {
      		$this->data['lift'] = $this->request->post['lift'];
    	} elseif (!empty($product_info)) {
			$this->data['lift'] = $product_info['lift'];
		} else {
      		$this->data['lift'] = '';
    	} 
        
                        if (isset($this->request->post['manipulator'])) {
      		$this->data['manipulator'] = $this->request->post['manipulator'];
    	} elseif (!empty($product_info)) {
			$this->data['manipulator'] = $product_info['manipulator'];
		} else {
      		$this->data['manipulator'] = '';
    	} 
                        if (isset($this->request->post['description'])) {
      		$this->data['description'] = $this->request->post['description'];
    	} elseif (!empty($product_info)) {
			$this->data['description'] = $product_info['description'];
		} else {
      		$this->data['description'] = '';
    	} 
        
        if (isset($this->request->post['frequency'])) {
      		$this->data['frequency'] = $this->request->post['frequency'];
    	} elseif (!empty($product_info)) {
			$this->data['frequency'] = $product_info['frequency'];
		} else {
      		$this->data['frequency'] = '';
    	} 
        
                 
        
     
        
       /* $this->load->model('catalog/freightType');    
        $freight_total = $this->model_catalog_freightType->getFreights();       
        $this->data['freight_total'] = $freight_total;*/
        
        $this->load->model('catalog/treiler');    
        $treiler_total = $this->model_catalog_treiler->getTreilers();     
        $this->data['treiler_total'] = $treiler_total;
        
     /*    $this->load->model('catalog/freightLoadingType');    
        $freight_loading_types = $this->model_catalog_freightLoadingType->getLoadingTypes();       
        $this->data['freight_loading_types'] = $freight_loading_types;*/
        
     /*   $this->load->model('catalog/freightPaymentMethod');    
        $freight_payment_methods = $this->model_catalog_freightPaymentMethod->getPaymentMethods();       
        $this->data['freight_payment_methods'] = $freight_payment_methods;
        
        $this->load->model('catalog/freightPaymentTerms');    
        $freight_payment_terms = $this->model_catalog_freightPaymentTerms->getPaymentTerms();       
        $this->data['freight_payment_terms'] = $freight_payment_terms;
*/
		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['product_store'])) {
			$this->data['product_store'] = $this->request->post['product_store'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_store'] = $this->model_catalog_ship->getProductStores($this->request->get['product_id']);
		} else {
			$this->data['product_store'] = array(0);
		}	
		
		
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($product_info)) {
			$this->data['image'] = $product_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && $product_info['image'] && file_exists(DIR_IMAGE . $product_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
    /*	if (isset($this->request->post['shipping'])) {
      		$this->data['shipping'] = $this->request->post['shipping'];
    	} elseif (!empty($product_info)) {
      		$this->data['shipping'] = $product_info['shipping'];
    	} else {
			$this->data['shipping'] = 1;
		}
		
    	if (isset($this->request->post['price'])) {
      		$this->data['price'] = $this->request->post['price'];
    	} elseif (!empty($product_info)) {
			$this->data['price'] = $product_info['price'];
		} else {
      		$this->data['price'] = '';
    	}*/
		
		//$this->load->model('localisation/tax_class');
		
		//$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
    	
	/*	if (isset($this->request->post['tax_class_id'])) {
      		$this->data['tax_class_id'] = $this->request->post['tax_class_id'];
    	} elseif (!empty($product_info)) {
			$this->data['tax_class_id'] = $product_info['tax_class_id'];
		} else {
      		$this->data['tax_class_id'] = 0;
    	}*/
		      	
		if (isset($this->request->post['date_available'])) {
       		$this->data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($product_info)) {
			$this->data['date_available'] = date('Y-m-d', strtotime($product_info['date_available']));
		} else {
			$this->data['date_available'] = date('Y-m-d', time() - 86400);
		}
											
    /*	if (isset($this->request->post['quantity'])) {
      		$this->data['quantity'] = $this->request->post['quantity'];
    	} elseif (!empty($product_info)) {
      		$this->data['quantity'] = $product_info['quantity'];
    	} else {
			$this->data['quantity'] = 1;
		}
		
		if (isset($this->request->post['minimum'])) {
      		$this->data['minimum'] = $this->request->post['minimum'];
    	} elseif (!empty($product_info)) {
      		$this->data['minimum'] = $product_info['minimum'];
    	} else {
			$this->data['minimum'] = 1;
		}
		
		if (isset($this->request->post['subtract'])) {
      		$this->data['subtract'] = $this->request->post['subtract'];
    	} elseif (!empty($product_info)) {
      		$this->data['subtract'] = $product_info['subtract'];
    	} else {
			$this->data['subtract'] = 1;
		}*/
		
		if (isset($this->request->post['sort_order'])) {
      		$this->data['sort_order'] = $this->request->post['sort_order'];
    	} elseif (!empty($product_info)) {
      		$this->data['sort_order'] = $product_info['sort_order'];
    	} else {
			$this->data['sort_order'] = 1;
		}

		//$this->load->model('localisation/stock_status');
		
		//$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
    	
		/*if (isset($this->request->post['stock_status_id'])) {
      		$this->data['stock_status_id'] = $this->request->post['stock_status_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['stock_status_id'] = $product_info['stock_status_id'];
    	} else {
			$this->data['stock_status_id'] = $this->config->get('config_stock_status_id');
		}*/
				
    	if (isset($this->request->post['status'])) {
      		$this->data['status'] = $this->request->post['status'];
    	} elseif (!empty($product_info)) {
			$this->data['status'] = $product_info['status'];
		} else {
      		$this->data['status'] = 1;
    	}

    	/*if (isset($this->request->post['weight'])) {
      		$this->data['weight'] = $this->request->post['weight'];
		} elseif (!empty($product_info)) {
			$this->data['weight'] = $product_info['weight'];
    	} else {
      		$this->data['weight'] = '';
    	} */
		
		//$this->load->model('localisation/weight_class');
		
		//$this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
    	
	/*	if (isset($this->request->post['weight_class_id'])) {
      		$this->data['weight_class_id'] = $this->request->post['weight_class_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['weight_class_id'] = $product_info['weight_class_id'];
		} else {
      		$this->data['weight_class_id'] = $this->config->get('config_weight_class_id');
    	}
		
		if (isset($this->request->post['length'])) {
      		$this->data['length'] = $this->request->post['length'];
    	} elseif (!empty($product_info)) {
			$this->data['length'] = $product_info['length'];
		} else {
      		$this->data['length'] = '';
    	}
		
		if (isset($this->request->post['width'])) {
      		$this->data['width'] = $this->request->post['width'];
		} elseif (!empty($product_info)) {	
			$this->data['width'] = $product_info['width'];
    	} else {
      		$this->data['width'] = '';
    	}
		
		if (isset($this->request->post['height'])) {
      		$this->data['height'] = $this->request->post['height'];
		} elseif (!empty($product_info)) {
			$this->data['height'] = $product_info['height'];
    	} else {
      		$this->data['height'] = '';
    	}*/

		//$this->load->model('localisation/length_class');
		
	//	$this->data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();
    	
	/*	if (isset($this->request->post['length_class_id'])) {
      		$this->data['length_class_id'] = $this->request->post['length_class_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['length_class_id'] = $product_info['length_class_id'];
    	} else {
      		$this->data['length_class_id'] = $this->config->get('config_length_class_id');
		}*/

	//	$this->load->model('catalog/manufacturer');
		
    /*	if (isset($this->request->post['manufacturer_id'])) {
      		$this->data['manufacturer_id'] = $this->request->post['manufacturer_id'];
		} elseif (!empty($product_info)) {
			$this->data['manufacturer_id'] = $product_info['manufacturer_id'];
		} else {
      		$this->data['manufacturer_id'] = 0;
    	} 		
		
    	if (isset($this->request->post['manufacturer'])) {
      		$this->data['manufacturer'] = $this->request->post['manufacturer'];
		} elseif (!empty($product_info)) {
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($product_info['manufacturer_id']);
			
			if ($manufacturer_info) {		
				$this->data['manufacturer'] = $manufacturer_info['name'];
			} else {
				$this->data['manufacturer'] = '';
			}	
		} else {
      		$this->data['manufacturer'] = '';
    	} */
		
		// Categories
	/*	$this->load->model('catalog/category');
		
		if (isset($this->request->post['product_category'])) {
			$categories = $this->request->post['product_category'];
		} elseif (isset($this->request->get['freight_id'])) {		
			$categories = $this->model_catalog_ship->getProductCategories($this->request->get['freight_id']);
		} else {
			$categories = array();
		}*/
	
		//$this->data['product_categories'] = array();
		
		/*foreach ($categories as $category_id) {
			$category_info = $this->model_catalog_category->getCategory($category_id);
			
			if ($category_info) {
				$this->data['product_categories'][] = array(
					'category_id' => $category_info['category_id'],
					'name'        => ($category_info['path'] ? $category_info['path'] . ' &gt; ' : '') . $category_info['name']
				);
			}
		}
		*/
		// Filters
		$this->load->model('catalog/filter');
		
		if (isset($this->request->post['product_filter'])) {
			$filters = $this->request->post['product_filter'];
		} elseif (isset($this->request->get['product_id'])) {
			$filters = $this->model_catalog_ship->getProductFilters($this->request->get['product_id']);
		} else {
			$filters = array();
		}
		
		$this->data['product_filters'] = array();
		
		foreach ($filters as $filter_id) {
			$filter_info = $this->model_catalog_filter->getFilter($filter_id);
			
			if ($filter_info) {
				$this->data['product_filters'][] = array(
					'filter_id' => $filter_info['filter_id'],
					'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
				);
			}
		}		
		
		// Attributes
		$this->load->model('catalog/attribute');
		
		if (isset($this->request->post['product_attribute'])) {
			$product_attributes = $this->request->post['product_attribute'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_attributes = $this->model_catalog_ship->getProductAttributes($this->request->get['product_id']);
		} else {
			$product_attributes = array();
		}
		
		$this->data['product_attributes'] = array();
		
		foreach ($product_attributes as $product_attribute) {
			$attribute_info = $this->model_catalog_attribute->getAttribute($product_attribute['attribute_id']);
			
			if ($attribute_info) {
				$this->data['product_attributes'][] = array(
					'attribute_id'                  => $product_attribute['attribute_id'],
					'name'                          => $attribute_info['name'],
					'product_attribute_description' => $product_attribute['product_attribute_description']
				);
			}
		}		
		
		// Options
		$this->load->model('catalog/option');
		
		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_catalog_ship->getProductOptions($this->request->get['product_id']);			
		} else {
			$product_options = array();
		}			
		
		$this->data['product_options'] = array();
			
		foreach ($product_options as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();
				
				foreach ($product_option['product_option_value'] as $product_option_value) {
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
				
				$this->data['product_options'][] = array(
					'product_option_id'    => $product_option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $product_option['option_id'],
					'name'                 => $product_option['name'],
					'type'                 => $product_option['type'],
					'required'             => $product_option['required']
				);				
			} else {
				$this->data['product_options'][] = array(
					'product_option_id' => $product_option['product_option_id'],
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'option_value'      => $product_option['option_value'],
					'required'          => $product_option['required']
				);				
			}
		}
		
		$this->data['option_values'] = array();
		
		foreach ($this->data['product_options'] as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				if (!isset($this->data['option_values'][$product_option['option_id']])) {
					$this->data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
				}
			}
		}
		
		$this->load->model('sale/customer_group');
		
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		
		if (isset($this->request->post['product_discount'])) {
			$this->data['product_discounts'] = $this->request->post['product_discount'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_discounts'] = $this->model_catalog_ship->getProductDiscounts($this->request->get['product_id']);
		} else {
			$this->data['product_discounts'] = array();
		}

		if (isset($this->request->post['product_special'])) {
			$this->data['product_specials'] = $this->request->post['product_special'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_specials'] = $this->model_catalog_ship->getProductSpecials($this->request->get['product_id']);
		} else {
			$this->data['product_specials'] = array();
		}
		
		// Images
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_images = $this->model_catalog_ship->getProductImages($this->request->get['product_id']);
		} else {
			$product_images = array();
		}
		
		$this->data['product_images'] = array();
		
		foreach ($product_images as $product_image) {
			if ($product_image['image'] && file_exists(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
			} else {
				$image = 'no_image.jpg';
			}
			
			$this->data['product_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($image, 100, 100),
				'sort_order' => $product_image['sort_order']
			);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		// Downloads
		$this->load->model('catalog/download');
		
		if (isset($this->request->post['product_download'])) {
			$product_downloads = $this->request->post['product_download'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_downloads = $this->model_catalog_ship->getProductDownloads($this->request->get['product_id']);
		} else {
			$product_downloads = array();
		}
			
		$this->data['product_downloads'] = array();
		
		foreach ($product_downloads as $download_id) {
			$download_info = $this->model_catalog_download->getDownload($download_id);
			
			if ($download_info) {
				$this->data['product_downloads'][] = array(
					'download_id' => $download_info['download_id'],
					'name'        => $download_info['name']
				);
			}
		}
		
		if (isset($this->request->post['product_related'])) {
			$products = $this->request->post['product_related'];
		} elseif (isset($this->request->get['product_id'])) {		
			$products = $this->model_catalog_ship->getProductRelated($this->request->get['product_id']);
		} else {
			$products = array();
		}
	
		$this->data['product_related'] = array();
		
		foreach ($products as $product_id) {
			$related_info = $this->model_catalog_ship->getProduct($product_id);
			
			if ($related_info) {
				$this->data['product_related'][] = array(
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
		}

    	/*if (isset($this->request->post['points'])) {
      		$this->data['points'] = $this->request->post['points'];
    	} elseif (!empty($product_info)) {
			$this->data['points'] = $product_info['points'];
		} else {
      		$this->data['points'] = '';
    	}*/
						
		if (isset($this->request->post['product_reward'])) {
			$this->data['product_reward'] = $this->request->post['product_reward'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_reward'] = $this->model_catalog_ship->getProductRewards($this->request->get['product_id']);
		} else {
			$this->data['product_reward'] = array();
		}
		
		if (isset($this->request->post['product_layout'])) {
			$this->data['product_layout'] = $this->request->post['product_layout'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_layout'] = $this->model_catalog_ship->getProductLayouts($this->request->get['product_id']);
		} else {
			$this->data['product_layout'] = array();
		}

		$this->load->model('design/layout');
		
		//$this->data['layouts'] = $this->model_design_layout->getLayout();
						
               if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/catalog/ship_form.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/catalog/ship_form.tpl';
		} else {
			$this->template = 'default/template/catalog/ship_form.tpl';
		}
                
		//$this->template = 'catalog/ship_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	protected function validateForm() { 
     
            if ((utf8_strlen($this->request->post['loading_city']) < 1) || (utf8_strlen($this->request->post['loading_city']) > 64)) {
                    $this->error['error_loading_city'] = $this->language->get('error_empty');
            }
            
            if ((utf8_strlen($this->request->post['offloading_city']) < 1) || (utf8_strlen($this->request->post['offloading_city']) > 64)) {
                     $this->error['error_offloading_city'] = $this->language->get('error_empty');
            }
            
          
           // if ((utf8_strlen($this->request->post['weight_tons']) < 1) || (utf8_strlen($this->request->post['weight_tons']) > 64) || !is_numeric($this->request->post['weight_tons'])  ) {
           //          $this->error['error_weight_tons'] = $this->language->get('error_numeric');
           // }
            
            if( $this->request->post['frequency'] == 0 )         
                if ((utf8_strlen($this->request->post['loading_date']) < 1) || (utf8_strlen($this->request->post['loading_date']) > 64)   ) {            
                     $this->error['error_loading_date'] = $this->language->get('error_empty');
                }
                       
            if ( $this->request->post['offloading_country_id'] == '')  {
                     $this->error['error_offloading_country'] = $this->language->get('error_empty');
            }
            
            if ( $this->request->post['loading_country_id'] == '')  {
                     $this->error['error_loading_country'] = $this->language->get('error_empty');
            }
            
            
            if (!$this->error) {                  
                    return true;
            } else {
                    $this->error['warning'] = $this->language->get('error_warning');
                    return false;
            }
  	}
	
  	protected function validateDelete() {
    /*	if (!$this->user->hasPermission('modify', 'catalog/ship')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}*/
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	protected function validateCopy() {
    	/*if (!$this->user->hasPermission('modify', 'catalog/ship')) {
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
			$this->load->model('catalog/ship');
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
			
			$results = $this->model_catalog_ship->getProducts($data);
			
			foreach ($results as $result) {
				$option_data = array();
				
				$product_options = $this->model_catalog_ship->getProductOptions($result['product_id']);	
				
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
}
?>
