<?php  
class ControllerModuleCaroufredsel extends Controller {
	protected function index($setting) {
		static $module = 0;
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		$this->document->addScript('catalog/view/javascript/jquery/jquery.carouFredSel-6.1.0-packed.js');
		
		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/caroufredsel.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/caroufredsel.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/caroufredsel.css');
		}
						
		$this->data['limit'] = $setting['limit'];
		$this->data['scroll'] = $setting['scroll'];
		$this->data['duration'] = $setting['duration'];
		$this->data['direction'] = $setting['direction'];
				
		$this->data['banners'] = array();
		
		$results = $this->model_design_banner->getBanner($setting['banner_id']);
		  
		foreach ($results as $result) {
			if (file_exists(DIR_IMAGE . $result['image'])) {
				$this->data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}
		
		$this->data['module'] = $module++; 
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/caroufredsel.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/caroufredsel.tpl';
		} else {
			$this->template = 'default/template/module/caroufredsel.tpl';
		}
		
		$this->render(); 
	}
}
?>