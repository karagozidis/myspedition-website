<?php   
class ControllerExtensionTrucksMailText extends Controller {   
	
    
    public function index() {
    	$this->language->load('common/home');
	 
		$this->document->setTitle($this->language->get('heading_title'));
		
                $this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
                
							
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
                
                $this->load->model('catalog/storedTexts');
                
                if (($this->request->server['REQUEST_METHOD'] == 'POST')) {  
                    $this->model_catalog_storedTexts->editStoredTexts('trucksMail',$this->request->post);
                   $this->data['success'] = 'Save Success';
                }
                
                $this->data['title'] = 'Trucks Mail Text';
		$this->data['token'] = $this->session->data['token'];
		$this->data['action'] = $this->url->link('extension/trucksMailText', 'token=' . $this->session->data['token'] , 'SSL');
                

		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
                
               
                $results = $this->model_catalog_storedTexts->getStoredTexts('trucksMail');
                
                $texts = array();
                
                foreach($results as $result)
                    {
                    $texts[ $result['language_id'] ] =  array(
                        'stored_mails_id'   =>  $result['stored_mails_id'] ,
			'name'              =>  $result['name'] , 
			'text'              =>  $result['text'] ,
			'language_id'       =>  $result['language_id'] 
                        );    
                    }
                    
                 $this->data['texts'] = $texts;
		
                 
		$this->template = 'extension/storedText.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
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