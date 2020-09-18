<?php
class ControllerAccountInterestCountries extends Controller {
	private $error = array();
	     
  	public function index() {	
            
    	if (!$this->customer->isLogged()) {
      		$this->session->data['redirect'] = $this->url->link('account/interestCountries', '', 'SSL');

      		$this->redirect($this->url->link('account/login', '', 'SSL'));
    	}

        
	$this->language->load('account/password');

    	$this->document->setTitle($this->language->get('heading_title'));
			  
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		
                $this->load->model('account/interestCountries');
                $this->model_account_interestCountries->editInterestCountries($this->customer->getId(),$this->request->post);
                
      		$this->session->data['success'] = "Your countries of interest have been successfully updated.";//$this->language->get('text_success');
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
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('account/interestCountries', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);
			
        
        
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_password'] = $this->language->get('text_password');

    	$this->data['entry_password'] = $this->language->get('entry_password');
    	$this->data['entry_confirm'] = $this->language->get('entry_confirm');

    	$this->data['button_continue'] = $this->language->get('button_continue');
    	$this->data['button_back'] = $this->language->get('button_back');
    	
        
        
		if (isset($this->error['password'])) { 
			$this->data['error_password'] = $this->error['password'];
		} else {
			$this->data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) { 
			$this->data['error_confirm'] = $this->error['confirm'];
		} else {
			$this->data['error_confirm'] = '';
		}
	
                
                
                
                $this->data['action'] = $this->url->link('account/interestCountries', '', 'SSL');
        
		if (isset($this->request->post['password'])) {
    		$this->data['password'] = $this->request->post['password'];
		} else {
			$this->data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
    		$this->data['confirm'] = $this->request->post['confirm'];
		} else {
			$this->data['confirm'] = '';
		}

                $this->data['back'] = $this->url->link('account/account', '', 'SSL');

                
                
                
                $this->load->model('localisation/country');
                 $this->load->model('account/interestCountries');
                 
                $this->data['countries'] = $this->model_localisation_country->getCountries();
                $this->data['interestCountries'] = 
                        $this->model_account_interestCountries->getInterestCountries($this->customer->getId());
                
                
                
                
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/interestCountries.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/interestCountries.tpl';
		} else {
			$this->template = 'default/template/account/password.tpl';
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
            
        /*
    	if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
      		$this->error['password'] = $this->language->get('error_password');
    	}

    	if ($this->request->post['confirm'] != $this->request->post['password']) {
      		$this->error['confirm'] = $this->language->get('error_confirm');
    	}  
	
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
        */
            
        return true;     
  	}
}
?>
