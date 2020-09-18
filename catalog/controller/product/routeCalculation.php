<?php 
class ControllerProductRouteCalculation extends Controller {  
	public function index() { 
		$this->language->load('product/routeCalculation');		                       
                
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
  		'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);
                
                $this->data['breadcrumbs'][] = array(
       		'text'      => 'Market',
			'href'      => $this->url->link('','', 'SSL'),
      		'separator' => ' :: '
   		);
                                
 
	  		$this->document->setTitle($this->language->get('title'));
			$this->document->setDescription($this->language->get('title'));
			$this->document->setKeywords($this->language->get('title'));
			$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
			
			$this->data['heading_title'] = $this->language->get('title');
			
                        
                        
                        /*******************************************************************************/
                        /* $this->data['trucks_list_text'] = $this->language->get('trucks_list_text');
                         $this->data['find_trucks_text'] = $this->language->get('find_trucks_text');
                         $this->data['na_text'] = $this->language->get('na_text');
                         $this->data['loading_country_text'] = $this->language->get('loading_country_text');
                         $this->data['region_state_text'] = $this->language->get('region_state_text');
                         $this->data['city_area_text'] = $this->language->get('city_area_text');
                         $this->data['offloading_country_text'] = $this->language->get('offloading_country_text');
                         $this->data['loading_date_at_text'] = $this->language->get('loading_date_at_text');
                         $this->data['date_to_text'] = $this->language->get('date_to_text');
                         $this->data['search_text'] = $this->language->get('search_text');
                         $this->data['clear_text'] = $this->language->get('clear_text');
                         $this->data['loading_date_text'] = $this->language->get('loading_date_text');
                         $this->data['trailer_text'] = $this->language->get('trailer_text');
                         $this->data['company_text'] = $this->language->get('company_text');
                         $this->data['other_text'] = $this->language->get('other_text');               */    
                        /*******************************************************************************/
                     
                          $this->data['description'] = $this->language->get('description');
                          $this->data['welcome'] = $this->language->get('welcome');   
                       
												            
                        $this->load->model('localisation/country');  

                        /*
                        $market = $this->model_localisation_country->getMarket(); 
                        $this->data['market'] = $market;
                        $market_total  = $this->model_localisation_country->getTotalMarket();
                        $this->data['market_total'] = $market_total ;
                        */
                        /*  
                        $this->data['from_f_href'] = $this->url->link('product/freightCategory', '&search_loading_country=', 'SSL');                      
                        $this->data['to_f_href'] = $this->url->link('product/freightCategory', '&search_offloading_country=', 'SSL');
                        $this->data['from_t_href'] = $this->url->link('product/truckCategory', '&search_loading_country=', 'SSL');
                        $this->data['to_t_href'] = $this->url->link('product/truckCategory', '&search_offloading_country=', 'SSL');
                        */
                        
			$url = '';
			
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
				
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->data['limits'] = array();
	
			$limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));
			
			sort($limits);
	
			foreach($limits as $limits){
				$this->data['limits'][] = array(
					'text'  => $limits,
					'value' => $limits,
					'href'  => $this->url->link('product/freightCategory', $url . '&limit=' . $limits)
				);
			}
			
			$url = '';
			
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
							
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
					
                                                                  
                        
                        
                        if (isset($this->request->get['page'])) {
                                $pageStr = '&page=' . $this->request->get['page'];
                        }else{
                            $pageStr = '';
                        }
                        
		
                        
                        if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	                       
                        
                     /*   
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('product/freightCategory', $url . '&page={page}');
		
			$this->data['pagination'] = $pagination->render();
		
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['limit'] = $limit;
		*/
                                                                                    
			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/routeCalculation.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/routeCalculation.tpl';
			} else {
				$this->template = 'default/template/product/routeCalculation.tpl';
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
}
?>