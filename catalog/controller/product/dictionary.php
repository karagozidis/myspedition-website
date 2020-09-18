<?php 
class ControllerProductDictionary extends Controller {  
	public function index() { 
		$this->language->load('product/dictionary');		
		
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
			                      
                     
                        $this->data['description'] = $this->language->get('description');
                        $this->data['welcome'] = $this->language->get('welcome');                         												
                                 
                        $this->load->model('tool/dictionary'); 
                         
                        if (isset($this->request->get['keyword'])) {
				$selected_keyword = $this->request->get['keyword'];
			}
                        else    $selected_keyword = "A";
                        
                        if (isset($this->request->get['dictionary_id'])) {
				$selected_dictionary_id = $this->request->get['dictionary_id'];
			}
                        else    $selected_dictionary_id =  $this->model_tool_dictionary->getFirstIdByKeyword($selected_keyword); 
                        
                        
                       
                        
                        $keywords = $this->model_tool_dictionary->getKeywords(); 
                        $terms = $this->model_tool_dictionary->getTermsByKeyword($selected_keyword); 
                        $selected_term = $this->model_tool_dictionary->getTerm($selected_dictionary_id); 
                        
                       
                        foreach($keywords as $keyword){
				$this->data['keywords'][] = array(
					'keyword'  => $keyword['keyword'],
					'href'  => $this->url->link('product/dictionary', '&keyword=' . $keyword['keyword'])
				);
			}
                        
                        foreach($terms as $term){
				$this->data['terms'][] = array(
					'name'  => $term['name'],
					'href'  => $this->url->link('product/dictionary', '&dictionary_id=' . $term['dictionary_id'] .'&keyword=' . $term['keyword'] )
				);
			}
                        
                        $this->data['selected_term'] = $selected_term;
                        
 
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
                                                                                          
			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/dictionary.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/dictionary.tpl';
			} else {
				$this->template = 'default/template/product/dictionary.tpl';
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