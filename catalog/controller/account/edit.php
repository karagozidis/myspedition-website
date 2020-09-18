<?php
class ControllerAccountEdit extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/edit', '', 'SSL');

			$this->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->language->load('account/edit');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('account/customer');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_account_customer->editCustomer($this->request->post);
                        
                        if( isset($this->request->post['image']))
                        {
                           $this->model_account_customer->editCompanyLogo($this->request->post['image']); 
                        }
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('account/account', '', 'SSL'));
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
        	'text'      => $this->language->get('text_edit'),
			'href'      => $this->url->link('account/edit', '', 'SSL'),       	
        	'separator' => $this->language->get('text_separator')
      	);
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_your_details'] = $this->language->get('text_your_details');

		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_fax'] = $this->language->get('entry_fax');

		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_back'] = $this->language->get('button_back');
                
                $this->data['general_company_name_text'] = $this->language->get('general_company_name_text');
		$this->data['company_name_error_text'] = $this->language->get('company_name_error_text');
                $this->data['image_size_text'] = $this->language->get('image_size_text');
		$this->data['browse_text'] = $this->language->get('browse_text');
                $this->data['clear_text'] = $this->language->get('clear_text');
		$this->data['company_type_text'] = $this->language->get('company_type_text');
                $this->data['company_country_text'] = $this->language->get('company_country_text');
		$this->data['company_general_description_text'] = $this->language->get('company_general_description_text');
                
              	
                $this->load->model('localisation/country');
               
                $countries = $this->model_localisation_country->getCountries(); 
                
                $this->data['countries'] = $countries ; 
                
                if (isset($this->error['main_company'])) {
			$this->data['error_main_company'] = $this->error['main_company'];
		} else {
			$this->data['error_main_company'] = '';
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

		$this->data['action'] = $this->url->link('account/edit', '', 'SSL');

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		}

               
                $this->data['defaultCompanyImage'] = 'companyLogo.png';
                
                if (isset($this->request->post['image'])) {
			 $this->data['companyImage'] = $this->request->post['image'];
		} elseif (isset($customer_info)) {
                    
                    if ( $customer_info['company_logo'] == '')  $this->data['companyImage'] = 'companyLogo.png';
		    else $this->data['companyImage'] = $customer_info['company_logo'];
                    
		} else {
			 $this->data['companyImage'] = 'companyLogo.png';
		}
                
                if (isset($this->request->post['main_company'])) {
			$this->data['main_company'] = $this->request->post['main_company'];
		} elseif (isset($customer_info)) {
			$this->data['main_company'] = $customer_info['company'];
		} else {
			$this->data['firstname'] = '';
		}
                
                if (isset($this->request->post['company_type_id'])) {
    		$this->data['company_type_id'] = $this->request->post['company_type_id'];
                } elseif (isset($customer_info)) {
			$this->data['company_type_id'] = $customer_info['company_type_id'];
		} else {
			$this->data['company_type_id'] = '';
		}
                
                
                if (isset($this->request->post['main_description'])) {
			$this->data['main_description'] = $this->request->post['main_description'];
		} elseif (isset($customer_info)) {
			$this->data['main_description'] = $customer_info['description'];
		} else {
			$this->data['main_description'] = '';
		}
                
                if (isset($this->request->post['main_country_id'])) {
			$this->data['main_country_id'] = $this->request->post['main_country_id'];
		} elseif (isset($customer_info)) {
			$this->data['main_country_id'] = $customer_info['country_id'];
		} else {
			$this->data['main_country_id'] = '';
		}
                
		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} elseif (isset($customer_info)) {
			$this->data['firstname'] = $customer_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$this->data['lastname'] = $this->request->post['lastname'];
		} elseif (isset($customer_info)) {
			$this->data['lastname'] = $customer_info['lastname'];
		} else {
			$this->data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} elseif (isset($customer_info)) {
			$this->data['email'] = $customer_info['email'];
		} else {
			$this->data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$this->data['telephone'] = $this->request->post['telephone'];
		} elseif (isset($customer_info)) {
			$this->data['telephone'] = $customer_info['telephone'];
		} else {
			$this->data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$this->data['fax'] = $this->request->post['fax'];
		} elseif (isset($customer_info)) {
			$this->data['fax'] = $customer_info['fax'];
		} else {
			$this->data['fax'] = '';
		}
                
                if (isset($this->request->post['skype'])) {
			$this->data['skype'] = $this->request->post['skype'];
		} elseif (isset($customer_info)) {
			$this->data['skype'] = $customer_info['skype'];
		} else {
			$this->data['skype'] = '';
		}
                
                if (isset($this->request->post['icq'])) {
			$this->data['icq'] = $this->request->post['icq'];
		} elseif (isset($customer_info)) {
			$this->data['icq'] = $customer_info['icq'];
		} else {
			$this->data['icq'] = '';
		}
                
                if (isset($this->request->post['website'])) {
			$this->data['website'] = $this->request->post['website'];
		} elseif (isset($customer_info)) {
			$this->data['website'] = $customer_info['website'];
		} else {
			$this->data['website'] = '';
		}
                
                $this->load->model('catalog/companyType');
                $this->data['company_types'] = $this->model_catalog_companyType->getCompanyTypes();    
                

		$this->data['back'] = $this->url->link('account/account', '', 'SSL');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/edit.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/edit.tpl';
		} else {
			$this->template = 'default/template/account/edit.tpl';
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

	protected function validate() {
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
                
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>