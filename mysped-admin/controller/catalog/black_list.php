<?php
class ControllerCatalogBlacklist extends Controller { 
	private $error = array();
	public function index() {
		$this->load->language('catalog/black_list');

		$this->document->SetTitle($this->language->get('heading_title'));
		 
		$this->load->model('catalog/black_list');

		$this->getList();

	}

	public function insert() {
		$this->load->language('catalog/black_list');

		$this->document->SetTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/black_list');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_black_list->addblack_list($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			$this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . $url, 'SSL'));
			//$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . $url);
		}

		$this->getForm(true);
	}

	public function update() {
		$this->load->language('catalog/black_list');

		$this->document->SetTitle( $this->language->get('heading_title') );
		
		$this->load->model('catalog/black_list');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_catalog_black_list->editblack_list($this->request->get['black_list_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			//$this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . $url, 'SSL'));
			//$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . $url);
		} 

		$this->getForm(false);
	}
 
	public function delete() {
		$this->load->language('catalog/black_list');

		$this->document->SetTitle( $this->language->get('heading_title'));
		
		$this->load->model('catalog/black_list');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $black_list_id) {
				$this->model_catalog_black_list->deleteblack_list($black_list_id);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			$this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . $url, 'SSL'));
			//$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . $url);
		}

		$this->getList();
	}

	private function getList() {
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 't.date_added';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		$url = '';
			
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}



		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/black_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

							
		$this->data['insert'] = $this->url->link('catalog/black_list/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/black_list/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['module_settings_path'] = $this->url->link('module/black_list', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['text_module_settings'] = $this->language->get('text_module_settings');


		$this->data['black_lists'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);
		
		$black_list_total = $this->model_catalog_black_list->getTotalBlack_lists();
		$this->data['black_list_total'] = $black_list_total;
		
		if ($black_list_total!=-1)
			$results = $this->model_catalog_black_list->getBlack_lists($data);
 		else
		{
			$results = array();
			$black_list_total = 0;
		}


                $this->load->model('sale/customer');
            
    		foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/black_list/update', '&token=' . $this->session->data['token'] . '&black_list_id=' . $result['black_list_id'] . $url, 'SSL')
			);
					

			$result['description'] = strip_tags(html_entity_decode($result['description']));

			//$lim = 50;
			//if (mb_strlen($result['description'],'UTF-8')>$lim) $result['description'] = mb_substr($result['description'], 0, $lim-3, 'UTF-8').'...';
                
                $from_customer = $this->model_sale_customer->getCustomer($result['from_customer_id']);
                $to_customer = $this->model_sale_customer->getCustomer($result['to_customer_id']);
                
                $from_customer['url'] =  $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id='.$from_customer['customer_id'], 'SSL');
                $to_customer['url'] =  $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id='.$to_customer['customer_id'], 'SSL');
                
	
                        
			$this->data['black_lists'][] = array(
				'black_list_id' => $result['black_list_id'],
				'name'		=> $result['name'],
				'description'	=> $result['description'],
				'city'		=> $result['city'],
				'title'      	=> $result['title'],
				'date_added' 	=> $result['date_added'],
                                'from_customer' => $from_customer,
                                'to_customer'   => $to_customer,
				'status' 	=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   	=> isset($this->request->post['selected']) && in_array($result['black_list_id'], $this->request->post['selected']),
				'action'     	=> $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_title'] = $this->language->get('column_title');
		$this->data['column_description'] = $this->language->get('column_description');

		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_action'] = $this->language->get('column_action');		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_city'] = $this->language->get('column_city');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['entry_install_first'] = $this->language->get('entry_install_first');;

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
			$url .= '&order=' .  'DESC';
		} else {
			$url .= '&order=' .  'ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		//$this->data['sort_title'] = $this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . '&sort=td.title' . $url, 'SSL'));
                       // HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . '&sort=td.title' . $url;
		//$this->data['sort_date_added'] =  $this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . '&sort=t.date_added' . $url, 'SSL')); 
                       // HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . '&sort=t.date_added' . $url;
	//	$this->data['sort_status'] =  $this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . '&sort=t.status' . $url, 'SSL')); 
                       // HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . '&sort=t.status' . $url;
	//	$this->data['sort_name'] = $this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . '&sort=t.name' . $url, 'SSL')); 
                      //  HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . '&sort=t.name' . $url;
	//	$this->data['sort_description'] =  $this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . '&sort=td.description' . $url, 'SSL')); 
                       // HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . '&sort=td.description' . $url;
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $black_list_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		
		//$pagination->url = $this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . $url . '&page={page}', 'SSL')); 
                        //HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . $url . '&page={page}';
			
		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'catalog/black_list_list.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function getForm($is_edit) {
	
		$this->data['is_edit'] = $is_edit;
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_date_added'] = $this->language->get('entry_date_added');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['entry_email'] = $this->language->get('entry_email');

		$this->data['entry_rating'] = $this->language->get('entry_rating');
		$this->data['entry_bad'] = $this->language->get('entry_bad');
		$this->data['entry_good'] = $this->language->get('entry_good');

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
			$this->data['error_name'] = '';
		}
		
	 	if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = '';
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
			'href'      => $this->url->link('catalog/black_list', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
							
		///if (!isset($this->request->get['black_list_id'])) {
			//$this->data['action'] = $this->redirect($this->url->link('catalog/black_list/insert', '&token='. $this->session->data['token'] . $url , 'SSL')); 
                              //  HTTPS_SERVER . 'index.php?route=catalog/black_list/insert&token=' . $this->session->data['token'] . $url;
		//} else {
		$this->data['action'] =$this->url->link('catalog/black_list/update', '&token='. $this->session->data['token'] . '&black_list_id=' . $this->request->get['black_list_id']  . $url , 'SSL'); 
                              //  HTTPS_SERVER . 'index.php?route=catalog/black_list/update&token=' . $this->session->data['token'] . '&black_list_id=' . $this->request->get['black_list_id'] . $url;
		//}
		
		//$this->data['cancel'] = $this->redirect($this->url->link('catalog/black_list', '&token='. $this->session->data['token'] . $url , 'SSL')); 
                       // HTTPS_SERVER . 'index.php?route=catalog/black_list&token=' . $this->session->data['token'] . $url;

                $this->data['cancel'] = $this->url->link('catalog/black_list', '&token='. $this->session->data['token'] , 'SSL'); 
		$this->data['token'] = $this->session->data['token'];
	
		if (isset($this->request->get['black_list_id'])) {
			$black_list_info = $this->model_catalog_black_list->getBlack_list($this->request->get['black_list_id']);
		}
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		/*if (isset($this->request->post['black_list_description'])) {
			$this->data['black_list_description'] = $this->request->post['black_list_description'];
		} elseif (isset($this->request->get['black_list_id'])) {
			$this->data['black_list_description'] = $this->model_catalog_black_list->getblack_listDescriptions($this->request->get['black_list_id']);
		} else {
			$this->data['black_list_description'] = array();
		} */

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (isset($black_list_info)) {
			$this->data['status'] = $black_list_info['status'];
		} else {
			$this->data['status'] = 1;
		}

		/*if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} elseif (isset($black_list_info)) {
			$this->data['name'] = $black_list_info['name'];
		} else {
			$this->data['name'] = '';
		}

		if (isset($this->request->post['city'])) {
			$this->data['city'] = $this->request->post['city'];
		} elseif (isset($black_list_info)) {
			$this->data['city'] = $black_list_info['city'];
		} else {
			$this->data['city'] = '';
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} elseif (isset($black_list_info)) {
			$this->data['email'] = $black_list_info['email'];
		} else {
			$this->data['email'] = '';
		} */

		
		if (isset($this->request->post['date_added'])) {
			$this->data['date_added'] = $this->request->post['date_added'];
		} elseif (isset($black_list_info)) {
			$this->data['date_added'] = $black_list_info['date_added'];
		} else {
			$this->data['date_added'] = $this->model_catalog_black_list->getCurrentDateTime();
		}
		

		/*if (isset($this->request->post['rating'])) {
			$this->data['rating'] = $this->request->post['rating'];
		} elseif (isset($black_list_info)) {
			$this->data['rating'] = $black_list_info['rating'];
		} else {

			if ($this->config->get('black_list_default_rating')=='')
				$this->data['rating'] = '3';
			else
				$this->data['rating'] = $this->config->get('black_list_default_rating');

		} */
		
                
                if (isset($this->request->post['title'])) {
			$this->data['title'] = $this->request->post['title'];
		} elseif (isset($black_list_info)) {
			$this->data['title'] = $black_list_info['title'];
		} else {
			$this->data['title'] = '';
		}
                
                if (isset($this->request->post['description'])) {
			$this->data['description'] = $this->request->post['description'];
		} elseif (isset($black_list_info)) {
			$this->data['description'] = $black_list_info['description'];
		} else {
			$this->data['description'] = '';
		}
                
                $this->load->model('sale/customer');
                
              //  if (isset($this->request->post['from_customer_id'])) {
		//	$this->data['from_customer'] =
               //                 $this->model_sale_customer->getCustomer($this->request->post['from_customer_id']);
               //         $this->data['from_customer']['url'] =
                //        $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id='.$this->data['from_customer']['customer_id'], 'SSL');
                        
		//} elseif (isset($black_list_info)) {
			$this->data['from_customer'] = 
                                $this->model_sale_customer->getCustomer($black_list_info['from_customer_id']);
                        $this->data['from_customer']['url'] =
                            $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id='.$this->data['from_customer']['customer_id'], 'SSL');
		//} else {
		//	$this->data['from_customer'] = '';
		//}
                
                
               // if (isset($this->request->post['to_customer_id'])) {
		//	$this->data['to_customer'] =
                //                $this->model_sale_customer->getCustomer($this->request->post['to_customer_id']);
                //        $this->data['to_customer']['url'] =
                //            $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id='.$this->data['to_customer']['customer_id'], 'SSL');
                        
		//} elseif (isset($black_list_info)) {
			$this->data['to_customer'] = 
                                $this->model_sale_customer->getCustomer($black_list_info['to_customer_id']);
                        $this->data['to_customer']['url'] =
                            $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id='.$this->data['to_customer']['customer_id'], 'SSL');
		//} else {
		//	$this->data['to_customer'] = '';
		//}
                
                
                
		$this->template = 'catalog/black_list_form.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		//$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
		$this->response->setOutput($this->render());

	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/black_list')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}


		foreach ($this->request->post['black_list_description'] as $language_id => $value) {
			if (strlen(utf8_decode($value['description'])) != 0) {
				$this->request->post['black_list_description'][$language_id]['description'] = (html_entity_decode($value['description']));
			}		
		}


		$desc = '';
		foreach ($this->request->post['black_list_description'] as $language_id => $value) {
			if (strlen(utf8_decode($value['description'])) != 0) {
				$desc = $value['description'];
				break;
			}		
		}

		if ($desc == '')
		{
			foreach ($this->request->post['black_list_description'] as $language_id => $value) {
					$this->error['description'][$language_id] = $this->language->get('error_description');
			}
		}
		else
		{
			foreach ($this->request->post['black_list_description'] as $language_id => $value) {
				if (strlen(utf8_decode($value['description'])) == 0) $this->request->post['black_list_description'][$language_id]['description'] = $desc;
			}
		}


		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function validateDelete() {

		if (!$this->user->hasPermission('modify', 'catalog/black_list')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>