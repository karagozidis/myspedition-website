<?php
class ControllerModulencategory extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/ncategory');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ncategory', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_bnews_image'] = $this->language->get('text_bnews_image');
		$this->data['text_bnews_thumb'] = $this->language->get('text_bnews_thumb');
		$this->data['text_bnews_order'] = $this->language->get('text_bnews_order');
		$this->data['text_bsettings'] = $this->language->get('text_bsettings');
		$this->data['text_bwidth'] = $this->language->get('text_bwidth');
		$this->data['text_bheight'] = $this->language->get('text_bheight');
		$this->data['text_yess'] = $this->language->get('text_bysort');
		$this->data['text_noo'] = $this->language->get('text_latest');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/ncategory', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/ncategory', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['bnews_order'])) {
			$this->data['bnews_order'] = $this->request->post['bnews_order'];
		} else {
			$this->data['bnews_order'] = $this->config->get('bnews_order');
		}
		if (isset($this->request->post['bnews_image_width'])) {
			$this->data['bnews_image_width'] = $this->request->post['bnews_image_width'];
		} else {
			$this->data['bnews_image_width'] = $this->config->get('bnews_image_width');
		}
		if (isset($this->request->post['bnews_image_height'])) {
			$this->data['bnews_image_height'] = $this->request->post['bnews_image_height'];
		} else {
			$this->data['bnews_image_height'] = $this->config->get('bnews_image_height');
		}
		if (isset($this->request->post['bnews_thumb_width'])) {
			$this->data['bnews_thumb_width'] = $this->request->post['bnews_thumb_width'];
		} else {
			$this->data['bnews_thumb_width'] = $this->config->get('bnews_thumb_width');
		}
		if (isset($this->request->post['bnews_thumb_height'])) {
			$this->data['bnews_thumb_height'] = $this->request->post['bnews_thumb_height'];
		} else {
			$this->data['bnews_thumb_height'] = $this->config->get('bnews_thumb_height');
		}
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['ncategory_module'])) {
			$this->data['modules'] = $this->request->post['ncategory_module'];
		} elseif ($this->config->get('ncategory_module')) { 
			$this->data['modules'] = $this->config->get('ncategory_module');
		}	
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/ncategory.tpl';
		$this->children = array(
			'common/header',
			'common/newspanel',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/ncategory')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>