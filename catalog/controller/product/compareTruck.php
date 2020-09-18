<?php  
class ControllerProductCompareTruck extends Controller {
	public function index() { 
		$this->language->load('product/compare');
		
		$this->load->model('catalog/truck');

		$this->load->model('tool/image');
		
		if (!isset($this->session->data['comparetruck'])) {
			$this->session->data['comparetruck'] = array();
		}	
				
		if (isset($this->request->get['remove'])) {
			$key = array_search($this->request->get['remove'], $this->session->data['comparetruck']);
				
			if ($key !== false) {
				unset($this->session->data['comparetruck'][$key]);
			}
		
			$this->session->data['success'] = $this->language->get('text_remove');
		
			$this->redirect($this->url->link('product/compareTruck'));
		}
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
				
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/comparetruck'),			
			'separator' => $this->language->get('text_separator')
		);	
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_product'] = $this->language->get('text_product');
		$this->data['text_name'] = $this->language->get('text_name');
		$this->data['text_image'] = $this->language->get('text_image');
		$this->data['text_price'] = $this->language->get('text_price');
		$this->data['text_model'] = $this->language->get('text_model');
		$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$this->data['text_availability'] = $this->language->get('text_availability');
		$this->data['text_rating'] = $this->language->get('text_rating');
		$this->data['text_summary'] = $this->language->get('text_summary');
		$this->data['text_weight'] = $this->language->get('text_weight');
		$this->data['text_dimension'] = $this->language->get('text_dimension');
		$this->data['text_empty'] = $this->language->get('text_empty');
		
		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_cart'] = $this->language->get('button_cart');
		$this->data['button_remove'] = $this->language->get('button_remove');
		       
                
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$this->data['review_status'] = $this->config->get('config_review_status');
		
		$this->data['products'] = array();
		
		$this->data['attribute_groups'] = array();

		foreach ($this->session->data['comparetruck'] as $key => $product_id) {
                    
			$product_info = $this->model_catalog_truck->getProduct($product_id);
			
                        $this->load->model('localisation/country');  
                        $this->load->model('localisation/zone');     
                        $this->load->model('catalog/treiler');   
                        $this->load->model('catalog/freightType'); 
                        $this->load->model('catalog/freightLoadingType'); 
                        $this->load->model('account/customer'); 
                        
			if ($product_info) {                  
                        
				
                                $loading_country = $this->model_localisation_country->getCountry($product_info['loading_country_id']);
                                $offloading_country = $this->model_localisation_country->getCountry($product_info['offloading_country_id']);         
                                            
                                $loading_zone = $this->model_localisation_zone->getZone( $product_info['loading_zone_id'] );
                                $offloading_zone = $this->model_localisation_zone->getZone( $product_info['offloading_zone_id'] );                               
                                         
                                $trailer = $this->model_catalog_treiler->getTreiler($product_info['trailer_type_id'])   ;   
                           //     $freightType = $this->model_catalog_freightType->getfreight($product_info['freight_type_id'])   ;   
                               // $freightLoadingType = $this->model_catalog_freightLoadingType->getLoadingType( $product_info['freight_loading_type_id'] );   
                                
                                $owner = $this->model_account_customer->getCustomerBytruck($product_info['truck_id'])   ;  
                                
                                if( $product_info['frequency'] == 1 ) $loading_date = '[Regular]';
                                else  $loading_date =  $product_info['loading_date'];
                            
                                $images = array();		
                                $results = $this->model_catalog_truck->getProductImages($product_info['truck_id']);			
                                foreach ($results as $result) {
                                       $images[] = array(
                                                'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
                                                'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
                                        );
                                }	
                                
                            
                            $this->data['products'][$product_id] = array(
					'product_id'   => $product_info['truck_id'],
					'description'  => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'loading_date' => $loading_date,
                                        'loading_country' => $loading_country,
                                        'loading_city'    => $product_info['loading_city'],
                                        'offloading_country' => $offloading_country,
                                        'offloading_city' => $product_info['offloading_city'],
                                        'href'            => '?route=product/truck&product_id='.$product_info['truck_id'],
                                        'loading_zone'       =>  $loading_zone,
                                        'offloading_zone'    =>  $offloading_zone,
                                        'trailer'            =>  $trailer,
                                        'loading_date'       =>  $product_info['loading_date'],
                                        'offloading_date'    =>  $product_info['offloading_date'],
                                     //   'freight_type'       =>  $freightType,
                                     //   'freight_rate'       =>  $product_info['freight_rate'],
                                                               
                                        'lift'             =>  $product_info['lift'],
                                        'manipulator'      =>  $product_info['manipulator'],
 
                                        'adr'                =>  $product_info['adr'],
                                        'tir'                =>  $product_info['tir'],
                                        'cmr'        =>  $product_info['cmr'],
                                        'cemt'       =>  $product_info['cemt'],
                                    //    't1'         =>  $product_info['t1'],
                                     //   'ex1'        =>  $product_info['ex1'],
                                   //     'freight_type'       => $freightType,
                                       // 'freightLoadingType' => $freightLoadingType,
                                        'freight_params'     =>  $product_info['freight_params'],
                                        'weight_tons'        =>  $product_info['weight_tons'],
                                        'pallets_no'         =>  $product_info['pallets_no'],
                                 
                                        'exchangeable'        =>  $product_info['exchangeable'],
                                        'stackable'           =>  $product_info['stackable'],
                                        'volume_unit'         => $product_info['volume_unit'],
                                        'images'              => $images,
                                        'remove'    => $this->url->link('product/compareTruck', 'remove=' . $product_id),
                                        'details'   => $this->url->link('product/truck', 'product_id=' . $product_id),
                                        'owner' => $owner	
                                    
				);
                                                                      
			} else {
				unset($this->session->data['compare'][$key]);
			}
		}
		
		$this->data['continue'] = $this->url->link('common/home');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/compareTruck.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/compareTruck.tpl';
		} else {
			$this->template = 'default/template/product/compareTruck.tpl';
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
	
	public function add() {
		$this->language->load('product/compare');
		
		$json = array();

		if (!isset($this->session->data['comparetruck'])) {
			$this->session->data['comparetruck'] = array();
		}
				
		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}
		
		$this->load->model('catalog/truck');
		
		$product_info = $this->model_catalog_truck->getProduct($product_id);
		
		if ($product_info) {
			if (!in_array($this->request->post['product_id'], $this->session->data['comparetruck'])) {	
				if (count($this->session->data['comparetruck']) >= 10) {
					array_shift($this->session->data['comparetruck']);
				}
				
				$this->session->data['comparetruck'][] = $this->request->post['product_id'];
			}
			 
			//$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']),' ', $this->url->link('product/comparetruck'));				
		        $json['success'] = 'Success, truck added to the comparison!';
			$json['total'] = sprintf('Compare(%s)', (isset($this->session->data['comparetruck']) ? count($this->session->data['comparetruck']) : 0));
		}	

		$this->response->setOutput(json_encode($json));
	}
}
?>