<?php
################################################################################################
#  Product carousel module for opencart v1.5.2 Rajeev Shakya www.rshakya.com.np		    	   #
################################################################################################
?><?php

class ControllerModuleProductCarousel extends Controller {
	protected function index($setting) {
		//Load the language file for this module - catalog/language/module/my_module.php
		static $module = 0;
		$this->language->load('module/product_carousel');
		$this->load->model('tool/image');
		$this->document->addScript('catalog/view/javascript/jquery/jquery.jcarousel.min.js');
		
		$data['product_query_type']=$setting['product_query_type'];
		$this->data['button_cart'] = $this->language->get('button_cart');
		
		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/carousel.css');
		}
		
		$this->data['scroll']=$setting['scroll'];
		$this->data['limit']=isset($setting['limit'])?$setting['limit']:5;
		$data['img_width']=$setting['image_width'];
		$data['img_height']=$setting['image_height'];
		
		$this->data['products'] = array();
		
		switch($data['product_query_type']){
			case 1:
				$products = explode(',', $this->config->get('featured_product'));
				//print_r($products);exit;
				
				
				$products = array_slice($products, 0, (int)$this->data['limit']);
				
				foreach ($products as $product_id) {
					$product_info = $this->model_catalog_product->getProduct($product_id);
				
					if ($product_info) {
						if ($product_info['image']) {
							$image = $this->model_tool_image->resize($product_info['image'], $setting['image_width'], $setting['image_height']);
						} else {
							$image = false;
						}
				
						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$price = false;
						}
				
						if ((float)$product_info['special']) {
							$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$special = false;
						}
				
						if ($this->config->get('config_review_status')) {
							$rating = $product_info['rating'];
						} else {
							$rating = false;
						}
							
						$this->data['products'][] = array(
								'product_id' => $product_info['product_id'],
								'thumb'   	 => $image,
								'name'    	 => $product_info['name'],
								'price'   	 => $price,
								'special' 	 => $special,
								'rating'     => $rating,
								'reviews'    => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
								'href'    	 => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
						);
						
						//Get the title from the language file
						$this->data['heading_title']=$this->language->get('heading_title_featured');
                                                $this->data['view']=$this->language->get('view');
					}
				}
			break;
			case 2:
				$data = array(
						'sort'  => 'p.date_added',
						'order' => 'DESC',
						'start' => 0,
						'limit' => $this->data['limit'],
                                                'with_image' => 'No'
				);
				
				$results = $this->model_catalog_product->getProducts($data);
				
				foreach ($results as $result) {
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
					} else {
						$image = false;
					}
				
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}
				
					if ((float)$result['special']) {
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}
				
					if ($this->config->get('config_review_status')) {
						$rating = $result['rating'];
					} else {
						$rating = false;
					}
				
					$this->data['products'][] = array(
							'product_id' => $result['product_id'],
							'thumb'   	 => $image,
							'name'    	 => $result['name'],
							'price'   	 => $price,
							'special' 	 => $special,
							'rating'     => $rating,
							'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
							'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
					);
					
					//Get the title from the language file
					$this->data['heading_title']=$this->language->get('heading_title_latest');
                                        $this->data['view']=$this->language->get('view');
				}
				break;
				$data = array(
						'sort'  => 'pd.name',
						'order' => 'ASC',
						'start' => 0,
						'limit' => $setting['limit']
				);
				
				$results = $this->model_catalog_product->getProductSpecials($data);
				
				foreach ($results as $result) {
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
					} else {
						$image = false;
					}
				
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}
				
					if ((float)$result['special']) {
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}
				
					if ($this->config->get('config_review_status')) {
						$rating = $result['rating'];
					} else {
						$rating = false;
					}
				
					$this->data['products'][] = array(
							'product_id' => $result['product_id'],
							'thumb'   	 => $image,
							'name'    	 => $result['name'],
							'price'   	 => $price,
							'special' 	 => $special,
							'rating'     => $rating,
							'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
							'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
					);
					
					//Get the title from the language file
					$this->data['heading_title']=$this->language->get('heading_title_special');
                                        $this->data['view']=$this->language->get('view');
				}
				break;
			default:
			break;
		}
		
		$products = explode(',', $this->config->get('featured_product'));
		
 
		//Load any required model files - catalog/product is a common one, or you can make your own DB access
		//methods in catalog/model/module/my_module.php
		//$this->load->model('module/product_carousel');
      	$this->data['module'] = $module++;
		//Choose which template to display this module with
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/product_carousel.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/product_carousel.tpl';
		} else {
			$this->template = 'default/template/module/product_carousel.tpl';
		}

		//Render the page with the chosen template
		$this->render();
	}
}
?>