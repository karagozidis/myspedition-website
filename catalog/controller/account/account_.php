<?php 
class ControllerAccountAccount extends Controller { 
	public function index() {
		if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
                } 
	
		$this->language->load('account/account');
		$this->document->setTitle($this->language->get('heading_title'));

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	); 

      	$this->data['breadcrumbs'][] = array(       	
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);
		
		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
                $this->data['heading_title'] = $this->language->get('heading_title');

                $this->data['text_my_account'] = $this->language->get('text_my_account');
		$this->data['text_my_orders'] = $this->language->get('text_my_orders');
		$this->data['text_my_newsletter'] = $this->language->get('text_my_newsletter');
                $this->data['text_edit'] = $this->language->get('text_edit');
                $this->data['text_password'] = $this->language->get('text_password');
                $this->data['text_address'] = $this->language->get('text_address');
		$this->data['text_wishlist'] = $this->language->get('text_wishlist');
                $this->data['text_order'] = $this->language->get('text_order');
                $this->data['text_download'] = $this->language->get('text_download');
		$this->data['text_reward'] = $this->language->get('text_reward');
		$this->data['text_return'] = $this->language->get('text_return');
		$this->data['text_transaction'] = $this->language->get('text_transaction');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');

                $this->data['manage_freights_trucks_text'] = $this->language->get('manage_freights_trucks_text');
                $this->data['my_freight_list_text'] = $this->language->get('my_freight_list_text');
                $this->data['add_freight_text'] = $this->language->get('add_freight_text');
		$this->data['my_truck_list_text'] = $this->language->get('my_truck_list_text');
		$this->data['add_truck_text'] = $this->language->get('add_truck_text');                                             
                
                
                $this->data['edit'] = $this->url->link('account/edit', '', 'SSL');
                $this->data['interestCountries'] = $this->url->link('account/interestCountries', '', 'SSL');
                $this->data['favoritecompanies'] = $this->url->link('account/favoriteCustomer', '', 'SSL');
                $this->data['my_quotes'] = $this->url->link('catalog/freightOffer', '', 'SSL');
                $this->data['password'] = $this->url->link('account/password', '', 'SSL');
		$this->data['address'] = $this->url->link('account/address', '', 'SSL');
		$this->data['wishlist'] = $this->url->link('account/wishlist');
                $this->data['order'] = $this->url->link('account/order', '', 'SSL');
                $this->data['download'] = $this->url->link('account/download', '', 'SSL');
		$this->data['return'] = $this->url->link('account/return', '', 'SSL');
		$this->data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$this->data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');
		
                $this->data['customer'] = $this->customer;
                
		if ($this->config->get('reward_status')) {
			$this->data['reward'] = $this->url->link('account/reward', '', 'SSL');
		} else {
			$this->data['reward'] = '';
		}
		
                $this->load->model('catalog/storedTexts');
                $this->data['upgradeText'] = $this->model_catalog_storedTexts->getStoredText('upgradeMail'); 
         
                $this->load->model("customer/customer_group");
                $this->data['customer_groups'] = $this->model_customer_customer_group->getPayedCustomerGroups(null);
                $this->data['customer_id'] = $this->customer->getId();
                $this->data['upgradeAction'] = $this->url->link('account/payment', 'SSL');
                
                $this->load->model('account/customer');
                $this->load->model('account/customer_group');
                $customer = $this->model_account_customer->getCustomer( $this->customer->getId() );
                
                $customerGroup = $this->model_account_customer_group->getCustomerGroup( $customer['customer_group_id'] );
                $req_customerGroup = $this->model_account_customer_group->getCustomerGroup( $customer['requested_customer_group_id'] );
                
                $displayUpgrade = false;
                $daysRemaining = ($customerGroup['duration']-$customer['daysPassed']) ;
                $displayExpirationMessage = false;
                $expirationMessage = "";
                
                 if( $customerGroup['registration_price'] == 0 )
                    {
                     $displayUpgrade = true;
                    }
                
                 if( $customerGroup['registration_price'] > 0 && $daysRemaining <= 0 )
                    {
                      $displayUpgrade = true;
                    }
                  
                   
               if( $customerGroup['registration_price'] > 0 && ( $daysRemaining > 0 && $daysRemaining <= 6 ) )
                    {  
                      $displayUpgrade = true;
                      $displayExpirationMessage = true;
                      $expirationMessage = "Attention, Your account is expiring in ".$daysRemaining." days, repurchase a Premuim account now!!";
                    }
                    
               $this->data['displayUpgrade'] = $displayUpgrade;
               $this->data['displayExpirationMessage'] = $displayExpirationMessage;
               $this->data['expirationMessage'] = $expirationMessage;
                 
               $this->load->model('catalog/freightOffer');
               
               $data = array(
			'customer_id'	  => $this->customer->getId(), 
			'freight_id'	  => NULL,
		); 
                $this->data['freight_offers_total'] = $this->model_catalog_freightOffer->getTotalCustomerOffersReceivedDetailed($data);
               
               $data = array(
			'customer_id'	  => $this->customer->getId(), 
			'freight_id'	  => NULL,
                        'shown'           => 0
		); 
                $this->data['freight_offers_new'] = $this->model_catalog_freightOffer->getTotalCustomerOffersReceivedDetailed($data);
                
                $this->load->model('customer/customer_group');
                
                $data = array('display_description' => 1); 
                $this->data['available_customer_groups'] =  $this->model_customer_customer_group->getCustomerGroups($data);
        
                
                $this->data['freight_offers_done_total'] = $this->model_catalog_freightOffer->getTotalCustomerOffersDetailed($this->customer->getId());
                

                $this->data['customer'] = $customer; 
                
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/account.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/account.tpl';
		} else {
			$this->template = 'default/template/account/account.tpl';
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