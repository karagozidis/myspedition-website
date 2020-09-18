<?php  

class ControllerModuleRegistration extends Controller {

	protected function index($setting) {

		$this->language->load('common/header');

		

    	$this->data['heading_title'] = $this->language->get('text_account');

		

		if (isset($this->request->get['path'])) {

			$parts = explode('_', (string)$this->request->get['path']);

		} else {

			$parts = array();

		}

		

		if (isset($parts[0])) {

			$this->data['category_id'] = $parts[0];

		} else {

			$this->data['category_id'] = 0;

		}

		

		if (isset($parts[1])) {

			$this->data['child_id'] = $parts[1];

		} else {

			$this->data['child_id'] = 0;

		}

		$this->data['logout'] = $this->url->link('account/logout', '', 'SSL');	

                $this->language->load('common/header');

		$this->data['fname'] =  $this->customer->getFirstName();
                $this->data['lname'] =  $this->customer->getLastName();
                
                $this->data['logout_text'] = $this->language->get('logout_text');
		$this->data['text_home'] = $this->language->get('text_home');

		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));

		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');

                $this->data['text_search'] = $this->language->get('text_search');

		$this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));

		$this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$this->data['text_account'] = $this->language->get('login_register_text');

                $this->data['text_checkout'] = $this->language->get('text_checkout');

				

		$this->data['home'] = $this->url->link('common/home');

		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');

		$this->data['logged'] = $this->customer->isLogged();

		$this->data['account'] = $this->url->link('account/account', '', 'SSL');

		$this->data['shopping_cart'] = $this->url->link('checkout/cart');

		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

                $this->data['logged'] = $this->customer->isLogged();

		//$this->load->model('customer/customer');

               // $this->load->model('localisation/country');

                

		//$this->load->model('catalog/product');



		//$this->data['categories'] = array();



             /*   $data = array(                       

                            'sort'                     => 'date_added',

                            'order'                    => 'DESC',

                            'start'                    => 0,

                            'limit'                    => 8

                            );

                

		   $results = $this->model_customer_customer->getCustomers($data);

*/

                /*

                    	foreach ($results as $result) {

			$action = array();

		

			$action[] = array(

				'text' => $this->language->get('text_edit'),

				'href' => ''  //$this->url->link('customer/customer/update', '&customer_id=' . $result['customer_id'] . $url, 'SSL')

			);*/

                        

                      //  $addresses = $this->model_customer_customer->getAddresses($result['customer_id']);

			                      

                        //$country = $this->model_localisation_country->getCountry($result['country_id']);

                                            

		/*	$this->data['customers'][] = array(

				'customer_id'    => $result['customer_id'],

				'name'           => $result['name'],

				'email'          => $result['email'],

				'customer_group' => $result['customer_group'],

				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),

				'approved'       => ($result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')),

				'ip'             => $result['ip'],

				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),

				'selected'       => isset($this->request->post['selected']) && in_array($result['customer_id'], $this->request->post['selected']),

				'action'         => $action,

                                'company'        =>$result['company'],// $addresses[1]['company'],

                                'description'    => $result['description'],// $addresses[1]['address_1'],

                                'country'        => $country                           

			);*/

		//}	

                

                

		/*foreach ($categories as $category) {

			$total = $this->model_catalog_product->getTotalProducts(array('filter_category_id' => $category['category_id']));



			$children_data = array();



			$children = $this->model_catalog_category->getCategories($category['category_id']);



			foreach ($children as $child) {

				$data = array(

					'filter_category_id'  => $child['category_id'],

					'filter_sub_category' => true

				);



				$product_total = $this->model_catalog_product->getTotalProducts($data);



				$total += $product_total;



				$children_data[] = array(

					'category_id' => $child['category_id'],

					'name'        => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),

					'href'        => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])	

				);		

			}



			$this->data['categories'][] = array(

				'category_id' => $category['category_id'],

				'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $total . ')' : ''),

				'children'    => $children_data,

				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])

			);	

		}*/

		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/registration.tpl')) {

			$this->template = $this->config->get('config_template') . '/template/module/registration.tpl';

		} else {

			$this->template = 'default/template/module/registration.tpl';

		}

		

		$this->render();

  	}

}

?>