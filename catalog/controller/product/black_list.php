<?php 
class ControllerProductblacklist extends Controller {
	
	public function index() {  
    	
            if (!$this->customer->isLogged()) {
                $this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
                $this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
                
            $this->language->load('product/black_list');
		
		$this->load->model('catalog/black_list');

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
      		'separator' => false
   		);

		
		$black_list_total = $this->model_catalog_black_list->getTotalBlack_lists();
			
		//if ($black_list_total) {

	  		$this->document->SetTitle ($this->language->get('heading_title'));

	   		$this->data['breadcrumbs'][] = array(
	       		'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('product/black_list'),
	      		'separator' => $this->language->get('text_separator')
	   		);

						
      		$this->data['heading_title'] = $this->language->get('heading_title');
      		$this->data['text_auteur'] = $this->language->get('text_auteur');
      		$this->data['text_city'] = $this->language->get('text_city');
      		$this->data['button_continue'] = $this->language->get('button_continue');
      		$this->data['showall'] = $this->language->get('text_showall');
      		$this->data['write'] = $this->language->get('text_write');
      		$this->data['text_average'] = $this->language->get('text_average');
      		$this->data['text_stars'] = $this->language->get('text_stars');
      		$this->data['text_no_rating'] = $this->language->get('text_no_rating');
			
			$this->data['continue'] = HTTP_SERVER . 'index.php?route=common/home';
			
			$this->page_limit = $this->config->get('config_catalog_limit');
			
                        
                        if (isset($this->request->get['filter_company'])) {
                                $filter_company = $this->request->get['filter_company'];
                        } else {
                                $filter_company = null;
                        }
                        
                        if (isset($this->request->get['filter_country_id']) && $this->request->get['filter_country_id'] != '*' ) {
                                $filter_country_id = $this->request->get['filter_country_id'];
                        } else {
                                $filter_country_id = null;
                        } 
                        
                        
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else { 
				$page = 1;
			}	

			$this->data['black_lists'] = array();

			if ( isset($this->request->get['black_list_id']) ){
				$results = $this->model_catalog_black_list->getBlack_list($this->request->get['black_list_id']);
			}
			else{
                            
                            $data = array(
                               'filter_company' => $filter_company,
                               'filter_country_id' => $filter_country_id
                                );
                            
				$results = $this->model_catalog_black_list->getBlack_lists(($page - 1) * $this->page_limit, $this->page_limit,false, $data);
			}
			
                        $this->load->model('account/customer');
                        $this->load->model('localisation/country');
			foreach ($results as $result) {

				//$result['description'] = strip_tags(html_entity_decode($result['description']));

				$fromCustomer = $this->model_account_customer->getCustomer($result['from_customer_id']);
                                
                                $toCustomer = $this->model_account_customer->getCustomer($result['to_customer_id']);
                               
                                //echo $this->url->link('customer/customer/update', '&customer_id='.$fromCustomer['customer_id'] );
                                $fromCustomer['country'] = $this->model_localisation_country->getCountry( $fromCustomer['country_id']);
                                $toCustomer['country'] = $this->model_localisation_country->getCountry( $toCustomer['country_id']);
                                
                                $fromCustomer['url'] =
                                        $this->url->link('customer/customer/update', '&customer_id='.$fromCustomer['customer_id'] );
                             
                                $toCustomer['url'] =
                                        $this->url->link('customer/customer/update', '&customer_id='.$toCustomer['customer_id'] );

                                
				$this->data['black_lists'][] = array(
					'name'		=> $result['name'],
					'title'    		=> $result['title'],
					'rating'		=> $result['rating'],
					'description'	=> $result['description'],
					'city'		=> $result['city'],
                                        'from_customer' => $fromCustomer,
                                        'to_customer' => $toCustomer ,
					'date_added'	=> date("H:i:s m-d-Y", strtotime($result['date_added'])) //$result['date_added']
				);
			}
                        
			$this->data['filter_company'] = $filter_company;
                        $this->data['filter_country_id'] = $filter_country_id;
                        
			$url = '';
                        $this->data['searchByNameAction'] =   $this->url->link('product/black_list');
                       
                        
                        $this->load->model('localisation/country'); 
                        $this->data['countries'] = $this->model_localisation_country->getCountries();
                        
                                                
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
				$this->data['write_url'] = $this->url->link('product/isiblack_list'); 	
			
			if ( isset($this->request->get['black_list_id']) ){
				$this->data['showall_url'] = $this->url->link('product/black_list'); 	
			}
			else{
				$pagination = new Pagination();
				$pagination->total = $black_list_total;
				$pagination->page = $page;
				$pagination->limit = $this->page_limit; 
				$pagination->text = $this->language->get('text_pagination');
				$pagination->url = $this->url->link('product/black_list', '&page={page}');
				$this->data['pagination'] = $pagination->render();				

			}

                        $this->data['text_error'] = $this->language->get('text_error');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/black_list.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/black_list.tpl';
			} else {
				$this->template = 'default/template/product/black_list.tpl';
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
    	/*} else {

				
	  		$this->document->SetTitle ( $this->language->get('text_error'));
			
      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = HTTP_SERVER . 'index.php?route=common/home';

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
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
    	}  */
  	}
}
?>