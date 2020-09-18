<?php  
class ControllerModuleCustomerInfo extends Controller {
	protected function index($setting) {                      
		//$this->language->load('module/category');
                
                if ($this->customer->isLogged())  $this->data['logged'] = 'true';            
            
                $this->data['heading_title'] = $this->language->get('text_account');
		$this->load->model('customer/customer');
                        
                $this->data['customer'] = $this->model_customer_customer->getCustomer( $this->customer->getId() );       
                $this->data['edit'] = $this->url->link('account/edit', '', 'SSL');
                
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/customerInfo.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/customerInfo.tpl';
		} else {
			$this->template = 'default/template/module/customerInfo.tpl';
		}
		
		$this->render();
  	}
}
?>