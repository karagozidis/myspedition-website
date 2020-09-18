<?php   
class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->data['title'] = $this->document->getTitle();
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$this->data['base'] = $server;
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	 
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
                $this->data['image'] = $this->document->getImage();
		$this->data['lang'] = $this->language->get('code');
                
		$this->data['direction'] = $this->language->get('direction');
		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$this->data['name'] = $this->config->get('config_name');
		
		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$this->data['icon'] = '';
		}
		
		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
			$this->data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$this->data['logo'] = '';
		}		
		
		$this->language->load('common/header');
		
		$this->data['text_home'] = $this->language->get('text_home');
		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
                $this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));
                $this->data['fname'] =  $this->customer->getFirstName();
                $this->data['lname'] =  $this->customer->getLastName();
		$this->data['text_account'] = $this->language->get('text_account');
                $this->data['text_checkout'] = $this->language->get('text_checkout');
                
                
                $this->data['control_panel_text'] = $this->language->get('control_panel_text');
                $this->data['add_freight_text'] = $this->language->get('add_freight_text');
                $this->data['my_freight_list_text'] = $this->language->get('my_freight_list_text');
                $this->data['add_truck_text'] = $this->language->get('add_truck_text');
                $this->data['my_truck_list_text'] = $this->language->get('my_truck_list_text');
                
                $this->data['add_ship_route_text']          = $this->language->get('add_ship_route_text');
                $this->data['my_ship_route_list_text']      = $this->language->get('my_ship_route_list_text');
                $this->data['add_product_text']             = $this->language->get('add_product_text');
                $this->data['my_product_list_text']         = $this->language->get('my_product_list_text');
                $this->data['add_product_request_text']     = $this->language->get('add_product_request_text');
                $this->data['my_product_request_list_text'] = $this->language->get('my_product_request_list_text');
                $this->data['add_warehouse_text']           = $this->language->get('add_warehouse_text');
                $this->data['my_warehouse_list_text']       = $this->language->get('my_warehouse_list_text');
               
                $this->data['find_freight_text'] = $this->language->get('find_freight_text');
                $this->data['find_trucks_text'] = $this->language->get('find_trucks_text');
                $this->data['company_list_text'] = $this->language->get('company_list_text');
                $this->data['market_text'] = $this->language->get('market_text');
                $this->data['market_availability_now_text'] = $this->language->get('market_availability_now_text');
                
                $this->data['lists_text'] = $this->language->get('lists_text');
                $this->data['find_ship_routes_text'] = $this->language->get('find_ship_routes_text');
                $this->data['tools_text'] = $this->language->get('tools_text');
                
                $this->data['warehouse_text'] = $this->language->get('warehouse_text');
                $this->data['route_calculation_text'] = $this->language->get('route_calculation_text');
                $this->data['transport_dictionary_text'] = $this->language->get('transport_dictionary_text');
		
                $this->data['login_register_text'] = $this->language->get('login_register_text');
                $this->data['logout_text'] = $this->language->get('logout_text');
                
                
		$this->data['home'] = $this->url->link('common/home');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$this->data['logout'] = $this->url->link('account/logout', '', 'SSL');
               
                $this->language->load('account/login');
                
                $this->data['text_new_customer'] = $this->language->get('text_new_customer');
                $this->data['text_register'] = $this->language->get('text_register');
                $this->data['text_register_account'] = $this->language->get('text_register_account');
                $this->data['text_returning_customer'] = $this->language->get('text_returning_customer');
                $this->data['text_i_am_returning_customer'] = $this->language->get('text_i_am_returning_customer');
                $this->data['text_forgotten'] = $this->language->get('text_forgotten');
                $this->data['entry_email'] = $this->language->get('entry_email');
                $this->data['entry_password'] = $this->language->get('entry_password');
                $this->data['button_continue'] = $this->language->get('button_continue');
                $this->data['button_login'] = $this->language->get('button_login');
                
                $this->data['redirect'] =  $this->curPageURL();
                $this->data['action'] = $this->url->link('account/login', '', 'SSL');
		$this->data['register'] = $this->url->link('account/register', '', 'SSL');
		$this->data['forgotten'] = $this->url->link('account/forgotten', '', 'SSL');
                
                $this->load->model('catalog/storedTexts');
                $displayUpgrade = false;
                $cg = $this->customer->getCustomerGroup();
                
                if($this->customer->isLogged() && $cg['registration_price'] == 0 ){
                    $displayUpgrade = true;
                    $this->data['upgradeMail'] = $this->model_catalog_storedTexts->getStoredText('upgradeLargeText'); 
                 } 
                 
                 $this->data['keywordsText'] = $this->model_catalog_storedTexts->getStoredText('keywordsText'); 
                 $this->data['mainDescriptionText'] = $this->model_catalog_storedTexts->getStoredText('mainDescriptionText'); 
                   
                $this->data['displayUpgrade'] = $displayUpgrade;
		// Daniel's robot detector
		$status = true;
		
		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", trim($this->config->get('config_robots')));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}
		
		// A dirty hack to try to set a cookie for the multi-store feature
		$this->load->model('setting/store');
		
		$this->data['stores'] = array();
		
		if ($this->config->get('config_shared') && $status) {
			$this->data['stores'][] = $server . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
			
			$stores = $this->model_setting_store->getStores();
					
			foreach ($stores as $store) {
				$this->data['stores'][] = $store['url'] . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
			}
		}
				
		// Search		
		if (isset($this->request->get['search'])) {
			$this->data['search'] = $this->request->get['search'];
		} else {
			$this->data['search'] = '';
		}
		 
		// Menu
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/product');
		
		$this->data['categories'] = array();
					
		$categories = $this->model_catalog_category->getCategories(0);
		
		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();
				
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				
				foreach ($children as $child) {
					$data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);
					
					$product_total = $this->model_catalog_product->getTotalProducts($data);
									
					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);						
				}
				
				// Level 1
				$this->data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}
		
		$this->children = array(
			'module/language',
			'module/currency',
			'module/cart'
		);
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/header.tpl';
		} else {
			$this->template = 'default/template/common/header.tpl';
		}
		
    	$this->render();
	} 
        
        
       public function curPageURL() {
            $pageURL = 'http';
           if (isset($_SERVER["HTTPS"]))  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
             $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } else {
             $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }
            return $pageURL;
           }
}
?>
