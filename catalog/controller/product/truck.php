<?php 
class ControllerProductTruck extends Controller {
	private $error = array(); 
     
  	public function index() {           
                $this->show();
  	}
  

  	public function Show() {
    	$this->language->load('product/truck');
        
    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/truck');
                         

    	$this->getForm();
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
			$sort = 'pd.name';
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
       		'text'      => " Freight list",
			'href'      => $this->url->link('catalog/truck',/* 'token=' . $this->session->data['token'] . */ $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('catalog/truck/insert',/* 'token=' . $this->session->data['token'] .*/ $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/truck/copy',/* 'token=' . $this->session->data['token'] .*/ $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/truck/delete',/* 'token=' . $this->session->data['token'] . */$url, 'SSL');
    	
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
		
		$product_total = $this->model_catalog_truck->getTotalProducts($data);
			
		$results = $this->model_catalog_truck->getProducts($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/truck/update', /*'token=' . $this->session->data['token'] .*/ '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
	
			$special = false;
			
			$product_specials = $this->model_catalog_truck->getProductSpecials($result['product_id']);
			
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
                $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         
                
                $this->load->model('account/customer');             
                $owner = $this->model_account_customer->getCustomerByTruck($result['truck_id'])   ;  
                
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
                                'loading_date' => $result['loading_date'],
                                'est_date' => $result['est_date'],
                                'loading_country' => $loading_coutry,
                                'offloading_country' => $offloading_coutry,
                                'loading_zone'       =>  $loading_zone,
                                'offloading_zone'    =>  $offloading_zone,
                                'trailer'            =>  $trailer,
                                'owner' => $owner
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
					
		$this->data['sort_name'] = $this->url->link('catalog/truck', /*'token=' . $this->session->data['token'] . '&sort=pd.name' . */ $url, 'SSL');
		$this->data['sort_model'] = $this->url->link('catalog/truck',/* 'token=' . $this->session->data['token'] . '&sort=p.model' . */ $url, 'SSL');
		$this->data['sort_price'] = $this->url->link('catalog/truck', /* 'token=' . $this->session->data['token'] . '&sort=p.price' . */ $url, 'SSL');
		$this->data['sort_quantity'] = $this->url->link('catalog/truck', /* 'token=' . $this->session->data['token'] . '&sort=p.quantity' . */ $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/truck', /* 'token=' . $this->session->data['token'] . '&sort=p.status' . */ $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/truck', /* 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . */ $url, 'SSL');
		
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
		$pagination->url = $this->url->link('catalog/truck',/* 'token=' . $this->session->data['token'] . */ $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_model'] = $filter_model;
		$this->data['filter_price'] = $filter_price;
		$this->data['filter_quantity'] = $filter_quantity;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/truck_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	protected function getForm() {
            
                $this->data['heading_title'] = $this->language->get('heading_title');
		                
                $this->data['entry_name'] = $this->language->get('entry_name');		
		$this->data['entry_description'] = $this->language->get('entry_description');
                
                $this->data['tab_general'] = $this->language->get('tab_general');		
		$this->data['tab_image'] = $this->language->get('tab_image');
            	$this->data['tab_location_and_date_text'] = $this->language->get('tab_location_and_date_text');
                $this->data['tab_freight_parameters_text'] = $this->language->get('tab_freight_parameters_text');
		$this->data['tab_map_text'] = $this->language->get('tab_map_text');
		$this->data['register_login_text'] = $this->language->get('register_login_text');
		$this->data['no_descriptions_text'] = $this->language->get('no_descriptions_text');
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
		$this->data['regular_freight_text'] = $this->language->get('regular_freight_text');
                     	
                $this->data['trailer_type_text'] = $this->language->get('trailer_type_text');
                $this->data['lift_text'] = $this->language->get('lift_text');
		$this->data['manipulator_text'] = $this->language->get('manipulator_text');
		$this->data['freight_type_text'] = $this->language->get('freight_type_text');		
		$this->data['loading_type_text'] = $this->language->get('loading_type_text');
		$this->data['freight_parameters_text'] = $this->language->get('freight_parameters_text');
                $this->data['weight_tons_text'] = $this->language->get('weight_tons_text');		
		$this->data['pallets_no_text'] = $this->language->get('pallets_no_text');
		$this->data['volume_unit_text'] = $this->language->get('volume_unit_text');
		$this->data['freight_rate_text'] = $this->language->get('freight_rate_text');
                
                $this->data['payment_terms_text'] = $this->language->get('payment_terms_text');
                $this->data['payment_method_text'] = $this->language->get('payment_method_text');
		$this->data['from_text'] = $this->language->get('from_text');
		$this->data['weather_text'] = $this->language->get('weather_text');		
		$this->data['clouds_text'] = $this->language->get('clouds_text');
		$this->data['to_text'] = $this->language->get('to_text');
                $this->data['description_title_text'] = $this->language->get('description_title_text');		
		$this->data['description_text'] = $this->language->get('description_text');
                
                $this->data['exchangeable_text'] = $this->language->get('exchangeable_text');
                $this->data['non_exchangeable_text'] = $this->language->get('non_exchangeable_text');
                $this->data['stackable_text'] = $this->language->get('stackable_text');
                $this->data['non_stackable_text'] = $this->language->get('non_stackable_text');
                
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
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
       		'text'      => "Insert new freight ",
			'href'      => $this->url->link('catalog/truck/insert',/* 'token=' . $this->session->data['token'] . */ $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
			
                $this->data['upgradeUrl'] =  $this->url->link('account/upgrade', 'SSL'); 
                $this->load->model('catalog/storedTexts');
                $this->data['upgradeSmallText'] = $this->model_catalog_storedTexts->getStoredText('upgradeSmallText'); 
                
                
                $this->data['view_telephone'] = false;
                $this->data['view_skype'] = false;  
                if ($this->customer->isLogged()) 
                    {
                    $cg = $this->customer->getCustomerGroup();
                    $this->data['view_telephone'] = $cg['view_telephone']; 
                    $this->data['view_skype'] = $cg['view_skype']; 
                    }
                
		if (!isset($this->request->get['product_id'])) {
			$this->data['action'] = $this->url->link('catalog/truck/insert', /*'token=' . $this->session->data['token'] . */$url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/truck/update', /*'token=' . $this->session->data['token'] . */'&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/truck', /*'token=' . $this->session->data['token'] .*/ $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$product_info = $this->model_catalog_truck->getProduct($this->request->get['product_id']);
                }
        
                if (!$product_info)
                    {
                    $this->session->data['redirect'] = $this->url->link('product/truck', '', 'SSL');
                    $this->redirect($this->url->link('error/not_found', '', 'SSL'));
                    }
                              
                
		$this->data['token'] = '';
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['product_description'])) {
			$this->data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_description'] = $this->model_catalog_truck->getProductDescriptions($this->request->get['product_id']);
		} else {
			$this->data['product_description'] = array();
		}
		
                
                
                $this->load->model('localisation/country');    
                $coutries_total = $this->model_localisation_country->getCountries();                    
                
                $this->data['coutries_total'] = $coutries_total;
                
                 if ($this->customer->isLogged()) {	 
                         $this->data['isLogged'] = True;
                 } else {	 
                         $this->data['isLogged'] = False;
                 }
                    
                $this->load->model('customer/customer');    
                $this->data['customer'] = $this->model_customer_customer->getCustomer( $product_info['customer_id'] ); 
                          
                    
                   $loading_coutry = $this->model_localisation_country->getCountry( $product_info['loading_country_id'] );
                   
                   $this->data['loading_country'] =  $loading_coutry;       
                   $this->data['loading_city'] = $product_info['loading_city'];        
                    
                    $offloading_coutry = $this->model_localisation_country->getCountry( $product_info['offloading_country_id'] );  
                        $this->data['offloading_country'] = $offloading_coutry;

                    $this->data['offloading_city'] = $product_info['offloading_city'];
                    $this->data['loading_date'] = $product_info['loading_date'];
                    $this->data['offloading_date'] = $product_info['offloading_date'];
                    $this->data['frequency'] = $product_info['frequency']; 
                    
                    $this->data['est_date'] = $product_info['est_date'];
                    

                    $this->load->model('localisation/zone');  
                    $loading_zone = $this->model_localisation_zone->getZone(  $product_info['loading_zone_id'] );
                    $this->data['loading_zone'] = $loading_zone;
                    $offloading_zone = $this->model_localisation_zone->getZone(  $product_info['offloading_zone_id'] );
                    $this->data['offloading_zone'] = $offloading_zone;
              
                    $loadingCountryDesc = "";
                    $loadingZoneDesc = "";
                    $loadingCityDesc = "";  
                    $offloadingCountryDesc = "";   
                    $offloadingZoneDesc  = "";
                    $offloadingCityDesc = "";
                    
                    if(isset($this->data['loading_country']['name']))
                         $loadingCountryDesc =  $this->data['loading_country']['name'];
                    if( isset($this->data['loading_zone']['name']) )
                         $loadingZoneDesc = $this->data['loading_zone']['name'];
                    if(isset($this->data['loading_city']))
                         $loadingCityDesc =  $this->data['loading_city'];
                    if( isset($this->data['offloading_country']['name']) )
                        $offloadingCountryDesc =  $this->data['offloading_country']['name'];
                    if(isset($this->data['offloading_zone']['name']))
                        $offloadingZoneDesc = $this->data['offloading_zone']['name'];
                    if(isset($this->data['offloading_city']))
                        $offloadingCityDesc =  $this->data['offloading_city'];
                    
                    if ($product_info['frequency']== 1)
                        {
                        $loadingDateDesc = "Regual freight(Every week,Month)";
                        }
                    else 
                        {
                        $loadingDateDesc = $product_info['loading_date'];
                        }
                        
                    $newFreightText = "" 
                            .$this->language->get('from_text')." ". $loadingCountryDesc." ".$loadingZoneDesc." ".$loadingCityDesc."  |  "
                            .$this->language->get('to_text')." ". $offloadingCountryDesc." ".$offloadingZoneDesc." ".$offloadingCityDesc."  |  "
                            .$this->language->get('loading_date_text').": ". $loadingDateDesc ." ";
                            
                    $this->document->setTitle('New Trucks available on MySpedition.net NOW!');
                    $this->document->setDescription($newFreightText);
                    $this->document->setKeywords('trucks online ,truck ,free trucks');
                    $this->document->setImage('http://www.myspedition.net/image/truck.png');
                    
                    
                    
        
                        $this->data['freight_params'] = $product_info['freight_params'];
                        $this->data['weight_tons'] = $product_info['weight_tons'];
			$this->data['pallets_no'] = $product_info['pallets_no'];             
			$this->data['loading_zone_id'] = $product_info['loading_zone_id'];      
			$this->data['loading_zip'] = $product_info['loading_zip'];      
			$this->data['loading_time'] = $product_info['loading_time'];                                  
			$this->data['offloading_zone_id'] = $product_info['offloading_zone_id'];
			$this->data['offloading_zip'] = $product_info['offloading_zip'];
			$this->data['offloading_time'] = $product_info['offloading_time'];
			$this->data['freight_number'] = $product_info['freight_number'];
			$this->data['exchangeable'] = $product_info['exchangeable'];
			$this->data['stackable'] = $product_info['stackable'];
			$this->data['volume_unit'] = $product_info['volume_unit'];
			$this->data['volume_unit_type'] = $product_info['volume_unit_type'];                   
			$this->data['adr'] = $product_info['adr'];     
			$this->data['tir'] = $product_info['tir'];
			$this->data['cmr'] = $product_info['cmr'];
			$this->data['cemt'] = $product_info['cemt'];                        
                        $this->data['lift'] = $product_info['lift'];
                        $this->data['manipulator'] = $product_info['manipulator'];      
                        $this->data['description'] = $product_info['description'];        
                        $this->data['frequency'] = $product_info['frequency'];

                 
                        $this->load->model('catalog/treiler');    
                        $treiler_type = $this->model_catalog_treiler->getTreiler($product_info['trailer_type_id']);     
                        $this->data['treiler_type'] = $treiler_type;

                        $this->load->model('tool/image');
                        $this->data['images'] = array();		
			$results = $this->model_catalog_truck->getProductImages($this->request->get['product_id']);			
			foreach ($results as $result) {
				$this->data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);
			}	

                if (!empty($product_info)) {
			$this->data['number_of_trucks'] = $product_info['number_of_trucks'];
                } else {
                        $this->data['number_of_trucks'] = '1';
                }
                        
                        
		$this->load->model('tool/image');
		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && $product_info['image'] && file_exists(DIR_IMAGE . $product_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		

		$this->data['date_available'] = date('d-m-Y', strtotime($product_info['date_available']));
									
      		$this->data['sort_order'] = $product_info['sort_order'];		

		$this->data['status'] = $product_info['status'];
		
		// Options
		$this->load->model('catalog/option');
		
		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_catalog_truck->getProductOptions($this->request->get['product_id']);			
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
			$this->data['product_discounts'] = $this->model_catalog_truck->getProductDiscounts($this->request->get['product_id']);
		} else {
			$this->data['product_discounts'] = array();
		}

		if (isset($this->request->post['product_special'])) {
			$this->data['product_specials'] = $this->request->post['product_special'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_specials'] = $this->model_catalog_truck->getProductSpecials($this->request->get['product_id']);
		} else {
			$this->data['product_specials'] = array();
		}
		
		// Images
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_images = $this->model_catalog_truck->getProductImages($this->request->get['product_id']);
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
			$product_downloads = $this->model_catalog_truck->getProductDownloads($this->request->get['product_id']);
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
			$products = $this->model_catalog_truck->getProductRelated($this->request->get['product_id']);
		} else {
			$products = array();
		}
	
		$this->data['product_related'] = array();
		
		foreach ($products as $product_id) {
			$related_info = $this->model_catalog_truck->getProduct($product_id);
			
			if ($related_info) {
				$this->data['product_related'][] = array(
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
		}

						
		if (isset($this->request->post['product_reward'])) {
			$this->data['product_reward'] = $this->request->post['product_reward'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_reward'] = $this->model_catalog_truck->getProductRewards($this->request->get['product_id']);
		} else {
			$this->data['product_reward'] = array();
		}
		
		if (isset($this->request->post['product_layout'])) {
			$this->data['product_layout'] = $this->request->post['product_layout'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_layout'] = $this->model_catalog_truck->getProductLayouts($this->request->get['product_id']);
		} else {
			$this->data['product_layout'] = array();
		}

		//$this->load->model('design/layout');
		//$this->data['layouts'] = $this->model_design_layout->getLayout();
                
		$this->load->model('catalog/storedTexts');
                $this->data['companyViewLargeText'] = $this->model_catalog_storedTexts->getStoredText('companyViewLargeText'); 								
                
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/truck.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/truck.tpl';
		} else {
			$this->template = 'default/template/product/truck.tpl';
		}
                
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
}
?>
