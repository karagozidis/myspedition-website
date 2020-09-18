<?php 
class ControllerProductTransportationCategory extends Controller {  
	public function index() { 
            
		$this->language->load('product/transportationCategory');		
		$this->load->model('catalog/category');		
		$this->load->model('catalog/transportation');		
		$this->load->model('tool/image'); 
													
                
	  		$this->document->setTitle("Transportation List");
			$this->document->setDescription("Transportation List");
			$this->document->setKeywords("Transportation_List");
			$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
			
			$this->data['heading_title'] = "Last Entered Freights - Trucks";
			                    
                         /*******************************************************************************/
                         $this->data['last_entered_trucks_text'] = $this->language->get('last_entered_trucks_text');
                         $this->data['loading_date_text'] = $this->language->get('loading_date_text');
                         $this->data['trailer_text'] = $this->language->get('trailer_text');
                         $this->data['company_text'] = $this->language->get('company_text');
                         $this->data['loading_country_text'] = $this->language->get('loading_country_text');
                         $this->data['region_state_text'] = $this->language->get('region_state_text');
                         $this->data['city_area_text'] = $this->language->get('city_area_text');
                         $this->data['offloading_country_text'] = $this->language->get('offloading_country_text');
                         $this->data['last_entered_freights_text'] = $this->language->get('last_entered_freights_text');               
                        /*******************************************************************************/
                        
			$filter = '';
                        $sort = 'p.date_added';
                        $order = 'DESC';
                        $page = 1;
                        $limit = $this->config->get('config_catalog_limit');	
			
                        $data = array(
				'filter_filter'      => $filter, 
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);                   
                        
			$this->load->model('catalog/truck');
                        $this->load->model('catalog/freight'); 
                        $this->load->model('localisation/country');
                        $this->load->model('customer/customer');
                        
			$results = $this->model_catalog_truck->getProducts($data);             
			foreach ($results as $result) {
                            
                                $loading_country = $this->model_localisation_country->getCountry($result['loading_country_id']);
                                $offloading_country = $this->model_localisation_country->getCountry($result['offloading_country_id']);
                                                                  
                                $this->load->model('localisation/zone');                 
                                $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                                $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );                              
                                             
                                $this->load->model('catalog/treiler');             
                                $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         

                                $this->load->model('account/customer');             
                                $owner = $this->model_account_customer->getCustomerByTruck($result['truck_id'])   ;  
                                
                                if( $result['frequency'] == 1 ) $loading_date = '[Regular]';
                                else  $loading_date =  $result['loading_date'];
                                
				$this->data['trucks'][] = array(
					'product_id'  => $result['truck_id'],
					'name'        => $result['name'],
                                        'number_of_trucks' => $result['number_of_trucks'],
                                        'est_date' => $result['est_date'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'loading_date' => $loading_date,
                                        'loading_country' => $loading_country,
                                        'loading_city' => $result['loading_city'],
                                        'offloading_country' => $offloading_country,
                                        'offloading_city' => $result['offloading_city'],
                                        'href'         => '?route=product/truck&product_id='.$result['truck_id'],
                                        'loading_zone'       =>  $loading_zone,
                                        'offloading_zone'    =>  $offloading_zone,
                                        'trailer'            =>  $trailer,
                                        'owner'              =>  $owner
							
				);
                                                                                              
			}
                        
                        
                        
                      //  $freight_total = $this->model_catalog_freight->getTotalProducts($data); 			
			$results = $this->model_catalog_freight->getProducts($data);			
                                                 
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
                               
                                if( $result['frequency'] == 1 ) $loading_date = '[Regular]';
                                else  $loading_date =  $result['loading_date'];
				$this->data['freights'][] = array(
					'product_id'  => $result['freight_id'],
					'name'        => $result['name'],
                                        'number_of_trucks' => $result['number_of_trucks'],
                                        'est_date' => $result['est_date'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'loading_date' => $loading_date,
                                        'loading_country' => $loading_country,
                                        'loading_city' => $result['loading_city'],
                                        'offloading_country' => $offloading_country,
                                        'offloading_city' => $result['offloading_city'],
                                        'href'         => '?route=product/freight&product_id='.$result['freight_id'],
                                        'loading_zone'       =>  $loading_zone,
                                        'offloading_zone'    =>  $offloading_zone,
                                        'trailer'            =>  $trailer,
                                        'owner' => $owner
				);
						                                                   
			}
                        
                        
                        if ($this->customer->isLogged()) 
                        {
                            $customer = $this->model_customer_customer->getCustomer($this->customer->getId());	
                            
                            $this->data['customer_country'] = $this->model_localisation_country->getCountry($customer['country_id']);
                            $this->data['customer_logged'] = 'true';
                            
                            /*************************************************/
                            
                              $data = array(
				'filter_filter'      => $filter, 
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit ,
                                'loading_country_id' => $customer['country_id']
                                );     
                              
                                $this->data['truck_from_url'] = $this->url->link('product/truckCategory','&search_loading_country='.$customer['country_id'], 'SSL');
                                
                                $results = $this->model_catalog_truck->getProducts($data);      
                                foreach ($results as $result) {

                                        $loading_country = $this->model_localisation_country->getCountry($result['loading_country_id']);
                                        $offloading_country = $this->model_localisation_country->getCountry($result['offloading_country_id']);

                                        $this->load->model('localisation/zone');                 
                                        $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                                        $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );                              

                                        $this->load->model('catalog/treiler');             
                                        $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         

                                        $this->load->model('account/customer');             
                                        $owner = $this->model_account_customer->getCustomerByTruck($result['truck_id'])   ;  

                                        if( $result['frequency'] == 1 ) $loading_date = '[Regular]';
                                        else  $loading_date =  $result['loading_date'];

                                        $this->data['customer_trucks_loading_country'][] = array(
                                                'product_id'  => $result['truck_id'],
                                                'number_of_trucks' => $result['number_of_trucks'],
                                                'est_date' => $result['est_date'],
                                                'name'        => $result['name'],
                                                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
                                                'loading_date' => $loading_date,
                                                'loading_country' => $loading_country,
                                                'loading_city' => $result['loading_city'],
                                                'offloading_country' => $offloading_country,
                                                'offloading_city' => $result['offloading_city'],
                                                'href'         => '?route=product/truck&product_id='.$result['truck_id'],
                                                'loading_zone'       =>  $loading_zone,
                                                'offloading_zone'    =>  $offloading_zone,
                                                'trailer'            =>  $trailer,
                                                'owner' => $owner

                                        );

                                }
                                
                                /*************************************************/
                                
                                $this->data['freight_from_url'] = $this->url->link('product/freightCategory', '&search_loading_country='.$customer['country_id'], 'SSL');
                                
                                $results = $this->model_catalog_freight->getProducts($data);			             
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

                                        $this->data['customer_freights_loading_country'][] = array(
                                                'product_id'  => $result['freight_id'],
                                                'number_of_trucks' => $result['number_of_trucks'],
                                                'est_date' => $result['est_date'],
                                                'name'        => $result['name'],
                                                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
                                                'loading_date' => $result['loading_date'],
                                                'loading_country' => $loading_country,
                                                'loading_city' => $result['loading_city'],
                                                'offloading_country' => $offloading_country,
                                                'offloading_city' => $result['offloading_city'],
                                                'href'         => '?route=product/freight&product_id='.$result['freight_id'],
                                                'loading_zone'       =>  $loading_zone,
                                                'offloading_zone'    =>  $offloading_zone,
                                                'trailer'            =>  $trailer,
                                                'owner' => $owner							
                                        );

                                }
                                
                                /*************************************************/
                                
                                
                               $data = array(
				'filter_filter'      => $filter, 
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit ,
                                'offloading_country_id' => $customer['country_id']
                                );   
                               
                                $this->data['truck_to_url'] = $this->url->link('product/truckCategory', '&search_offloading_country='.$customer['country_id'], 'SSL');
                                
                                $results = $this->model_catalog_truck->getProducts($data);             
                                foreach ($results as $result) {

                                        $loading_country = $this->model_localisation_country->getCountry($result['loading_country_id']);
                                        $offloading_country = $this->model_localisation_country->getCountry($result['offloading_country_id']);

                                        $this->load->model('localisation/zone');                 
                                        $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                                        $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );                              

                                        $this->load->model('catalog/treiler');             
                                        $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         

                                        $this->load->model('account/customer');             
                                        $owner = $this->model_account_customer->getCustomerByTruck($result['truck_id'])   ;  

                                        if( $result['frequency'] == 1 ) $loading_date = '[Regular]';
                                        else  $loading_date =  $result['loading_date'];

                                        $this->data['customer_trucks_loading_country'][] = array(
                                                'product_id'  => $result['truck_id'],
                                                'number_of_trucks' => $result['number_of_trucks'],
                                                'est_date' => $result['est_date'],
                                                'name'        => $result['name'],
                                                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
                                                'loading_date' => $loading_date,
                                                'loading_country' => $loading_country,
                                                'loading_city' => $result['loading_city'],
                                                'offloading_country' => $offloading_country,
                                                'offloading_city' => $result['offloading_city'],
                                                'href'         => '?route=product/truck&product_id='.$result['truck_id'],
                                                'loading_zone'       =>  $loading_zone,
                                                'offloading_zone'    =>  $offloading_zone,
                                                'trailer'            =>  $trailer,
                                                'owner' => $owner

                                        );

                                }
                                
                                /*************************************************/
                                
                                $this->data['freight_to_url'] = $this->url->link('product/freightCategory', '&search_offloading_country='.$customer['country_id'], 'SSL');
                                
                                $results = $this->model_catalog_freight->getProducts($data);			             
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

                                        $this->data['customer_freights_loading_country'][] = array(
                                                'product_id'  => $result['freight_id'],
                                                'number_of_trucks' => $result['number_of_trucks'],
                                                'est_date' => $result['est_date'],
                                                'name'        => $result['name'],
                                                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
                                                'loading_date' => $result['loading_date'],
                                                'loading_country' => $loading_country,
                                                'loading_city' => $result['loading_city'],
                                                'offloading_country' => $offloading_country,
                                                'offloading_city' => $result['offloading_city'],
                                                'href'         => '?route=product/freight&product_id='.$result['freight_id'],
                                                'loading_zone'       =>  $loading_zone,
                                                'offloading_zone'    =>  $offloading_zone,
                                                'trailer'            =>  $trailer,
                                                'owner' => $owner							
                                        );

                                }           
                        } 
                        
                        $this->load->model('catalog/storedTexts');
                        $this->data['companyViewText'] = $this->model_catalog_storedTexts->getStoredText('companyViewText'); 
                        
                        if ($this->customer->isLogged())
                        {   
                            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/transportationCategory_logged.tpl')) {
                                    $this->template = $this->config->get('config_template') . '/template/product/transportationCategory_logged.tpl';
                            } else {
                                    $this->template = 'default/template/product/transportationCategory_logged.tpl';
                            }
                        }
                        else 
                        {
                           if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/transportationCategory_general.tpl')) {
                                    $this->template = $this->config->get('config_template') . '/template/product/transportationCategory_general.tpl';
                            } else {
                                    $this->template = 'default/template/product/transportationCategory_general.tpl';
                            }  
                            
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
        
public function getTrucks($data) { 
    
    
}
public function getfreights($data) { 
    
    
}
        
}
?>