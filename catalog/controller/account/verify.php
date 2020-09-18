<?php
class ControllerAccountVerify extends Controller {
	private $error = array();

	public function index() {
		
                if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/edit', '', 'SSL');

			$this->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->language->load('account/account');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('account/verification');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                    
                 //  $count =  $this->model_account_verification->getVerificationTotal( $this->customer->getId() );
                   
                //    if ($count == 0){
                        $this->model_account_verification->addVerificaiton($this->request->post);  
                 //   } else {
                 //       $this->model_account_verification->editVerificaiton($this->customer->getId() , $this->request->post); 
                //    }
                    
		//$this->model_account_verification->editCustomerStatus($this->customer->getId()); 
                    
                    $this->session->data['success'] = 'Success! You have requested a verification,wait for admin reply.';//$this->language->get('text_success');
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
        	'text'      => "Company verification",//$this->language->get('text_edit'),
			'href'      => $this->url->link('account/verify', '', 'SSL'),       	
        	'separator' => $this->language->get('text_separator')
      	); 
		
		$this->data['heading_title'] = "Company verification";//$this->language->get('heading_title');
		$this->data['text_your_details'] = "Verify your company now"; //$this->language->get('text_your_details');
		$this->data['button_back'] = $this->language->get('button_back');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                
                
                
                
               /* if (isset($this->error['nodocs'])) {
			$this->data['error_nodocs'] = $this->error['nodocs'];
		} else {
			$this->data['error_nodocs'] = '';
		}
                */
 
                
		$this->data['action'] = $this->url->link('account/verify', '', 'SSL');

		//if ($this->request->server['REQUEST_METHOD'] != 'POST') {
		//	$verification_info = $this->model_account_verification->getVerification( $this->customer->getId() );
		//} 

                //$verification_status = $this->model_account_verification->getCustomerStatus($this->customer->getId());
                
             //    $this->data['verification_status'] = $verification_status;

               /*
                * 0 Not required
                * 1 Failed
                * 2 Pending
                * 3 Verified
                * 4 Trusted
                */
               /* if( $verification_status == 0 )
                    {
                    $this->data['verification_status_msg'] = "You are not a Verified Company, Verify Now !! ";
                    }
                else if( $verification_status == 1 )
                    {
                    $this->data['verification_status_msg'] = "Verification Attempt Failed.";
                    }
                else if( $verification_status == 2 )
                    {
                    $this->data['verification_status_msg'] = "Verification Attempt Pending , wait for admin aproval.";
                    }
                else if( $verification_status == 3 )
                    { 
                    $this->data['verification_status_msg'] = "You Are a Verified User.";
                    }  
                else if( $verification_status == 4 )
                    {
                    $this->data['verification_status_msg'] = "You Are a Trusted User !!";
                    }  */
                    
             /*       
                if (isset($this->request->post['description'])) {
			$this->data['description'] = $this->request->post['description'];
		} elseif (isset($verification_info['description'])) {
			$this->data['description'] = $verification_info['description'];
		} else {
			$this->data['description'] = '';
		}
                
                if (isset($this->request->post['docs'])) {
			$this->data['docs'] = $this->request->post['docs'];
		} elseif (isset($verification_info['docs'])) {
			$this->data['docs'] = $verification_info['docs'];
		} else {
			$this->data['docs'] = '';
		} */
                
                
                
            //    $this->data['defaultCompanyImage'] = 'companyLogo.png';
                /*
                if (isset($this->request->post['image'])) {
			 $this->data['companyImage'] = $this->request->post['image'];
		} elseif (isset($customer_info)) {
                    
                    if ( $customer_info['company_logo'] == '')  $this->data['companyImage'] = 'companyLogo.png';
		    else $this->data['companyImage'] = $customer_info['company_logo'];
                    
		} else {
			 $this->data['companyImage'] = 'companyLogo.png';
		}
              
                
                if (isset($this->request->post['website'])) {
			$this->data['website'] = $this->request->post['website'];
		} elseif (isset($customer_info)) {
			$this->data['website'] = $customer_info['website'];
		} else {
			$this->data['website'] = '';
		}
                */
                
                $this->load->model('catalog/companyType');
                $this->data['company_types'] = $this->model_catalog_companyType->getCompanyTypes();    
                

		$this->data['back'] = $this->url->link('account/account', '', 'SSL');
               

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/verify.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/verify.tpl';
		} else {
			$this->template = 'default/template/account/verify.tpl';
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
			'href'      => $this->url->link('common/home', '', 'SSL'),
      		'separator' => false
   		);

                $this->data['breadcrumbs'][] = array(
       		'text'      => ' account',
			'href'      => $this->url->link('account/account','', 'SSL'),
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
				'href' => $this->url->link('catalog/verification/update', '&verification_id=' . $result['verification_id'] . $url, 'SSL')
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
                                'docs'              => $result['docs'],
				'action'     => $action                       
			);
                }
                
		
		$this->data['heading_title'] = 'My verification requests';//$this->language->get('heading_title');		
				
		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = "No results";//$this->language->get('text_no_results');		
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
		$pagination->url = $this->url->link('catalog/truck', $url . '&page={page}', 'SSL');
			
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
            
                //if( $this->countFiles() == 0  ) {
                  if( !isset($this->request->post['docs']) ) {   
			$this->error['warning'] = "WARNING, NO DOCUMENTS UPLOADED!  Upload documents to request a Company Verificaiton.";//$this->language->get('error_lastname');
                }
		/*if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
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
		}*/
                
            
            
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
        
        
        
  	public function upload() {
            
                if ( !$this->customer->isLogged() ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
		$this->language->load('common/filemanager');
                $json = array();
                
               $this->load->model('customer/customer_group');
                $customer_group = $this->model_customer_customer_group->getCustomerGroupByCustomerId( $this->customer->getId() );
                
                $dir = rtrim( DIR_IMAGE . 'docs/'. 'company_'.$this->customer->getId().'/' );
             
                $dir .="/";
                    if(is_dir($dir)) {
                        $images = glob($dir."*.*");
                        $total =  count($images) ;
                    }

                if ( $total >= $customer_group['photo_album_number'] ) {       
                     $json['error']  = "This account supports max  ".$customer_group['photo_album_number']. " photos.";
                     $this->response->setOutput(json_encode($json));
                    }         
  
		 if (true) {
			if (isset($this->request->files['image']) && $this->request->files['image']['tmp_name']) {
				$filename = basename(html_entity_decode($this->request->files['image']['name'], ENT_QUOTES, 'UTF-8'));
				
				if ((strlen($filename) < 3) || (strlen($filename) > 255)) {
					$json['error'] = $this->language->get('error_filename');
				}
					
				$directory = rtrim(DIR_IMAGE . 'docs/'. 'company_'.$this->customer->getId().'/' );
				
				if (!is_dir($directory)) {
					$json['error'] = $this->language->get('error_directory');
				}
				
				if ($this->request->files['image']['size'] > 300000) {
					$json['error'] = $this->language->get('error_file_size');
				}
			
				$allowed = array(
                                        '.docm', '.docx', '.dotx', '.xlam', '.doc',
                                        '.xlsx', '.xlsm', '.xltx', '.xltm', '.xlsb',
					'.xlam', '.xls', '.pdf', '.jpg', '.jpeg',
					'.gif', '.png', '.gif' , '.rtf' ,'.txt'
                                        ); 
						
				if (!in_array(strtolower(strrchr($filename, '.')), $allowed)) {
					$json['error'] = $this->language->get('error_file_type');
				}

				if ($this->request->files['image']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = 'error_upload_' . $this->request->files['image']['error'];
				}			
			} else {
				$json['error'] = $this->language->get('error_file');
			}
		} else {
			$json['error'] = rtrim(DIR_IMAGE . 'docs/'. 'company_'.$this->customer->getId().'/' );// $this->language->get('error_directory');
		} 
		
		
		if (!isset($json['error'])) {	
			if (@move_uploaded_file($this->request->files['image']['tmp_name'], $directory . '/' . $filename)) {		
				$json['success'] = $filename;// $this->language->get('text_uploaded');
			} else {
				$json['error'] = $this->language->get('error_uploaded');
			}
		}
		$this->response->setOutput(json_encode($json));
	}
              
        
        
        
        
        
        
}
?>