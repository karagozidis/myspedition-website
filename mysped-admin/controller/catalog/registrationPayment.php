<?php 
class ControllerCatalogRegistrationPayment extends Controller {
	private $error = array(); 
     
  	public function index() {
            
		//$this->language->load('catalog/truck');
    	
		$this->document->setTitle('Registration payments'); 
		
		$this->load->model('sale/customer_group_payment');               
		
		$this->getList();
  	}
  
  	/* public function insert() {
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
  	} */

  	public function update() {
    	//$this->language->load('catalog/truck');
        
    	$this->document->setTitle($this->language->get('heading_title'));
		
	$this->load->model('catalog/verification');
            
                
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			//$this->model_catalog_truck->editProduct($this->request->get['product_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
			
                        
			$this->redirect($this->url->link('sale/customer/update','customer_id='. $this->request->post['customer_id']   .'&token=' . $this->session->data['token'] . $url, 'SSL'));
			//$this->redirect($this->url->link('catalog/truck', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	} 

        public function editPayment() {
            $this->load->model('sale/customer_group_payment');
               
            if (isset($this->request->get['customer_id']) ) {
	  		        $this->model_sale_customer_group_payment->editPayment( $this->request->get['customer_id'] ) ;
                                $this->session->data['success'] = "Payment status updated";
		}
            
        $this->getForm(); 
        }
        
  	public function delete() {

    	$this->document->setTitle('Registration payments');
	$this->load->model('sale/customer_group_payment');
		
		if (isset($this->request->post['selected']) ) {
			foreach ($this->request->post['selected'] as $customer_group_payment_id) {
				$this->model_sale_customer_group_payment->deleteCustomerGroupPayment($customer_group_payment_id);
	  		}

			$this->session->data['success'] = "Registration payments deleted";//$this->language->get('text_success');
                      //  $this->redirect($this->url->link('catalog/registrationPayment',  '&token=' . $this->session->data['token'] , 'SSL'));
		}
    	$this->getList();
  	}

                
  	public function changeStatus() {

    	$this->document->setTitle('Registration payments');
	$this->load->model('sale/customer_group_payment');
		
		if ( isset($this->request->get['status']) && isset($this->request->get['customer_group_payment_id']) ) {
                   
                    $customer_group_payment_id = $this->request->get['customer_group_payment_id'];
                    $status = $this->request->get['status'];
                    
                    $this->model_sale_customer_group_payment->changeStatus($customer_group_payment_id,$status);
	  		

			$this->session->data['success'] = "Payment status Changed";
                      //$this->redirect($this->url->link('catalog/registrationPayment',  '&token=' . $this->session->data['token'] , 'SSL'));
		}
    	$this->getForm();
  	}
        
  	/*public function copy() {
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
  	} */
	
  	protected function getList() {	
                
                
                if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
                    } else {
			$filter_email = null;
                    }
                
                if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
                    } else {
			$filter_status = null;
                    }
                
                if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
                    } else {
			$filter_date_added = null;
                    }
                
                        
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
                    } else {
			$page = 1;
                    }
						
		$url = '';
	
		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}
                
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}
                
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . urlencode(html_entity_decode($this->request->get['filter_date_added'], ENT_QUOTES, 'UTF-8'));
		}
                
                
  		$this->data['breadcrumbs'] = array();
                $this->data['delete'] = $this->url->link('catalog/registrationPayment/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['registrationPayments'] = array();
                
             //   echo $filter_email;

		$data = array(
                        'filter_email'              => $filter_email, 
                        'filter_status'           => $filter_status, 
			'filter_date_added'             => $filter_date_added, 
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$registrationPaymentsTotal = $this->model_sale_customer_group_payment->getTotalCustomerGroupPayments($data);
		$results =                   $this->model_sale_customer_group_payment->getCustomerGroupPayments($data);
		
                $this->load->model('sale/customer'); 
                $this->load->model('sale/customer_group'); 
                
		foreach ($results as $result) {
			$action = array();
                        
                       
                         
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/registrationPayment/update', 'token=' . $this->session->data['token'] . '&customer_group_payment_id=' . $result['customer_group_payment_id'] . $url, 'SSL')
			);
     
                $customer = $this->model_sale_customer->getCustomer($result['customer_id']);
                $req_customer_group = $this->model_sale_customer_group->getCustomerGroup($result['requested_customer_group_id']);
                
                $customer['url']= $this->url->link('sale/customer/update','customer_id='. $result['customer_id']  .'&token=' . $this->session->data['token'] . $url, 'SSL');

                $customer_group = $this->model_sale_customer_group->getCustomerGroup($customer['customer_group_id']);     
                
      		$this->data['customer_group_payments'][] = array(
				'customer_group_payment_id'   => $result['customer_group_payment_id'],
                                'customer_id'         => $result['customer_id'],
                                'customer_group_id'   => $result['customer_group_id'],
                    
                                'req_customer_group'  => $req_customer_group ,
                                'customer_group'  =>  $customer_group ,
                               // 'customer_group_id'   => $result['customer_group_id'],
                                'description'         => $result['description'] ,
				'date_inserted'       => $result['date_inserted'] ,
                                'customer'            =>  $customer ,
                                
                                'price'               => $result['price'],
                                'date_success'        => $result['date_success'],
				'date_ipn'            => $result['date_ipn'],
                    
                                'date_cancel'         => $result['date_cancel'],
                                'status'              => $result['status'],
                    
				'ipn_received'        => $result['ipn_received'],
                                'cancel_received'     => $result['cancel_received'],
                                'success_received'    => $result['success_received'],
                    
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
                
                if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}
                
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}
                
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . urlencode(html_entity_decode($this->request->get['filter_date_added'], ENT_QUOTES, 'UTF-8'));
		}
                

		$this->data['filter_email'] = $filter_email;
                $this->data['filter_status'] = $filter_status;
		$this->data['filter_date_added'] = $filter_date_added;
                
                
		$pagination = new Pagination();
		$pagination->total = $registrationPaymentsTotal;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/registrationPayment', 'token=' . $this->session->data['token'] .  $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	

              
		$this->template = 'catalog/registrationPayment_list.tpl';
          

		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	protected function getForm() {
            
       $this->data['heading_title'] = "Registration payments"; 
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

               /* $this->data['breadcrumbs'][] = array(
       		'text'      => ' account',
			'href'      => $this->url->link('account/account', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

                                
   		$this->data['breadcrumbs'][] = array(
       		'text'      => "Insert new freight ",
			'href'      => $this->url->link('catalog/truck/insert','token=' . $this->session->data['token'] .  $url, 'SSL'),       		
      		'separator' => ' :: '
   		);*/
		
                
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
                
                $this->load->model('sale/customer_group_payment');
		if ( isset($this->request->get['customer_group_payment_id']) ) {
      		$payment_info = $this->model_sale_customer_group_payment->getCustomerGroupPayment($this->request->get['customer_group_payment_id']);
                }
        
                
		$this->data['token'] = $this->session->data['token'];
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
                
              //  $this->load->model('sale/customer');
             //   $this->load->model('sale/customer_group');
             //   $customer = $this->model_sale_customer->getCustomer($result['customer_id']);
             //   $req_customer_group = $this->model_sale_customer_group->getCustomerGroup($result['customer_group_id']);
             //   $customer['url']= $this->url->link('sale/customer/update','customer_id='. $result['customer_id']  .'&token=' . $this->session->data['token'] . $url, 'SSL');
             //   $customer_group = $this->model_sale_customer_group->getCustomerGroup($customer['customer_group_id']);     

        $this->data['cancel'] =  $this->url->link('catalog/registrationPayment','token=' . $this->session->data['token'] .'&customer_id='. $this->data['customer_id'] . $url, 'SSL');
      //  $this->data['verify'] =  $this->url->link('catalog/verification/verifyCompany','token=' . $this->session->data['token'] .'&customer_id='. $this->data['customer_id'] .'&verification_id='. $this->request->get['verification_id'] .$url, 'SSL');

        
        if (isset($this->request->post['description'])) {
      		$this->data['description'] = $this->request->post['description'];
    	} elseif (!empty($payment_info)) {
			$this->data['description'] = $payment_info['description'];
	} else {
      		$this->data['description'] = '';
    	}  
        
        
        
        //*********************************************************************************8888
        
        if (isset($this->request->post['customer_group_payment_id'])) {
      		$this->data['customer_group_payment_id'] = $this->request->post['customer_group_payment_id'];
    	} elseif (!empty($payment_info)) {
			$this->data['customer_group_payment_id'] = $payment_info['customer_group_payment_id'];
	} else {
      		$this->data['customer_group_payment_id'] = '';
    	}   
        
        if (isset($this->request->post['customer_group_id'])) {
      		$this->data['customer_group_id'] = $this->request->post['customer_group_id'];
    	} elseif (!empty($payment_info)) {
			$this->data['customer_group_id'] = $payment_info['customer_group_id'];
	} else {
      		$this->data['customer_group_id'] = '';
    	}  
        
        if (isset($this->request->post['customer_id'])) {
      		$this->data['customer_id'] = $this->request->post['customer_id'];
    	} elseif (!empty($payment_info)) {
			$this->data['customer_id'] = $payment_info['customer_id'];
	} else {
      		$this->data['customer_id'] = '';
    	}  
        
        if (isset($this->request->post['date_inserted'])) {
      		$this->data['date_inserted'] = $this->request->post['date_inserted'];
    	} elseif (!empty($payment_info)) {
			$this->data['date_inserted'] = $payment_info['date_inserted'];
	} else {
      		$this->data['date_inserted'] = '';
    	}  
        
        if (isset($this->request->post['price'])) {
      		$this->data['price'] = $this->request->post['price'];
    	} elseif (!empty($payment_info)) {
			$this->data['price'] = $payment_info['price'];
	} else {
      		$this->data['price'] = '';
    	}  
        
        if (isset($this->request->post['date_success'])) {
      		$this->data['date_success'] = $this->request->post['date_success'];
    	} elseif (!empty($payment_info)) {
			$this->data['date_success'] = $payment_info['date_success'];
	} else {
      		$this->data['date_success'] = '';
    	} 
        
        if (isset($this->request->post['date_ipn'])) {
      		$this->data['date_ipn'] = $this->request->post['date_ipn'];
    	} elseif (!empty($payment_info)) {
			$this->data['date_ipn'] = $payment_info['date_ipn'];
	} else {
      		$this->data['date_ipn'] = '';
    	}  
        
        if (isset($this->request->post['date_cancel'])) {
      		$this->data['date_cancel'] = $this->request->post['date_cancel'];
    	} elseif (!empty($payment_info)) {
			$this->data['date_cancel'] = $payment_info['date_cancel'];
	} else {
      		$this->data['date_cancel'] = '';
    	}  
        
        if (isset($this->request->post['status'])) {
      		$this->data['status'] = $this->request->post['status'];
    	} elseif (!empty($payment_info)) {
			$this->data['status'] = $payment_info['status'];
	} else {
      		$this->data['status'] = '';
    	}  
        
        if($this->data['status'] == 0 )
            {
            $this->data['changeStatus']= $this->url->link('catalog/registrationPayment/changeStatus','status=1&customer_group_payment_id='.$this->request->get['customer_group_payment_id'].'&token=' . $this->session->data['token'] . $url, 'SSL');
            }
        else if ($this->data['status'] == 1 )
            {
            $this->data['changeStatus']= $this->url->link('catalog/registrationPayment/changeStatus','status=0&customer_group_payment_id='.$this->request->get['customer_group_payment_id'].'&token=' . $this->session->data['token'] . $url, 'SSL');
            }
        
        
        if (isset($this->request->post['ipn_received'])) {
      		$this->data['ipn_received'] = $this->request->post['ipn_received'];
    	} elseif (!empty($payment_info)) {
			$this->data['ipn_received'] = $payment_info['ipn_received'];
	} else {
      		$this->data['ipn_received'] = '';
    	}  
        
        if (isset($this->request->post['cancel_received'])) {
      		$this->data['cancel_received'] = $this->request->post['cancel_received'];
    	} elseif (!empty($payment_info)) {
			$this->data['cancel_received'] = $payment_info['cancel_received'];
	} else {
      		$this->data['cancel_received'] = '';
    	}  
        
        if (isset($this->request->post['success_received'])) {
      		$this->data['success_received'] = $this->request->post['success_received'];
    	} elseif (!empty($payment_info)) {
			$this->data['success_received'] = $payment_info['success_received'];
	} else {
      		$this->data['success_received'] = '';
    	}  
        
           $this->load->model('sale/customer');
           $this->load->model('sale/customer_group');
           
           
           $customer = $this->model_sale_customer->getCustomer($this->data['customer_id']);
           $customer['url'] = $this->url->link('sale/customer/update','customer_id='. $customer['customer_id']  .'&token=' . $this->session->data['token'] . $url, 'SSL');
           $req_customer_group = $this->model_sale_customer_group->getCustomerGroup($this->data['customer_group_id']);
         //  $customer['url']= $this->url->link('sale/customer/update','customer_id='. $result['customer_id']  .'&token=' . $this->session->data['token'] . $url, 'SSL');
           $customer_group = $this->model_sale_customer_group->getCustomerGroup($customer['customer_group_id']);     

           $this->data['customer'] = $customer;
           $this->data['customer_group'] = $customer_group;
           $this->data['req_customer_group'] = $req_customer_group;
            
						
            $this->template = 'catalog/registrationPayment_form.tpl';

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
