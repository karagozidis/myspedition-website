<?php   
class ControllerExtensionExcel extends Controller {   
	public function index() {
    	$this->language->load('common/home');
	 
		$this->document->setTitle($this->language->get('heading_title'));
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_overview'] = $this->language->get('text_overview');
		$this->data['text_statistics'] = $this->language->get('text_statistics');
		$this->data['text_latest_10_orders'] = $this->language->get('text_latest_10_orders');
		$this->data['text_total_sale'] = $this->language->get('text_total_sale');
		$this->data['text_total_sale_year'] = $this->language->get('text_total_sale_year');
		$this->data['text_total_order'] = $this->language->get('text_total_order');
		$this->data['text_total_customer'] = $this->language->get('text_total_customer');
		$this->data['text_total_customer_approval'] = $this->language->get('text_total_customer_approval');
		$this->data['text_total_review_approval'] = $this->language->get('text_total_review_approval');
		$this->data['text_total_affiliate'] = $this->language->get('text_total_affiliate');
		$this->data['text_total_affiliate_approval'] = $this->language->get('text_total_affiliate_approval');
		$this->data['text_day'] = $this->language->get('text_day');
		$this->data['text_week'] = $this->language->get('text_week');
		$this->data['text_month'] = $this->language->get('text_month');
		$this->data['text_year'] = $this->language->get('text_year');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_order'] = $this->language->get('column_order');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_firstname'] = $this->language->get('column_firstname');
		$this->data['column_lastname'] = $this->language->get('column_lastname');
		$this->data['column_action'] = $this->language->get('column_action');
		
		$this->data['entry_range'] = $this->language->get('entry_range');
		
		// Check install directory exists
 		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$this->data['error_install'] = $this->language->get('error_install');
		} else {
			$this->data['error_install'] = '';
		}

		// Check image directory is writable
		$file = DIR_IMAGE . 'test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_image'] = sprintf($this->language->get('error_image'). DIR_IMAGE);
		} else {
			$this->data['error_image'] = '';
			
			unlink($file);
		}
		
		// Check image cache directory is writable
		$file = DIR_IMAGE . 'cache/test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_image_cache'] = sprintf($this->language->get('error_image_cache'). DIR_IMAGE . 'cache/');
		} else {
			$this->data['error_image_cache'] = '';
			
			unlink($file);
		}
		
		// Check cache directory is writable
		$file = DIR_CACHE . 'test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_cache'] = sprintf($this->language->get('error_image_cache'). DIR_CACHE);
		} else {
			$this->data['error_cache'] = '';
			
			unlink($file);
		}
		
		// Check download directory is writable
		$file = DIR_DOWNLOAD . 'test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_download'] = sprintf($this->language->get('error_download'). DIR_DOWNLOAD);
		} else {
			$this->data['error_download'] = '';
			
			unlink($file);
		}
		
		// Check logs directory is writable
		$file = DIR_LOGS . 'test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_logs'] = sprintf($this->language->get('error_logs'). DIR_LOGS);
		} else {
			$this->data['error_logs'] = '';
			
			unlink($file);
		}
										
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('sale/order');

		$this->data['total_sale'] = $this->currency->format($this->model_sale_order->getTotalSales(), $this->config->get('config_currency'));
		$this->data['total_sale_year'] = $this->currency->format($this->model_sale_order->getTotalSalesByYear(date('Y')), $this->config->get('config_currency'));
		$this->data['total_order'] = $this->model_sale_order->getTotalOrders();
		
		$this->load->model('sale/customer');
		
		$this->data['total_customer'] = $this->model_sale_customer->getTotalCustomers();
		$this->data['total_customer_approval'] = $this->model_sale_customer->getTotalCustomersAwaitingApproval();
		
		$this->load->model('catalog/review');
		
		$this->data['total_review'] = $this->model_catalog_review->getTotalReviews();
		$this->data['total_review_approval'] = $this->model_catalog_review->getTotalReviewsAwaitingApproval();
		
		$this->load->model('sale/affiliate');
		
		$this->data['total_affiliate'] = $this->model_sale_affiliate->getTotalAffiliates();
		$this->data['total_affiliate_approval'] = $this->model_sale_affiliate->getTotalAffiliatesAwaitingApproval();
				
		$this->data['orders'] = array(); 
		
		$data = array(
			'sort'  => 'o.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 10
		);
		
		$results = $this->model_sale_order->getOrders($data);
    	
    	foreach ($results as $result) {
			$action = array();
			 
			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'], 'SSL')
			);
					
			$this->data['orders'][] = array(
				'order_id'   => $result['order_id'],
				'customer'   => $result['customer'],
				'status'     => $result['status'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'total'      => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'action'     => $action
			);
		}

                
                
                
                //*********************************************************************** 
                /*
               $this->data['freightListUrl'] = $this->url->link('catalog/freight', 'token=' . $this->session->data['token'] , 'SSL'); 
               $this->data['truckListUrl'] = $this->url->link('catalog/truck', 'token=' . $this->session->data['token'] , 'SSL'); 
               $this->data['productsListUrl'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] , 'SSL'); 
               $this->data['customersListUrl'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] , 'SSL'); 
              
                $data = array(
			'sort'            => ' pd.name ',
			'order'           => '&order = ASC',
			'start'           => 0,
			'limit'           => 20,
      		);
                
              
                $this->data['freights'] = array();
                
                $this->load->model('catalog/freight');    
                $product_total = $this->model_catalog_freight->getTotalProducts($data);
			
		$results = $this->model_catalog_freight->getProducts($data);
                
                foreach ($results as $result) {
			$action = array();
			
	
                $this->load->model('localisation/country');                               
                $loading_coutry = $this->model_localisation_country->getCountry( $result['loading_country_id'] );
                $offloading_coutry = $this->model_localisation_country->getCountry( $result['offloading_country_id'] );
                
                $this->load->model('localisation/zone');                 
                $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );
                
                $this->load->model('catalog/treiler');             
                $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         
           
      		$this->data['freights'][] = array(
				'product_id' => $result['freight_id'],
				'name'       => $result['name'],
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
                                'trailer'            =>  $trailer,
			);
                }
                
                $this->load->model('catalog/truck');    
                $this->data['trucks'] = array();
                $product_total = $this->model_catalog_truck->getTotalProducts($data);
			
		$results = $this->model_catalog_truck->getProducts($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
	
                $this->load->model('localisation/country');                               
                $loading_coutry = $this->model_localisation_country->getCountry( $result['loading_country_id'] );
                $offloading_coutry = $this->model_localisation_country->getCountry( $result['offloading_country_id'] );
                
                $this->load->model('localisation/zone');                 
                $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );
                
                $this->load->model('catalog/treiler');             
                $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;         
                
                
      		$this->data['trucks'][] = array(
				'product_id' => $result['truck_id'],
				'name'       => $result['name'],
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
			);
                }
                
                
                
                $this->data['products'] = array();
                
                $this->load->model('tool/image');
		$this->load->model('catalog/product');
                
                
                $data = array(
                        'start'           => 0,
			'limit'           => 18
		);
                                
                
                
		$product_total = $this->model_catalog_product->getTotalProducts($data);	
		$results = $this->model_catalog_product->getProducts($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] , 'SSL')
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 30, 30);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 30, 30);
			}
	
			$special = false;
			
			$product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);
			
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
				'status'     => ($result['product_status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'     => $action,
                                'email' => $result['email'],
                                'customer_name' => $result['customer_name'],
                                'customer_url'  => $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id='. $result['customer_id'], 'SSL') ,
                                'date_added'      => $result['date_added'],
			);
                }
                
                
                //Latest Customers
		 $customers_limit = '20';
		 $text_latest_customers = 'Latest 20 Customers';
		 $text_newsletter = 'Newsletter';		
		
		
		$this->load->language('sale/customer');
		$this->load->model('sale/customer');
	        $this->data['customers']=$this->model_sale_customer->getCustomers(array('sort'=>'c.date_added','order'=>'DESC','start'=>'0','limit'=>$customers_limit));
                */
                
                //***********************************************************************
                
                $this->data['customersUrl'] =  $this->url->link('extension/excel/exportCustomers', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['trucksUrl'] =  $this->url->link('extension/excel/exportTrucks', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['freightsUrl'] =  $this->url->link('extension/excel/exportFreights', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['productsUrl'] =  $this->url->link('extension/excel/exportProducts', 'token=' . $this->session->data['token'], 'SSL');
                
		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');
		
			$this->model_localisation_currency->updateCurrencies();
		}
		
		$this->template = 'extension/excel.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
	
        
        public function exportCustomers() {
          
		$customers_limit = '900000000000000';
		$this->load->model('sale/customer');
                $this->load->model('sale/customer_group');
                $this->load->model('tool/excelExport');
                   
                
	        $results = $this->model_sale_customer->getCustomers(array('sort'=>'c.date_added','order'=>'DESC','start'=>'0','limit'=>$customers_limit));
                $customers = array();
                $count = 0;
                  
                 $customers[] = array(
                                    'blank' => '',
                                    'Count' => '',
                                    'customer_id' => '',
                                    'firstname'       => '',
                                    'lastname'      => '',
                                    'email'      => '' ,
                                    'telephone'    => '',
                                    'fax'      => '',
                                    'skype' => '',
                                    'icq'      => '',
                                    'website' => '',
                                    'company' => '',
                                //    'company_type_id' => '',         
                                    'customer_group_id'   => '',
                                    'requested_customer_group_id' => '',
                                    'ip'     => '',
                                    'date_added'   => '',
                                    'description'     => '',                
                                    'payment'      => '',
                                    'payment_status'      => '',
                                    'date_purchased'      => '',
                                    'verified'      => ''
                                    );
                
                 $customers[] = array(
                                    'blank' => '',
                                    'Count' => 'Count',
                                    'customer_id' => 'Customer id',
                                    'firstname'       => 'Firstname',
                                    'lastname'      => 'Lastname',
                                    'email'      => 'Email' ,
                                    'telephone'    => 'Telephone',
                                    'fax'      => 'Fax',
                                    'skype' => 'Skype',
                                    'icq'      => 'Icq',
                                    'website' => 'Website',
                                    'company' => 'Company',
                                 //   'company_type_id' => 'Company type',         
                                    'customer_group_id'   => 'Customer group',
                                    'requested_customer_group_id' => 'Requested customer group',
                                    'ip'     => 'Ip',
                                    'date_added'   => 'Date added',
                                    'description'     => 'Description',                
                                    'payment'      => 'Payment',
                                    'payment_status'      => 'Payment status',
                                    'date_purchased'      => 'Date purchased',
                                    'verified'      => 'Verified'
                                    );
                
                 $customers[] = array(
                                    'blank' => '',
                                    'Count' => '',
                                    'customer_id' => '',
                                    'firstname'       => '',
                                    'lastname'      => '',
                                    'email'      => '' ,
                                    'telephone'    => '',
                                    'fax'      => '',
                                    'skype' => '',
                                    'icq'      => '',
                                    'website' => '',
                                    'company' => '',
                                //    'company_type_id' => '',         
                                    'customer_group_id'   => '',
                                    'requested_customer_group_id' => '',
                                    'ip'     => '',
                                    'date_added'   => '',
                                    'description'     => '',                
                                    'payment'      => '',
                                    'payment_status'      => '',
                                    'date_purchased'      => '',
                                    'verified'      => ''
                                    );
                
                
                
                foreach ($results as $result) {
                    $count++;
                    
                    $cg = $this->model_sale_customer_group->getCustomerGroup($result['customer_group_id']);
                    $rcg = $this->model_sale_customer_group->getCustomerGroup($result['requested_customer_group_id']);
                    
                    if($result['verified'] == 0)   $verified = 'No';
                    else if($result['verified'] == 1)   $verified = 'Yes';
                    else $verified = '';
                    
                    if($result['payment_status'] == 0)   $payment_status = 'Not required';
                    else if($result['payment_status'] == 1)   $payment_status = 'Pending';
                    else if($result['payment_status'] == 2)   $payment_status = 'Payed';
                    else $payment_status = '';
                    
                    $customers[] = array(
                                    'blank' => '',
                                    'Count' => $count,
                                    'customer_id' => $result['customer_id'],
                                    'firstname'       => $result['firstname'],
                                    'lastname'      => $result['lastname'],
                                    'email'      => $result['email'],
                                    'telephone'    => $result['telephone'],
                                    'fax'      => $result['fax'],
                                    'skype' => $result['skype'],
                                    'icq'      => $result['icq'],
                                    'website' => $result['website'],
                                    'company' => $result['company'],
                                  //  'company_type_id' => $result['company_type_id'],
                                    'customer_group_id'   => $cg['name'],
                                    'requested_customer_group_id' => $rcg['name'],
                                    'ip'     => $result['ip'],
                                    'date_added'   => $result['date_added'],
                                    'description'     => $result['description'],
                                    'payment'      => $result['payment'],
                                    'payment_status'      => $payment_status,
                                    'date_purchased'      => $result['date_purchased'],
                                    'verified'      => $verified
                                    );
                }
                
                
                
           //  $doc = array (
           //     1 => array ("Oliver", "Peter", "Paul"),
           //          array ("Marlene", "Lucy", "Lina")
           //     );

            $this->model_tool_excelExport->addArray ( $customers );
            $this->model_tool_excelExport->generateXML ("myspedition_customers");
            
            // generate excel file
            // $xls = new Excel_XML;
            // $xls->addArray ( $doc );
            // $xls->generateXML ("mytest");
            
        }
        
        
        
        
        public function exportTrucks() {
          
		$customers_limit = '900000000000000';
		$this->load->model('catalog/truck');
                $this->load->model('localisation/country');
                $this->load->model('localisation/zone');
                $this->load->model('catalog/treiler');
                $this->load->model('tool/excelExport');
                $this->load->model('catalog/freightLoadingType');
                  
                
	        $results = $this->model_catalog_truck->getProducts(array('sort'=>'c.date_added','order'=>'DESC','start'=>'0','limit'=>$customers_limit));
                $trucks = array();
                $count = 0;
                  
                    $trucks[] = array(
                                    'blank'                 => '',
                                    'Count'                 => '',
                                    'customer_id'           => '',
                                    'loading_country_id'    => '',
                                    'loading_zone_id'       => '',
                                    'loading_city'          => '',
                                    'loading_zip'           => '',
                                    'loading_date'          => '',
                                    'est_date'              => '',
                                    'offloading_country_id' => '',
                                    'offloading_zone_id'    => '',
                                    'offloading_city'       => '',
                                    'offloading_zip'        => '',
                                    'offloading_date'       => '',
                                    'freight_params'        => '',
                                    'freight_number'        => '',
                                    'weight_tons'           => '',
                                    'pallets_no'            => '',
                                    'exchangeable'          => '',
                                    'stackable'             => '',
                                    'volume_unit'           => '',
                                    'volume_unit_type'      => '',
                                    'trailer_type_id'       => '',
                                    'lift'                  => '',
                                    'manipulator'           => '',
                                    'status'                => '',
                                    'date_added'            => '',
                                    'frequency'             => '',
                                    'adr'                   =>'',
                                    'tir'                   => '',
                                    'cmr'                   => '',
                                    'cemt'                  => ''
                                    );
                
                      $trucks[] = array(
                                    'blank'                     => '',
                                    'Count'                     => 'Count',
                                    'customer_id'               => 'Customer id',
                                    'loading_country_id'        => 'Loading country',
                                    'loading_zone_id'           => 'loading zone',
                                    'loading_city'              => 'Loading city',
                                    'loading_zip'               => 'Loading zip',
                                    'loading_date'              => 'Loading date',
                                    'est_date'                  => 'Estimaiton date (+- in days)',
                                    'offloading_country_id'     => 'Offloading country',
                                    'offloading_zone_id'        => 'Offloading zone',
                                    'offloading_city'           => 'Offloading city',
                                    'offloading_zip'            => 'Offloading zip',
                                    'offloading_date'           => 'Offloading date',
                                    'freight_params'            => 'Freight params',
                                    'freight_number'            => 'Freight number',
                                    'weight_tons'               => 'Weight tons',
                                    'pallets_no'                => 'Pallets no',
                                    'exchangeable'              => 'Exchangeable',
                                    'stackable'                 => 'Stackable',
                                    'volume_unit'               => 'Volume unit',
                                    'volume_unit_type'          => 'Volume unit type',
                                    'trailer_type_id'           => 'Trailer type',
                                    'lift'                      => 'Lift',
                                    'manipulator'               => 'Manipulator',
                                    'status'                    => 'Status',
                                    'date_added'                => 'Date added',
                                    'frequency'                 => 'Frequency',
                                    'adr'                       =>'Adr',
                                    'tir'                       => 'Tir',
                                    'cmr'                       => 'Cmr',
                                    'cemt'                      => 'Cemt'
                                    );
               
                        $trucks[] = array(
                                    'blank'                     => '',
                                    'Count'                     => '',
                                    'customer_id'               => '',
                                    'loading_country_id'        => '',
                                    'loading_zone_id'           => '',
                                    'loading_city'              => '',
                                    'loading_zip'               => '',
                                    'loading_date'              => '',
                                    'est_date'                  => '',   
                                    'offloading_country_id'     => '',
                                    'offloading_zone_id'        => '',
                                    'offloading_city'           => '',
                                    'offloading_zip'            => '',
                                    'offloading_date'           => '',
                                    'freight_params'            => '',
                                    'freight_number'            => '',
                                    'weight_tons'               => '',
                                    'pallets_no'                => '',
                                    'exchangeable'              => '',
                                    'stackable'                 => '',
                                    'volume_unit'               => '',
                                    'volume_unit_type'          => '',
                                    'trailer_type_id'           => '',
                                    'lift'                      => '',
                                    'manipulator'               => '',
                                    'status'                    => '',
                                    'date_added'                => '',
                                    'frequency'                 => '',
                                    'adr'                       =>'',
                                    'tir'                       => '',
                                    'cmr'                       => '',
                                    'cemt'                      => ''
                                    );
                
                
                
                foreach ($results as $result) {
                    $count++;
                    
                    $lc = $this->model_localisation_country->getCountry($result['loading_country_id']);
                    $offlc = $this->model_localisation_country->getCountry($result['offloading_country_id']);
                               
                    $lz = $this->model_localisation_zone->getZone($result['loading_zone_id']);
                    $offlz = $this->model_localisation_zone->getZone($result['offloading_zone_id']);
                    $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id']);
                    
                 //   $freight_type = $this->model_catalog_freightType->getTreiler($result['freight_type_id']);             
                //    $payment_terms = $this->model_catalog_freightPaymentTerms->getPaymentTerm($result['payment_terms_id']);
                 //   $payment_method = $this->model_catalog_freightPaymentMethod->getPaymentMethod($result['payment_method_id']);
                 //   $freight_loading_type = $this->model_catalog_freightLoadingType->getLoadingType($result['freight_loading_type_id']);
                    
                    
                    $trailerN = $trailer['name'];
                    $trailerN = str_replace(">","",$trailerN);
                    $trailerN = str_replace("<","",$trailerN);
                    
                    $lcn = '';
                    if ( isset($lc['name']) ) $lcn = $lc['name']; 
                    $offlcn = '';
                    if ( isset($offlc['name']) ) $offlcn = $offlc['name']; 
                    $lzn = '';
                    if ( isset($lz['name']) ) $lzn = $lz['name']; 
                    $offlzn = '';
                    if ( isset($offlz['name']) ) $offlzn = $offlz['name']; 
                    
                    
                    $trucks[] = array(
                                    'blank' => '',
                                    'Count' => $count,
                                    'customer_id'               => $result['customer_id'],
                                    'loading_country_id'        => $lcn,
                                    'loading_zone_id'           => $lzn,
                                    'loading_city'              => $result['loading_city'],
                                    'loading_zip'               => $result['loading_zip'],
                                    'loading_date'              => $result['loading_date'],
                                    'est_date'                  => $result['est_date'],
                                    'offloading_country_id'     =>  $offlcn,
                                    'offloading_zone_id'        =>  $offlzn,
                                    'offloading_city'           => $result['offloading_city'],
                                    'offloading_zip'            => $result['offloading_zip'],
                                    'offloading_date'           => $result['offloading_date'],
                                    'freight_params'            => $result['freight_params'],
                                    'freight_number'            => $result['freight_number'],
                                    'weight_tons'               => $result['weight_tons'],
                                    'pallets_no'                => $result['pallets_no'],
                                    'exchangeable'              => ( $result['exchangeable'] == 1 ? 'Yes' : 'No' ) ,
                                    'stackable'                 => ( $result['stackable'] == 1 ? 'Yes' : 'No' ) ,
                                    'volume_unit'               => $result['volume_unit'],
                                    'volume_unit_type'          => $result['volume_unit_type'],
                                    'trailer_type_id'           => $trailerN,
                                    'lift'                      => ( $result['lift'] == 1 ? 'Yes' : 'No' ) ,
                                    'manipulator'               => ( $result['manipulator'] == 1 ? 'Yes' : 'No' ) ,
                                    'status'                    => ( $result['status'] == 1 ? 'Active' : 'Disabled' ) ,
                                    'date_added'                => $result['date_added'],
                                    'frequency'                 => $result['frequency'],
                                    'adr'                       => ( $result['adr'] == 1 ? 'Yes' : 'No' ) ,
                                    'tir'                       => ( $result['tir'] == 1 ? 'Yes' : 'No' ) ,
                                    'cmr'                       => ( $result['cmr'] == 1 ? 'Yes' : 'No' ) ,
                                    'cemt'                      => ( $result['cemt']== 1 ? 'Yes' : 'No' ) 
                                    );
                    
                }
                
                
            $this->model_tool_excelExport->addArray ( $trucks );
            $this->model_tool_excelExport->generateXML ("myspedition_trucks");
            
            
        }
        
        public function exportFreights() {
          
		$customers_limit = '900000000000000';
		$this->load->model('catalog/freight');
                
                $this->load->model('localisation/country');
                $this->load->model('localisation/zone');
                $this->load->model('tool/excelExport');
                $this->load->model('catalog/treiler');
                
                
                $this->load->model('catalog/freightType');
                
                $this->load->model('catalog/freightPaymentTerms');
                $this->load->model('catalog/freightPaymentMethod');
                $this->load->model('catalog/freightLoadingType');

                
	        $results = $this->model_catalog_freight->getProducts(array('sort'=>'c.date_added','order'=>'DESC','start'=>'0','limit'=>$customers_limit));
                $freights = array();
                $count = 0;
                  
                 $freights[] = array(
                                    'blank'                    => '',
                                    'Count'                    => '',
                                    'customer_id'              => '',
                                    'loading_country_id'       => '',
                                    'loading_zone_id'          => '',
                                    'loading_city'             => '',
                                    'loading_zip'              => '',
                                    'loading_date'             => '',
                                    'est_date'                 => '',
                                    'offloading_country_id'    => '',
                                    'offloading_zone_id'       => '',
                                    'offloading_city'          => '',
                                    'offloading_zip'           => '',
                                    'offloading_date'          => '',
                                    'freight_params'           => '',
                                    'freight_number'           => '',
                                    'weight_tons'              => '',
                                    'pallets_no'               => '',
                                    'exchangeable'             => '',
                                    'stackable'                => '',
                                    'volume_unit'              => '',
                                    'volume_unit_type'         => '',
                                    'freight_type_id'          => '',
                                    'freight_loading_type_id'  => '',
                                    'freight_rate'             => '',
                                    'payment_terms_id'         => '',
                                    'payment_method_id'        => '',
                                    'trailer_type_id'          => '',
                                    'lift'                     => '',
                                    'manipulator'              => '',
                                    'status'                   => '',
                                    'date_added'               => '',
                                    'frequency'                => '',
                                    'adr'                       =>'',
                                    'tir'                       => '',
                                    'cmr'                       => '',
                                    'cemt'                      => '',
                                    't1'                        => '',
                                    'ex1'                       => '',
                                    );
                
                $freights[] = array(
                                    'blank'                     => '',
                                    'Count'                     => 'Count',
                                    'customer_id'               => 'Customer id',
                                    'loading_country_id'        => 'Loading country',
                                    'loading_zone_id'           => 'Loading zone',
                                    'loading_city'              => 'Loading City',
                                    'loading_zip'               => 'Loading zip',
                                    'loading_date'              => 'Loading date',
                                    'est_date'                  => 'Estimation date',
                                    'offloading_country_id'      => 'Offloading country',
                                    'offloading_zone_id'        => 'Offloading zone',
                                    'offloading_city'           => 'Offloading city',
                                    'offloading_zip'            => 'Offloading zip',
                                    'offloading_date'           => 'Offloading date',
                                    'freight_params'            => 'Freight params',
                                    'freight_number'            => 'Freight number',
                                    'weight_tons'               => 'Weight tons',
                                    'pallets_no'                => 'Pallets no',
                                    'exchangeable'              => 'Exchangeable',
                                    'stackable'                 => 'Stackable',
                                    'volume_unit'               => 'Volume unit',
                                    'volume_unit_type'          => 'Volume unit type',
                                    'freight_type_id'           => 'Freight type',
                                    'freight_loading_type_id'   => 'Freight loading type',
                                    'freight_rate'              => 'Freight rate',
                                    'payment_terms_id'          => 'Payment terms',
                                    'payment_method_id'         => 'Payment method',
                                    'trailer_type_id'           => 'Trailer type',
                                    'lift'                      => 'Lift',
                                    'manipulator'               => 'Manipulator',
                                    'status'                    => 'Status',
                                    'date_added'                => 'Date added',
                                    'frequency'                 => 'Frequency',
                                    'adr'                       =>'Adr',
                                    'tir'                       => 'Tir',
                                    'cmr'                       => 'Cmr',
                                    'cemt'                      => 'Cemt',
                                    't1'                        => 'T1',
                                    'ex1'                       => 'Ex1',
                                    );
               
       $freights[] = array(
                                    'blank'                 => '',
                                    'Count'                 => '',
                                    'customer_id'           => '',
                                    'loading_country_id'    => '',
                                    'loading_zone_id'       => '',
                                    'loading_city'          => '',
                                    'loading_zip'           => '',
                                    'loading_date'          => '',
                                    'est_date'              => '',
                                    'offloading_country_id' => '',
                                    'offloading_zone_id'    => '',
                                    'offloading_city'       => '',
                                    'offloading_zip'        => '',
                                    'offloading_date'       => '',
                                    'freight_params'        => '',
                                    'freight_number'        => '',
                                    'weight_tons'           => '',
                                    'pallets_no'            => '',
                                    'exchangeable'          => '',
                                    'stackable'             => '',
                                    'volume_unit'           => '',
                                    'volume_unit_type'      => '',
                                    'freight_type_id'       => '',
                                    'freight_loading_type_id' => '',
                                    'freight_rate'          => '',
                                    'payment_terms_id'      => '',
                                    'payment_method_id'     => '',
                                    'trailer_type_id'       => '',
                                    'lift'                  => '',
                                    'manipulator'           => '',
                                    'status'                => '',
                                    'date_added'            => '',
                                    'frequency'             => '',
                                    'adr'                   =>'',
                                    'tir'                   => '',
                                    'cmr'                   => '',
                                    'cemt'                  => '',
                                    't1'                    => '',
                                    'ex1'                   => ''
                                    );
                
                
                
                foreach ($results as $result) {
                    
                    $count++;
                    $lc = $this->model_localisation_country->getCountry($result['loading_country_id']);
                    $offlc = $this->model_localisation_country->getCountry($result['offloading_country_id']);
                    $lz = $this->model_localisation_zone->getZone($result['loading_zone_id']);
                    $offlz = $this->model_localisation_zone->getZone($result['offloading_zone_id']);
                    $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id']);
                    
                    $freight_type = $this->model_catalog_freightType->getFreight($result['freight_type_id']);             
                    $payment_terms = $this->model_catalog_freightPaymentTerms->getPaymentTerm($result['payment_terms_id']);
                    $payment_method = $this->model_catalog_freightPaymentMethod->getPaymentMethod($result['payment_method_id']);
                    $freight_loading_type = $this->model_catalog_freightLoadingType->getLoadingType($result['freight_loading_type_id']);
                
                    $trailerN = $trailer['name'];
                    $trailerN = str_replace(">","",$trailerN);
                    $trailerN = str_replace("<","",$trailerN);
                    
                    $lcn = '';
                    if ( isset($lc['name']) ) $lcn = $lc['name']; 
                    $offlcn = '';
                    if ( isset($offlc['name']) ) $offlcn = $offlc['name']; 
                    $lzn = '';
                    if ( isset($lz['name']) ) $lzn = $lz['name']; 
                    $offlzn = '';
                    if ( isset($offlz['name']) ) $offlzn = $offlz['name']; 
                    
                    
                    
                    $freights[] = array(
                                    'blank'                     => '',
                                    'Count'                     => $count,
                                    'customer_id'               => $result['customer_id'],
                                    'loading_country_id'        => $lcn,
                                    'loading_zone_id'           => $lzn,
                                    'loading_city'              => $result['loading_city'],
                                    'loading_zip'               => $result['loading_zip'],
                                    'loading_date'              => $result['loading_date'],
                                    'est_date'                  => $result['est_date'],
                                    'offloading_country_id'     => $offlcn,
                                    'offloading_zone_id'        => $offlzn,
                                    'offloading_city'           => $result['offloading_city'],
                                    'offloading_zip'            => $result['offloading_zip'],
                                    'offloading_date'           => $result['offloading_date'],
                                    'freight_params'            => $result['freight_params'],
                                    'freight_number'            => $result['freight_number'],
                                    'weight_tons'               =>  $result['weight_tons'],
                                    'pallets_no'                => $result['pallets_no'],
                                    'exchangeable'              => ( $result['exchangeable']  == 1 ? 'Yes' : 'No' ) ,
                                    'stackable'                 => ( $result['stackable']  == 1 ? 'Yes' : 'No' ) ,
                                    'volume_unit'               => $result['volume_unit'],
                                    'volume_unit_type'          => $result['volume_unit_type'],
                                    'freight_type_id'           => $freight_type['name'],
                                    'freight_loading_type_id'   => $freight_loading_type['name'],
                                    'freight_rate'              => $result['freight_rate'],
                                    'payment_terms_id'          => $payment_terms['name'],
                                    'payment_method_id'         => $payment_method['name'],
                                    'trailer_type_id'           => $trailerN,
                                    'lift'                      => ( $result['lift']  == 1 ? 'Yes' : 'No' ) ,
                                    'manipulator'               => ( $result['manipulator']  == 1 ? 'Yes' : 'No' ) ,
                                    'status'                    => ( $result['status']  == 1 ? 'Enabled' : 'Disabled' ) ,
                                    'date_added'                => $result['date_added'],
                                    'frequency'                 => $result['frequency'],
                                    'adr'                       => ( $result['adr']  == 1 ? 'Yes' : 'No' ) ,
                                    'tir'                       => ( $result['tir']  == 1 ? 'Yes' : 'No' ) ,
                                    'cmr'                       => ( $result['cmr']  == 1 ? 'Yes' : 'No' ) ,
                                    'cemt'                      => ( $result['cemt'] == 1 ? 'Yes' : 'No' ) ,
                                    't1'                        => ( $result['t1']   == 1 ? 'Yes' : 'No' ) ,
                                    'ex1'                       => ( $result['ex1']  == 1 ? 'Yes' : 'No' ) 
                                    );
                }
                
                
            $this->model_tool_excelExport->addArray ( $freights );
            $this->model_tool_excelExport->generateXML ("myspedition_freights");
            
            
        }
        
        public function exportProducts() {
          
		$customers_limit = '900000000000000';
		$this->load->model('catalog/product');
                // $this->load->model('sale/customer_group');
                $this->load->model('tool/excelExport');
                $this->load->model('tool/image');   
               
	        $results = $this->model_catalog_product->getProducts(array('sort'=>'c.date_added','order'=>'DESC','start'=>'0','limit'=>$customers_limit));
                $products = array();
                $count = 0;
                  
                 $products[] = array(
                                    'blank'         => '',
                                    'Count'         => '',
                                    'product_id'    => '',
                                    'name'          => '',
                                    'model'         => '',
                                    'price'         => '',
                                    'quantity'      => '',
                                    'status'        => '',
                                    'selected'      => '',
                                    'email'         => '',
                                    'customer_name' => '',
                                    'date_added'    => '',
                                    'image'         => ''
                                    );
                
                $products[] = array(
                                    'blank'             => '',
                                    'Count'             => 'Count',
                                    'product_id'        => 'product_id',
                                    'name'              => 'Name',
                                    'model'             => 'Model',
                                    'price'             => 'Price',
                                    'quantity'          => 'Quantity',
                                    'status'            => 'Status',
                                    'selected'          => 'Selected',
                                    'email'             => 'Email',
                                    'customer_name'     => 'Customer name',
                                    'date_added'        => 'Date added',
                                    'image'             => 'Image Url'
                                    );
               
       $products[] = array(
                                    'blank'         => '',
                                    'Count'         => '',
                                    'product_id'    => '',
                                    'name'          => '',
                                    'model'         => '',
                                    'price'         => '',
                                    'quantity'      => '',
                                    'status'        => '',
                                    'selected'      => '',
                                    'email'         => '',
                                    'customer_name' => '',
                                    'date_added'    => '',
                                    'image'         =>  ''
                                    );
                
                
                
                foreach ($results as $result) {
                    $count++;
                    
                  /*  if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                            $image = $this->model_tool_image->resize($result['image'], 60, 60);
                    } else {
                            $image = $this->model_tool_image->resize('no_image.jpg', 60, 60);
                    } */
                    
                    $products[] = array(
                                    'blank' => '',
                                    'Count' => $count,
                                    'product_id' => $result['product_id'],
                                    'name'       => $result['name'],
                                    'model'      => $result['model'],
                                    'price'      => $result['price'],
                                    'quantity'   => $result['quantity'],
                                    'status'     => ($result['product_status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                                    'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
                                    'email'      => $result['email'],
                                    'customer_name'     => $result['customer_name'],
                                    'date_added'        => $result['date_added'],
                                    'image'      => $result['image']
                                    );
                }
                
                
            $this->model_tool_excelExport->addArray ( $products );
            $this->model_tool_excelExport->generateXML ("myspedition_products");
            
            
        }
	
	public function permission() {
		if (isset($this->request->get['route'])) {
			$route = '';
			
			$part = explode('/', $this->request->get['route']);
			
			if (isset($part[0])) {
				$route .= $part[0];
			}
			
			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}
			
			$ignore = array(
				'common/home',
				'common/login',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'error/not_found',
				'error/permission'		
			);			
						
			if (!in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
				return $this->forward('error/permission');
			}
		}
	}	
}
?>