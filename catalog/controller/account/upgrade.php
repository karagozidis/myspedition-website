<?php
class ControllerAccountUpgrade extends Controller {
	private $error = array();

	public function index() {
		
                if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/edit', '', 'SSL');
			$this->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->language->load('account/account');
		
		$this->document->setTitle("Become a Premium User Now");
		
		$this->load->model('account/verification');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                    
                    $this->model_account_verification->addVerificaiton($this->request->post);  

                    $this->session->data['success'] = $this->language->get('text_success');
                    $this->redirect($this->url->link('account/verify/viewlist', '', 'SSL'));     
		}
                
               
                

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
        	'text'      => "Payment section",//$this->language->get('text_edit'),
			'href'      => $this->url->link('account/verify', '', 'SSL'),       	
        	'separator' => $this->language->get('text_separator')
      	); 
		
	$this->data['heading_title'] = "Purchase a Premium Package";
	$this->data['text_your_details'] = "";
	$this->data['button_back'] = $this->language->get('button_back');

        if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
	} else {
			$this->data['error_warning'] = '';
		}
                                
                
	$this->data['action'] = $this->url->link('account/payment', 'SSL');


                $this->load->model('catalog/storedTexts');
                $this->data['accountUpgradeText'] = $this->model_catalog_storedTexts->getStoredText('accountUpgradeText'); 
        
        
                $this->load->model('catalog/storedTexts');
                $this->data['upgradeText'] = $this->model_catalog_storedTexts->getStoredText('upgradeMail'); 
         
                $this->load->model("customer/customer_group");
                $this->data['customer_groups'] = $this->model_customer_customer_group->getPayedCustomerGroups(null);
                $this->data['customer_id'] = $this->customer->getId();
                $this->data['upgradeAction'] = $this->url->link('account/payment', 'SSL');
                
                
                $this->load->model("customer/customer_group");
                $this->data['customer_groups'] = $this->model_customer_customer_group->getPayedCustomerGroups(null);
                $this->data['customer_id'] = $this->customer->getId();
                    
                $this->load->model('customer/customer_group');
                
                $data = array('display_description' => 1); 
                $this->data['available_customer_groups'] =  $this->model_customer_customer_group->getCustomerGroups($data);
        
                $this->load->model('catalog/freightOffer');
                $this->data['freight_offers_done_total'] = $this->model_catalog_freightOffer->getTotalCustomerOffersDetailed($this->customer->getId());
                
                //$this->session->data['customer_id_to_pay'] = $this->customer->getId();
                
                $this->load->model('catalog/companyType');
                $this->data['company_types'] = $this->model_catalog_companyType->getCompanyTypes();    
                

		$this->data['back'] = $this->url->link('account/account', '', 'SSL');
               

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/upgrade.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/upgrade.tpl';
		} else {
			$this->template = 'default/template/account/upgrade.tpl';
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

        
        
        public function viewList() {
		$this->language->load('account/account');
		$this->document->setTitle($this->language->get('heading_title')); 
		$this->load->model('account/verification');           
		$this->getList();
  	}
        
        
        
       protected function getList() {	
                    
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

      
                    
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
  		$this->data['breadcrumbs'] = array();
		$this->data['back'] = $this->url->link('account/account');
                $this->data['req_verification'] = $this->url->link('account/verify', '', 'SSL');
		//$this->data['insert'] = $this->url->link('catalog/verification/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		//$this->data['copy'] = $this->url->link('catalog/verification/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		//$this->data['delete'] = $this->url->link('catalog/verification/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['verifications'] = array();

		$data = array(
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$verificationsTotal = $this->model_account_verification->getVerificationTotal($this->customer->getId());
		$results = $this->model_account_verification->getVerifications($this->customer->getId());
		 
		foreach ($results as $result) {
			$action = array();
                        
                       
                         
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/verification/update', 'token=' . $this->session->data['token'] . '&verification_id=' . $result['verification_id'] . $url, 'SSL')
			);
   
                  if ($result['status'] == 0 ) $status  = "Not Verified"; 
                  if ($result['status'] == 1 ) $status  = "Failed";
                  if ($result['status'] == 2 ) $status  = "Pending";
                  if ($result['status'] == 3 ) $status  = "Verified";
                  if ($result['status'] == 4 ) $status  = "Trusted";
                  
      		$this->data['verifications'][] = array(
				'verification_id'   => $result['verification_id'],
                                'customer_id'       => $result['customer_id'],
                                'description'       => $result['description'],
				'date_added'        => $result['date_added'],
                                'status'            => $status,
				'action'     => $action                       
			);
                }
                
		
		$this->data['heading_title'] = 'My verification requests';//$this->language->get('heading_title');		
				
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
	
		$pagination = new Pagination();
		$pagination->total = $verificationsTotal;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/truck', 'token=' . $this->session->data['token'] .  $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

              
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/verification_list.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/verification_list.tpl';
		} else {
			$this->template = 'default/template/account/verification_list.tpl';
		}
                
                
		//$this->template = 'catalog/verification_list.tpl';
          
		//$this->template = 'catalog/truck_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

        
        
        
	protected function validate() {
            
                if( $this->countFiles() == 0  ) {
                    
			$this->error['warning'] = "WARNING, NO DOCUMENTS UPLOADED!  Upload documents to request a Company Verificaiton.";//$this->language->get('error_lastname');
                }
		/*
                if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}
		
		if (($this->customer->getEmail() != $this->request->post['email']) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

               if ((utf8_strlen($this->request->post['main_company']) < 3) || (utf8_strlen($this->request->post['main_company']) > 100)) {
			$this->error['main_company'] = 'error';//$this->language->get('error_telephone');
		}
                 */
                
            
            
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
        
        
        
        
        public function countFiles() {
		 $json = array();
                 
                  if (isset($this->request->get['subf']))
                           $this->subfolder = $this->request->get['subf'] . '/';
                 
		//if (!empty($this->request->post['directory'])) {
		//	$directory = DIR_IMAGE . 'data/' . 'company_docs_'.$this->customer->getId().'/'. str_replace('../', '', $this->request->post['directory']);
		//} else {
			$directory = DIR_IMAGE . 'docs/'  . 'company_'.$this->customer->getId().'/' ;
		//}
		
		$allowed = array(                
                        '.docm',
                        '.docx',
                        '.dotx',
                        '.xlam',
                        '.doc',

                        '.xlsx',
                        '.xlsm',
                        '.xltx',
                        '.xltm',
                        '.xlsb',
                        '.xlam',
                        '.xls',

                        '.pdf',

                        '.jpg',
                        '.jpeg',
                        '.gif',
                        '.png',
                        '.gif'
		);
		
                $count = 0;
		$files = glob(rtrim($directory, '/') . '/*');
		
		if ($files) {
			foreach ($files as $file) {
                                $count++;
				/*if (is_file($file)) {
					$ext = strrchr($file, '.');
				} else {
					$ext = '';
				}	
				
				if (in_array(strtolower($ext), $allowed)) {
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
						
					$json[] = array(
						'filename' => basename($file),
						'file'     => utf8_substr($file, utf8_strlen(DIR_IMAGE . 'data/')),
						'size'     => round(utf8_substr($size, 0, utf8_strpos($size, '.') + 4), 2) . $suffix[$i]
					);
				} */
			}
		}
		
                return $count;
		//$this->response->setOutput(json_encode($json));	
	}	
        
    
        
        
}
?>