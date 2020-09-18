<?php  
class ControllerModuleCompanyLogos extends Controller {
	protected function index($setting) {
		static $module = 0;
		
		//$this->load->model('design/banner');
                $this->load->model('customer/customer');
		$this->load->model('tool/image');
		
		$this->document->addScript('catalog/view/javascript/jquery/jquery.carouFredSel-6.1.0-packed.js');
		
		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/caroufredsel.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/caroufredsel.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/caroufredsel.css');
		}
						
		$this->data['limit'] = $setting['limit'];
		$this->data['scroll'] = $setting['scroll'];
		$this->data['duration'] = 1000;//$setting['duration'];
		$this->data['direction'] = "right"; //  $setting['direction'];
				
		$this->data['banners'] = array();
		
		//$results = $this->model_customer_customer->getCustomersLogoByCustomerGroup($setting['customer_group_id'] , $setting['limit'] );
		$results = $this->model_customer_customer->getCustomersLogoByCustomerGroup();
		 
		foreach ($results as $result) {
			if (file_exists(DIR_IMAGE . $result['company_logo']) && $result['company_logo'] != ""  ) {
				$this->data['banners'][] = array(
					'title' => $result['company'] ,
					'link'  =>  $this->url->link('customer/customer/update','customer_id='. $result['customer_id'] , 'SSL'), //$result['link'],
					'image' => $this->model_tool_image->resize($result['company_logo'], $setting['width'], $setting['height'])
				);
			}
		}
		
		$this->data['module'] = $module++; 
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/companyLogo.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/companyLogo.tpl';
		} else {
			$this->template = 'default/template/module/companyLogo.tpl';
		}
		
		$this->render(); 
	}
}
?>