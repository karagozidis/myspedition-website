<?php
class ControllerSaleCustomerGroup extends Controller {
	private $error = array();
 
	public function index() {
		$this->language->load('sale/customer_group');
 
		$this->document->setTitle($this->language->get('heading_title'));
 		
		$this->load->model('sale/customer_group');
		
		$this->getList();
	}

	public function insert() {
		$this->language->load('sale/customer_group');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_group');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_customer_group->addCustomerGroup($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('sale/customer_group');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_group');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_customer_group->editCustomerGroup($this->request->get['customer_group_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() { 
		$this->language->load('sale/customer_group');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_group');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
      		foreach ($this->request->post['selected'] as $customer_group_id) {
				$this->model_sale_customer_group->deleteCustomerGroup($customer_group_id);	
			}
						
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'cgd.name';
		}
		 
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}	
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
			
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		$this->data['insert'] = $this->url->link('sale/customer_group/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('sale/customer_group/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	
	
		$this->data['customer_groups'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$customer_group_total = $this->model_sale_customer_group->getTotalCustomerGroups();
		
		$results = $this->model_sale_customer_group->getCustomerGroups($data);

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/customer_group/update', 'token=' . $this->session->data['token'] . '&customer_group_id=' . $result['customer_group_id'] . $url, 'SSL')
			);		
		
			$this->data['customer_groups'][] = array(
				'customer_group_id' => $result['customer_group_id'],
				'name'              => $result['name'] . (($result['customer_group_id'] == $this->config->get('config_customer_group_id')) ? $this->language->get('text_default') : null),
				'sort_order'        => $result['sort_order'],
				'selected'          => isset($this->request->post['selected']) && in_array($result['customer_group_id'], $this->request->post['selected']),
				'action'            => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_name'] = $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . '&sort=cgd.name' . $url, 'SSL');
		$this->data['sort_sort_order'] = $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . '&sort=cg.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
		$pagination = new Pagination();
		$pagination->total = $customer_group_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		
		$this->data['pagination'] = $pagination->render();				

		$this->data['sort'] = $sort; 
		$this->data['order'] = $order;

		$this->template = 'sale/customer_group_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
 	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
				
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_approval'] = $this->language->get('entry_approval');
		$this->data['entry_company_id_display'] = $this->language->get('entry_company_id_display');
		$this->data['entry_company_id_required'] = $this->language->get('entry_company_id_required');
		$this->data['entry_tax_id_display'] = $this->language->get('entry_tax_id_display');
		$this->data['entry_tax_id_required'] = $this->language->get('entry_tax_id_required');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
			
		if (!isset($this->request->get['customer_group_id'])) {
			$this->data['action'] = $this->url->link('sale/customer_group/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('sale/customer_group/update', 'token=' . $this->session->data['token'] . '&customer_group_id=' . $this->request->get['customer_group_id'] . $url, 'SSL');
		}
		  
    	$this->data['cancel'] = $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['customer_group_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$customer_group_info = $this->model_sale_customer_group->getCustomerGroup($this->request->get['customer_group_id']);
		}
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['customer_group_description'])) {
			$this->data['customer_group_description'] = $this->request->post['customer_group_description'];
		} elseif (isset($this->request->get['customer_group_id'])) {
			$this->data['customer_group_description'] = $this->model_sale_customer_group->getCustomerGroupDescriptions($this->request->get['customer_group_id']);
		} else {
			$this->data['customer_group_description'] = array();
		}	
		
		if (isset($this->request->post['approval'])) {
			$this->data['approval'] = $this->request->post['approval'];
		} elseif (!empty($customer_group_info)) {
			$this->data['approval'] = $customer_group_info['approval'];
		} else {
			$this->data['approval'] = '';
		}	
					
		if (isset($this->request->post['company_id_display'])) {
			$this->data['company_id_display'] = $this->request->post['company_id_display'];
		} elseif (!empty($customer_group_info)) {
			$this->data['company_id_display'] = $customer_group_info['company_id_display'];
		} else {
			$this->data['company_id_display'] = '';
		}			
			
		if (isset($this->request->post['company_id_required'])) {
			$this->data['company_id_required'] = $this->request->post['company_id_required'];
		} elseif (!empty($customer_group_info)) {
			$this->data['company_id_required'] = $customer_group_info['company_id_required'];
		} else {
			$this->data['company_id_required'] = '';
		}		
		
		if (isset($this->request->post['tax_id_display'])) {
			$this->data['tax_id_display'] = $this->request->post['tax_id_display'];
		} elseif (!empty($customer_group_info)) {
			$this->data['tax_id_display'] = $customer_group_info['tax_id_display'];
		} else {
			$this->data['tax_id_display'] = '';
		}			
			
		if (isset($this->request->post['tax_id_required'])) {
			$this->data['tax_id_required'] = $this->request->post['tax_id_required'];
		} elseif (!empty($customer_group_info)) {
			$this->data['tax_id_required'] = $customer_group_info['tax_id_required'];
		} else {
			$this->data['tax_id_required'] = '';
		}	
		
		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($customer_group_info)) {
			$this->data['sort_order'] = $customer_group_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}	
			
                
                
                
                if (isset($this->request->post['priority_view'])) {
			$this->data['priority_view'] = $this->request->post['priority_view'];
		} elseif (!empty($customer_group_info)) {
			$this->data['priority_view'] = $customer_group_info['priority_view'];
		} else {
			$this->data['priority_view'] = '';
		}	
                
                if (isset($this->request->post['gift_program'])) {
			$this->data['gift_program'] = $this->request->post['gift_program'];
		} elseif (!empty($customer_group_info)) {
			$this->data['gift_program'] = $customer_group_info['gift_program'];
		} else {
			$this->data['gift_program'] = '';
		}	
                
                if (isset($this->request->post['skype_assistance'])) {
			$this->data['skype_assistance'] = $this->request->post['skype_assistance'];
		} elseif (!empty($customer_group_info)) {
			$this->data['skype_assistance'] = $customer_group_info['skype_assistance'];
		} else {
			$this->data['skype_assistance'] = '';
		}	
              
                if (isset($this->request->post['personal_agent'])) {
			$this->data['personal_agent'] = $this->request->post['personal_agent'];
		} elseif (!empty($customer_group_info)) {
			$this->data['personal_agent'] = $customer_group_info['personal_agent'];
		} else {
			$this->data['personal_agent'] = '';
		}	
                                            
                if (isset($this->request->post['logo_preview'])) {
			$this->data['logo_preview'] = $this->request->post['logo_preview'];
		} elseif (!empty($customer_group_info)) {
			$this->data['logo_preview'] = $customer_group_info['logo_preview'];
		} else {
			$this->data['logo_preview'] = '';
		}	
                
                if (isset($this->request->post['registration_price'])) {
			$this->data['registration_price'] = $this->request->post['registration_price'];
		} elseif (!empty($customer_group_info)) {
			$this->data['registration_price'] = $customer_group_info['registration_price'];
		} else {
			$this->data['registration_price'] = '';
		}	
                                                             
                if (isset($this->request->post['duration'])) {
			$this->data['duration'] = $this->request->post['duration'];
		} elseif (!empty($customer_group_info)) {
			$this->data['duration'] = $customer_group_info['duration'];
		} else {
			$this->data['duration'] = '';
		}	
                
                
                
                
                if (isset($this->request->post['view_mail'])) {
			$this->data['view_mail'] = $this->request->post['view_mail'];
		} elseif (!empty($customer_group_info)) {
			$this->data['view_mail'] = $customer_group_info['view_mail'];
		} else {
			$this->data['view_mail'] = '';
		}
                
                if (isset($this->request->post['view_telephone'])) {
			$this->data['view_telephone'] = $this->request->post['view_telephone'];
		} elseif (!empty($customer_group_info)) {
			$this->data['view_telephone'] = $customer_group_info['view_telephone'];
		} else {
			$this->data['view_telephone'] = '';
		}	
                
                if (isset($this->request->post['view_fax'])) {
			$this->data['view_fax'] = $this->request->post['view_fax'];
		} elseif (!empty($customer_group_info)) {
			$this->data['view_fax'] = $customer_group_info['view_fax'];
		} else {
			$this->data['view_fax'] = '';
		}
                
                if (isset($this->request->post['view_skype'])) {
			$this->data['view_skype'] = $this->request->post['view_skype'];
		} elseif (!empty($customer_group_info)) {
			$this->data['view_skype'] = $customer_group_info['view_skype'];
		} else {
			$this->data['view_skype'] = '';
		}
                
                if (isset($this->request->post['view_icq'])) {
			$this->data['view_icq'] = $this->request->post['view_icq'];
		} elseif (!empty($customer_group_info)) {
			$this->data['view_icq'] = $customer_group_info['view_icq'];
		} else {
			$this->data['view_icq'] = '';
		}
                
                if (isset($this->request->post['view_website'])) {
			$this->data['view_website'] = $this->request->post['view_website'];
		} elseif (!empty($customer_group_info)) {
			$this->data['view_website'] = $customer_group_info['view_website'];
		} else {
			$this->data['view_website'] = '';
		}
                
                if (isset($this->request->post['view_insertion_delay'])) {
			$this->data['view_insertion_delay'] = $this->request->post['view_insertion_delay'];
		} elseif (!empty($customer_group_info)) {
			$this->data['view_insertion_delay'] = $customer_group_info['view_insertion_delay'];
		} else {
			$this->data['view_insertion_delay'] = '';
		}
                
                if (isset($this->request->post['premium_design'])) {
			$this->data['premium_design'] = $this->request->post['premium_design'];
		} elseif (!empty($customer_group_info)) {
			$this->data['premium_design'] = $customer_group_info['premium_design'];
		} else {
			$this->data['premium_design'] = '';
		}
                
                if (isset($this->request->post['display_description'])) {
			$this->data['display_description'] = $this->request->post['display_description'];
		} elseif (!empty($customer_group_info)) {
			$this->data['display_description'] = $customer_group_info['display_description'];
		} else {
			$this->data['display_description'] = '';
		}	
                
                
                
                  
                if (isset($this->request->post['photo_album_number'])) {
			$this->data['photo_album_number'] = $this->request->post['photo_album_number'];
		} elseif (!empty($customer_group_info)) {
			$this->data['photo_album_number'] = $customer_group_info['photo_album_number'];
		} else {
			$this->data['photo_album_number'] = '';
		}
                
                if (isset($this->request->post['products_number'])) {
			$this->data['products_number'] = $this->request->post['products_number'];
		} elseif (!empty($customer_group_info)) {
			$this->data['products_number'] = $customer_group_info['products_number'];
		} else {
			$this->data['products_number'] = '';
		}
                
                if (isset($this->request->post['freights_number'])) {
			$this->data['freights_number'] = $this->request->post['freights_number'];
		} elseif (!empty($customer_group_info)) {
			$this->data['freights_number'] = $customer_group_info['freights_number'];
		} else {
			$this->data['freights_number'] = '';
		}
                
                if (isset($this->request->post['trucks_number'])) {
			$this->data['trucks_number'] = $this->request->post['trucks_number'];
		} elseif (!empty($customer_group_info)) {
			$this->data['trucks_number'] = $customer_group_info['trucks_number'];
		} else {
			$this->data['trucks_number'] = '';
		}
                
                if (isset($this->request->post['show_views'])) {
			$this->data['show_views'] = $this->request->post['show_views'];
		} elseif (!empty($customer_group_info)) {
			$this->data['show_views'] = $customer_group_info['show_views'];
		} else {
			$this->data['show_views'] = '';
		}
                
                if (isset($this->request->post['warehouse_number'])) {
			$this->data['warehouse_number'] = $this->request->post['warehouse_number'];
		} elseif (!empty($customer_group_info)) {
			$this->data['warehouse_number'] = $customer_group_info['warehouse_number'];
		} else {
			$this->data['warehouse_number'] = '';
		}
                
                
                     
                
		$this->template = 'sale/customer_group_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render()); 
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'sale/customer_group')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->request->post['customer_group_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 32)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'sale/customer_group')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->load->model('setting/store');
		$this->load->model('sale/customer');
      	
		foreach ($this->request->post['selected'] as $customer_group_id) {
    		if ($this->config->get('config_customer_group_id') == $customer_group_id) {
	  			$this->error['warning'] = $this->language->get('error_default');	
			}  
			
			$store_total = $this->model_setting_store->getTotalStoresByCustomerGroupId($customer_group_id);

			if ($store_total) {
				$this->error['warning'] = sprintf($this->language->get('error_store'), $store_total);
			}
			
			$customer_total = $this->model_sale_customer->getTotalCustomersByCustomerGroupId($customer_group_id);

			if ($customer_total) {
				$this->error['warning'] = sprintf($this->language->get('error_customer'), $customer_total);
			}
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>