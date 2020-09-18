<?php 
class ControllerProductCalendar extends Controller {  
	public function index() 
                { 
		$this->language->load('product/dictionary');		
		
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => 'Calendar',
			'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);
                               
 
	  		$this->document->setTitle($this->language->get('title'));
			$this->document->setDescription($this->language->get('title'));
			$this->document->setKeywords($this->language->get('title'));
			$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
			
			$this->data['heading_title'] = $this->language->get('title');
			                      
                     
                        $this->data['description'] = $this->language->get('description');
                        $this->data['welcome'] = $this->language->get('welcome');                         												
                             
                        $this->data['listLink'] =$this->url->link('product/calendar/nodelist', 'SSL');

                        $this->data['monthNames']
                                = Array("January", "February", "March", "April", "May", "June", "July", 
                            "August", "September", "October", "November", "December"); 

                        if ( isset($this->request->get['month']) )
                            {
                             $cMonth = $this->request->get['month'];
                            }
                        else
                            {
                             $cMonth = date("n");
                            }

                       if ( isset($this->request->get['year']) )
                            {
                             $cYear = $this->request->get['year'];
                            }
                        else
                            {
                             $cYear = date("Y");
                            }
                            
                        $prev_year = $cYear;
                        $next_year = $cYear;
                        $prev_month = $cMonth-1;
                        $next_month = $cMonth+1;

                        if ($prev_month == 0 ) 
                            {
                            $prev_month = 12;
                            $prev_year = $cYear - 1;
                            }
                        if ($next_month == 13 ) 
                            {
                            $next_month = 1;
                            $next_year = $cYear + 1;
                            }

                         $this->data["cMonth"] =$cMonth;        
                         $this->data["cYear"] =$cYear;      

                         $this->data["prev_year"] =$prev_year;        
                         $this->data["next_year"] =$next_year; 
                         $this->data["prev_month"] =$prev_month;        
                         $this->data["next_month"] =$next_month; 

                         $this->data["prev_url"] =  $this->url->link('product/calendar',"&month=".$prev_month."&year=".$prev_year, 'SSL');
                         $this->data["next_url"] =  $this->url->link('product/calendar',"&month=".$next_month."&year=".$next_year, 'SSL');


                         $this->load->model('account/calendar_node');
                         
                         $data =  array(
                             'filter_month' => $cMonth
                             );
                         $this->data['nodes'] =  $this->model_account_calendar_node->getNodes($data);
                         
                         
                        $this->load->model('catalog/freight');            
                        $timestamp = mktime(0,0,0,$cMonth,1,$cYear);
                        $maxday = date("t",$timestamp);
                       
                        $data = array(
                                    'loading_date_from'     =>    $cYear.'/'.$cMonth.'/1',
                                    'loading_date_to'       =>    $cYear.'/'.$cMonth.'/'.$maxday,
                                    'customer_id'           =>    $this->customer->getId() 
                                    );    
			$this->data['total_freights'] = $this->model_catalog_freight->getTotalProducts($data); 
			$freights = $this->model_catalog_freight->getProducts($data);
                        
                        
                        $this->data['freights'][] =  array();
                       
                        foreach ($freights as $freight)
                            {  
                            $timestamp = strtotime($freight['loading_date']);
                            $day = (int) date('d', $timestamp);
            
                             
                            $this->load->model('localisation/country');                               
                            $loading_coutry = $this->model_localisation_country->getCountry( $freight['loading_country_id'] );
                            $offloading_coutry = $this->model_localisation_country->getCountry( $freight['offloading_country_id'] );

                            $this->load->model('localisation/zone');                 
                            $loading_zone = $this->model_localisation_zone->getZone( $freight['loading_zone_id'] );
                            $offloading_zone = $this->model_localisation_zone->getZone( $freight['offloading_zone_id'] );

                            $this->load->model('catalog/treiler');             
                            $trailer = $this->model_catalog_treiler->getTreiler($freight['trailer_type_id'])   ;         

                           // $this->load->model('account/customer');             
                          //  $owner = $this->model_account_customer->getCustomerByFreight($freight['freight_id'])   ;

                            if( $freight['frequency'] == 1 ) $loading_date = '[Regular]';
                            else  $loading_date =  $freight['loading_date'];

                            $offer_url = $this->url->link('catalog/freightOffer/receivedList', '&freight_id=' . $freight['product_id'], 'SSL'); 
                            
                            $action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/freight/update', '&product_id=' . $freight['product_id'] )
                             );
                            
                            $this->data['freights'][$day][] = array(
                                'product_id' => $freight['product_id'],
				'name'       => $freight['name'],
                                'company'    => $freight['company'],
                                'number_of_trucks' => $freight['number_of_trucks'],
                                'est_date' => $freight['est_date'],
				'action'     => $this->url->link('catalog/freight/update', '&product_id=' . $freight['product_id'] ),                      
                                'loading_city' => $freight['loading_city'],
                                'offloading_city' => $freight['offloading_city'],
                                'loading_date' => $loading_date,
                                'est_date' => $freight['est_date'],
                                'loading_country' => $loading_coutry,
                                'offloading_country' => $offloading_coutry,
                                'loading_zone'       =>  $loading_zone,
                                'offloading_zone'    =>  $offloading_zone,
                                'trailer'            =>  $trailer,
                                'total_offers'       =>  $freight['total_offers'],
                                'offer_url'       =>  $offer_url   
                                );
                            }
                             
                        
                        $this->load->model('catalog/truck');
                        $this->data['total_trucks'] = $this->model_catalog_truck->getTotalProducts($data);
		        $trucks = $this->model_catalog_truck->getProducts($data);   
                            
                        foreach ($trucks as $truck)
                            {
                            $timestamp = strtotime($truck['loading_date']);
                            $day = (int) date('d', $timestamp);
            
                             
                            $this->load->model('localisation/country');                               
                            $loading_coutry = $this->model_localisation_country->getCountry( $truck['loading_country_id'] );
                            $offloading_coutry = $this->model_localisation_country->getCountry( $truck['offloading_country_id'] );

                            $this->load->model('localisation/zone');                 
                            $loading_zone = $this->model_localisation_zone->getZone( $truck['loading_zone_id'] );
                            $offloading_zone = $this->model_localisation_zone->getZone( $truck['offloading_zone_id'] );

                            $this->load->model('catalog/treiler');             
                            $trailer = $this->model_catalog_treiler->getTreiler($truck['trailer_type_id'])   ;         

                            $this->load->model('account/customer');             
                            $owner = $this->model_account_customer->getCustomerByTruck($truck['truck_id'])   ;  
                
                            if( $truck['frequency'] == 1 ) $loading_date = '[Regular]';
                            else  $loading_date =  $truck['loading_date'];
                            
                        
                          
                            $this->data['trucks'][$day][] = array(
                                'product_id' => $truck['product_id'],
				'name'       => $truck['name'],
                                'number_of_trucks' => $truck['number_of_trucks'],
                                'est_date' => $truck['est_date'],
				'status'     => ($truck['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($truck['product_id'], $this->request->post['selected']),
				'action'     => $this->url->link('catalog/truck/update', '&product_id=' . $truck['product_id'] ),                        
                                'loading_city' => $truck['loading_city'],
                                'offloading_city' => $truck['offloading_city'],
                                'loading_date' => $loading_date,
                                'est_date' => $truck['est_date'],
                                'loading_country' => $loading_coutry,
                                'offloading_country' => $offloading_coutry,
                                'loading_zone'       =>  $loading_zone,
                                'offloading_zone'    =>  $offloading_zone,
                                'trailer'           =>  $trailer,
                                );
                            }
                          
			 if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/calendar.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/calendar.tpl';
			 } else {
				$this->template = 'default/template/product/calendar.tpl';
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
            
       public function deleteNode() 
                { 
           	$json = array();
		$this->load->model('account/calendar_node');
                $this->model_account_calendar_node->deleteNode($this->request->get['calendar_node_id']);
		
                $json['success'] = true;
		
		
		$this->response->setOutput(json_encode($json));
                }
       
      public function deleteFreight() 
            {
             if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
                
            $this->load->model('catalog/freight');                    
            $this->model_catalog_freight->deleteProduct($this->request->get['freight_id']);	
            }            
                         
      public function deleteTruck() 
            {
             if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
                
            $this->load->model('catalog/truck');                    
            $this->model_catalog_truck->deleteProduct($this->request->get['truck_id']);	
            }         
                
    
       public function insertNote() 
            {
                $this->language->load('product/nodelist');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('account/calendar_node');
                
    	        $this->getForm();
            }
            
       public function nodelist() 
            {
                $this->language->load('product/nodelist');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('account/calendar_node');
                
    	        $this->getList();
            }
            
       public function node() 
            {     
                if (!$this->customer->isLogged()) {
                                $this->session->data['redirect'] = $this->url->link('product/calendar/node', 'SSL');
                                $this->redirect($this->url->link('account/login', '', 'SSL'));
                        } 
                        

                $this->language->load('product/nodelist');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('account/calendar_node');        
                        
                        
                if ( ($this->request->server['REQUEST_METHOD'] == 'POST') //&& $this->validateForm() 
                        ) {

                                $this->model_account_calendar_node->addNode($this->request->post);

                                $this->session->data['success'] = $this->language->get('text_success');

                               /* $url = '';

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
                                } */
                                $url = "";
                                $url .= '&month=' . $this->request->post['month'];
                                $url .= '&year=' .  $this->request->post['year'];
                                
                                $this->redirect($this->url->link('product/calendar',$url));
                                
                               // $this->redirect($this->url->link('product/calendar', $url, 'SSL'));
                }
                
    	        $this->getForm();
            }
            
         public function nodeUpdate() 
            {     
                if (!$this->customer->isLogged()) {
                                $this->session->data['redirect'] = $this->url->link('product/calendar/node', 'SSL');
                                $this->redirect($this->url->link('account/login', '', 'SSL'));
                        } 
                        

                $this->language->load('product/nodelist');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('account/calendar_node');        
                        
                        
                if ( ($this->request->server['REQUEST_METHOD'] == 'POST') 
                        ) {

                                $this->model_account_calendar_node->editNode($this->request->post['calendar_node_id'],$this->request->post);

                                $timestamp = strtotime($this->request->post['date_refers']);
                                $year = (int) date('y', $timestamp);
                                $month = (int) date('m', $timestamp);
                                
                                $url = "";
                                $url .= '&month=' . $month;
                                $url .= '&year=' .  $year;
                                
                                $this->redirect($this->url->link('product/calendar',$url));
                }
                
                $this->data['action'] = $this->url->link('product/calendar/nodeUpdate');
                
    	        $this->getForm();
            }
       protected function getForm() {
         
		$this->language->load('product/isiblack_list');
		$this->document->SetTitle('Calendar Note ');
	   	$this->data['heading_title'] = 'Calendar Note ';//$this->language->get('heading_title');
		//$this->data['ip'] = $this->request->server['REMOTE_ADDR'];

		$this->language->load('module/black_list');
		$this->data['show_all'] = $this->language->get('show_all');
		$this->data['showall_url'] = $this->url->link('product/black_list');

		$this->load->model('catalog/black_list');
			
                $this->data['breadcrumbs'] = array();

                $this->data['breadcrumbs'][] = array(
	        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
	        	'separator' => false
                );

                $this->data['breadcrumbs'][] = array(
	        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/calendar/nodelist'),
	        	'separator' => $this->language->get('text_separator')
                );			

        
	    	$this->data['entry_title'] = $this->language->get('entry_title');
	    	$this->data['entry_name'] = $this->language->get('entry_name');
	    	$this->data['entry_city'] = $this->language->get('entry_city');
	    	$this->data['entry_email'] = $this->language->get('entry_email');
	    	$this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');
		$this->data['entry_rating'] = $this->language->get('entry_rating');
		$this->data['entry_good'] = $this->language->get('entry_good');
		$this->data['entry_bad'] = $this->language->get('entry_bad');
		$this->data['text_note'] = $this->language->get('text_note');
		$this->data['text_conditions'] = $this->language->get('text_conditions');


		if (isset($this->error['name'])) {
    		$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		if (isset($this->error['title'])) {
    		$this->data['error_title'] = $this->error['title'];
		} else {
			$this->data['error_title'] = '';
		}
		
		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}		
			
		if (isset($this->error['enquiry'])) {
			$this->data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$this->data['error_enquiry'] = '';
		}		
		
 		if (isset($this->error['captcha'])) {
			$this->data['error_captcha'] = $this->error['captcha'];
		} else {
			$this->data['error_captcha'] = '';
		}	

                if (isset($this->request->get['note_id'])) {
			$this->data['calendar_node_id'] = $this->request->get['note_id'];
                } elseif (!empty($product_info)) {
			$this->data['calendar_node_id'] = $product_info['calendar_node_id'];
		} else {
			$this->data['calendar_node_id'] = '';
		}    
                
                if (isset($this->request->get['month'])) {
			$this->data['month'] = $this->request->get['month'];
                } elseif (!empty($product_info)) {
			$this->data['month'] = $product_info['month_refers'];
		} else {
			$this->data['month'] = '';
		}
                
                if (isset($this->request->get['year'])) {
			$this->data['year'] = $this->request->get['year'];
                } elseif (!empty($product_info)) {
			$this->data['year'] = $product_info['year_refers'];
		} else {
			$this->data['year'] = '';
		}
                    
                
                if (isset($this->request->get['note_id']) ) {
                    $product_info = $this->model_account_calendar_node->getNode($this->request->get['note_id']);
                    $this->data['action'] = $this->url->link('product/calendar/nodeUpdate', 'SSL');
                    }
                else 
                    {
                     $this->data['action'] = $this->url->link('product/calendar/node' , 'SSL');
                    }  
                    
                 $url = "";
                 $url .= "kkk=" .$this->data['month'];
                 $url .= "year=" .$this->data['year'];
                 
                 $this->data['cancel'] = $this->url->link('product/calendar' ,$url);    
                 
                 
                    
		if (isset($this->request->post['title'])) {
			$this->data['title'] = $this->request->post['title'];
                } elseif (!empty($product_info)) {
			$this->data['title'] = $product_info['title'];
		} else {
			$this->data['title'] = '';
		} 
                
		if (isset($this->request->post['description'])) {
			$this->data['description'] = $this->request->post['description'];
                } elseif (!empty($product_info)) {
			$this->data['description'] = $product_info['description'];
		} else {
			$this->data['description'] = '';
		}
		if (isset($this->request->post['date_added'])) {
			$this->data['date_added'] = $this->request->post['date_added'];
                } elseif (!empty($product_info)) {
			$this->data['date_added'] = $product_info['date_added'];
		} else {
			$this->data['date_added'] = '';
		}
                
		if (isset($this->request->post['date_refers'])) {
			$this->data['date_refers'] = $this->request->post['date_refers'];
		} elseif (!empty($product_info)) {
			$this->data['date_refers'] = $product_info['date_refers'];
                } elseif (isset($this->request->get['year']) && isset($this->request->get['month'])  && isset($this->request->get['day'])) {
                        $this->data['date_refers'] = $this->request->get['year'];
                        $this->data['date_refers'] .= "-". $this->request->get['month'];
                        $this->data['date_refers'] .= "-". $this->request->get['day'];
		} else {
			$this->data['date_refers'] = '';
		}
              
                
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/calendar_note.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/calendar_note.tpl';
		} else {
			$this->template = 'default/template/product/calendar_note.tpl';
		}

		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'		
		); 

	
 		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));		
  	}      
            
            
            
            
            
      protected function getList() { 
            
             if (isset($this->request->get['filter_company'])) {
			$filter_company = $this->request->get['filter_company'];
		} else {
			$filter_company = null;
		}

                if (isset($this->request->get['filter_company'])) {
			$filter_company = $this->request->get['filter_company'];
		} else {
			$filter_company = null;
		}
                
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
       		'text'      => 'Nodelist',
			'href'      => $this->url->link('product/calendar/nodelist', $url, 'SSL'),
      		'separator' => ' :: '
   		);
                
                $url = '&year='.$this->request->get['year'];
                $url .= '&month='.$this->request->get['month'];
                        
                $this->data['calendarLink'] =  $this->url->link('product/calendar', $url);
		
		$this->data['delete'] = $this->url->link('customer/customer/delete', $url);
		$this->data['customers'] = array();
                
                $filter_loading_date = $this->request->get['year']."/";
                $filter_loading_date .= $this->request->get['month']."/";
                $filter_loading_date .= $this->request->get['day'];
                
                $data = array(
               //         'page'  =>0,
               //         'limit' => 100,
                        'loading_date_from'     =>    $filter_loading_date,
                        'loading_date_to'       =>    $filter_loading_date,
                    'customer_id'     => $this->customer->getId()
                        );    

                $this->load->model('catalog/truck');	
                $this->data['truck_total']  = $this->model_catalog_truck->getTotalProducts($data); 
               /* $this->data['trucks'] */ $trucks = $this->model_catalog_truck->getProducts($data);
                
                $this->data['trucks'] = array();
                foreach ($trucks as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/truck/update', /*'token=' . $this->session->data['token'] .*/ '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
	
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

                        if( $result['frequency'] == 1 ) $loading_date = '[Regular]';
                        else  $loading_date =  $result['loading_date'];

                        $this->data['trucks'][] = array(
                                        'product_id' => $result['product_id'],
                                        'name'       => $result['name'],
                                        'number_of_trucks' => $result['number_of_trucks'],
                                        'est_date' => $result['est_date'],
                                        'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                                        'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
                                        'action'     => $action,                        
                                        'loading_city' => $result['loading_city'],
                                        'offloading_city' => $result['offloading_city'],
                                        'loading_date' => $loading_date,
                                        'est_date' => $result['est_date'],
                                        'loading_country' => $loading_coutry,
                                        'offloading_country' => $offloading_coutry,
                                        'loading_zone'       =>  $loading_zone,
                                        'offloading_zone'    =>  $offloading_zone,
                                        'trailer'           =>  $trailer,
                                );
                }
                
                $this->load->model('catalog/freight');
                $this->data['freight_total']    = $this->model_catalog_freight->getTotalProducts($data); 
               /* $this->data['freights'] */  $freights = $this->model_catalog_freight->getProducts($data);
               $this->data['freights'] = array();
               foreach ($freights as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/freight/update','&product_id=' . $result['product_id'] . $url, 'SSL')
			);

                        $this->load->model('localisation/country');                               
                        $loading_coutry = $this->model_localisation_country->getCountry( $result['loading_country_id'] );
                        $offloading_coutry = $this->model_localisation_country->getCountry( $result['offloading_country_id'] );

                        $this->load->model('localisation/zone');                 
                        $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                        $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );

                        $this->load->model('catalog/treiler');             
                        $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         

                        $this->load->model('account/customer');             
                        $owner = $this->model_account_customer->getCustomerByFreight($result['freight_id'])   ;

                        if( $result['frequency'] == 1 ) $loading_date = '[Regular]';
                        else  $loading_date =  $result['loading_date'];

                        $offer_url = $this->url->link('catalog/freightOffer/receivedList', '&freight_id=' . $result['product_id'], 'SSL');

                        $this->data['freights'][] = array(
                                        'product_id' => $result['product_id'],
                                        'name'       => $result['name'],
                                        'company'    => $result['company'],
                                        'number_of_trucks' => $result['number_of_trucks'],
                                        'est_date' => $result['est_date'],
                                        'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                                        'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
                                        'action'     => $action,                        
                                        'loading_city' => $result['loading_city'],
                                        'offloading_city' => $result['offloading_city'],
                                        'loading_date' => $loading_date,
                                        'est_date' => $result['est_date'],
                                        'loading_country' => $loading_coutry,
                                        'offloading_country' => $offloading_coutry,
                                        'loading_zone'       =>  $loading_zone,
                                        'offloading_zone'    =>  $offloading_zone,
                                        'trailer'            =>  $trailer,
                                        'total_offers'       =>  $result['total_offers'],
                                        'offer_url'       =>  $offer_url,
                                        'owner' => $owner
                                );
                }
                
                
                $data =  array(
                             'filter_year' => $this->request->get['year'],
                             'filter_month' =>  $this->request->get['month'],
                             'filter_day' => $this->request->get['day'],
                             );
                
                $this->load->model('account/calendar_node');    
		$customer_total = $this->model_account_calendar_node->getTotalNodes($data);
		$results = $this->model_account_calendar_node->getNodes($data);
                $this->data['customer_total'] = $customer_total ;      
                
                foreach ($results as $result) {

                                $action = array(
                                        'text' => $this->language->get('text_edit'),
                                        'href' => $this->url->link('product/calendar/node', '&note_id=' . $result['calendar_node_id'] . $url, 'SSL')
                                ); 

                                $this->data['customers'][] = array(
                                        'calendar_node_id'  => $result['calendar_node_id'],
                                        'customer_id'       => $result['customer_id'],
                                        'title'             => $result['title'],
                                        'description'       => $result['description'],
                                        'date_added'        => $result['date_added'],
                                        'date_refers'       => $result['date_refers'],
                                        'action'            => $action
                                );
                        }	
					
		$this->data['heading_title'] = $filter_loading_date;//$this->language->get('heading_title');
                
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
                $this->data['route'] = html_entity_decode('customer/customer');
                if (  isset($this->request->get['country_id'])  )
                {
                 $this->data['country_id'] = $this->request->get['country_id'];
                 $url .= '&country_id=' . urlencode(html_entity_decode($this->request->get['country_id'], ENT_QUOTES, 'UTF-8'));   
                }   
                $this->data['searchByNameAction'] =  $this->url->link('customer/customer',$url, 'SSL');
                
                
                 
		if (isset($this->request->get['filter_name'])) 
                {
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
                
                $this->data['filter_company'] = $filter_company;
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_email'] = $filter_email;
		$this->data['filter_customer_group_id'] = $filter_customer_group_id;
		$this->data['filter_status'] = $filter_status;
		$this->data['filter_approved'] = $filter_approved;
		$this->data['filter_ip'] = $filter_ip;
		$this->data['filter_date_added'] = $filter_date_added;
		
		//$this->load->model('customer/customer_group');
		
               // $this->data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		//$this->load->model('setting/store');
		
		//$this->data['stores'] = $this->model_setting_store->getStores();
				
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		//$this->template = 'customer/customer_list.tpl';
                
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/calendar_node_list.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/calendar_node_list.tpl';
		} else {
			$this->template = 'default/template/product/calendar_node_list.tpl';
		}
		
                
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
        
        
        
}
?>