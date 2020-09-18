<?php    
class ControllerCustomerRepresentative extends Controller { 
	private $error = array();
  
        public function index() {
            $this->language->load('customer/customer');
            
          //  if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {      
            if ( ($this->request->server['REQUEST_METHOD'] == 'POST') ) {
                
                $to      = 'nk@myspedition.net';
                $subject = 'New Repersentative Request';
  
                $message = '';
                 $message .= 'Name: '. $this->request->post['company_name'] . "<br>";
                 $message .= 'Work field: '. $this->request->post['company_field'] . "<br>";
                 $message .= 'Company id: '. $this->request->post['company_id'] . "<br>";
                 $message .= 'Legal Form: '. $this->request->post['legal_form'] . "<br>";
                 $message .= 'Establisment day: '. $this->request->post['establisment_day'] . "<br>";
                 $message .= 'Representative: '. $this->request->post['representative'] . "<br>";
                 $message .= 'Number of amployees: '. $this->request->post['employees_number'] . "<br>";
                 $message .= 'Number of customers: '. $this->request->post['customers_number'] . "<br>";
                 $message .= 'Address: '. $this->request->post['address'] . "<br>";
                 
                 $message .= 'Telephone: '. $this->request->post['telephone'] . "<br>";
                 $message .= 'Website: '. $this->request->post['website'] . "<br>";
                 $message .= 'Communications manager: '. $this->request->post['communications_manager'] . "<br>";
                 $message .= 'Position in company: '. $this->request->post['position'] . "<br>";
                 $message .= 'Email: '. $this->request->post['email'] . "<br>";
                 $message .= 'Additional Comments: '. $this->request->post['comments'] . "<br>";
                 $message .= 'Reasons to establish cooperation: '. $this->request->post['reasons'] . "<br>";
                 $message .= 'The way he informed about us: '. $this->request->post['informed_ways'] . "<br>";
                 $message .= 'Notes: '. $this->request->post['notes'] . "<br>";
                 
                $headers = 'From: webmaster@example.com' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
                
                   // $this->model_customer_customer->editCustomer($this->request->get['customer_id'], $this->request->post);
                    $this->session->data['success'] = $this->language->get('text_success');
                    $this->redirect($this->url->link('customer/representative/success',$url, 'SSL'));
            }
        
        $this->data['companies_by_country_text'] ="Become a representative in one of those countries now!!";// $this->language->get('companies_by_country_text');
       // $this->data['view_all_companies_text'] = "Become a representative in one of those countries now!!";//$this->language->get('view_all_companies_text');
        $this->data['action'] = $this->url->link('customer/representative', 'SSL');
                             
    	$this->document->setTitle('Become representative');
		
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/representative_main.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/representative_main.tpl';
		} else {
			$this->template = 'default/template/customer/representative_main.tpl';
		}
		
                
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());       		
  	}  
        
        
        public function success() {
    	$this->document->setTitle('Become representative');
		
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/customer/representative_success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/customer/representative_success.tpl';
		} else {
			$this->template = 'default/template/customer/representative_success.tpl';
		}
		
                
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());       		
  	}  
        
        	
}
?>