<?php
class ControllerModuleNews extends Controller {
	protected function index($setting) {
		$this->language->load('module/news');
		
		$this->data['text_read_more'] = $this->language->get('text_read_more');
		
		$this->load->model('catalog/news');
		
		$this->load->model('catalog/ncomments');
		
		$this->load->model('catalog/ncategory');
		
		$this->load->model('tool/image'); 
		
		if ($setting['ncategory_id'] == 'all') {
    	$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['newslink'] = $this->url->link('news/headlines');
		} else {
		$ncategory_info = $this->model_catalog_ncategory->getncategory($setting['ncategory_id']);
		$this->data['heading_title'] = $ncategory_info['name'];
		$this->data['newslink'] = $this->url->link('news/ncategory', 'ncat=' . $setting['ncategory_id']);
		}
		
    	$this->data['text_headlines'] = $this->language->get('text_headlines');
		
		$this->data['text_comments'] = $this->language->get('text_comments');	
		
		$this->data['news'] = array();
		if ($setting['ncategory_id'] == 'all') {
		$results = $this->model_catalog_news->getNewsTop5($setting['news_limit']);	
		} else {	
		$data = array(
			    'filter_ncategory_id' => $setting['ncategory_id'],
				'start'               => 0,
				'limit'               => $setting['news_limit']
			);
		
		$results = $this->model_catalog_news->getNewsLimited($data);	
		}
		if ($this->config->get('bnews_image_width')) {
            $bwidth = $this->config->get('bnews_image_width');
			} else {
			$bwidth = 80;
		}
			
		if ($this->config->get('bnews_image_height')) {
            $bheight = $this->config->get('bnews_image_height');
			} else {
			$bheight = 80;
		}
			
		
		foreach ($results as $result) {
		        if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $bwidth, $bheight);
				} else {
					$image = false;
				}
     		$this->data['news'][] = array(
			    'title'              => $result['title'],
				'acom'               => $result['acom'],
				'thumb'              => $image,
				'short_description'  => substr(strip_tags(html_entity_decode($result['description'])),0,50),
				'short_description2' => substr(strip_tags(html_entity_decode($result['description'])),0,350),
				'total_comments'     => $this->model_catalog_ncomments->getTotalNcommentsByNewsId($result['news_id']),
				'href'               => $this->url->link('news/article', 'news_id=' . $result['news_id'])
				
     		);
    	}
		
	
	$this->id = 'news';
		
		if ($setting['position'] == 'column_left') {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news_side.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/news_side.tpl';
			} else {
				$this->template = 'default/template/module/news_side.tpl';
			}
		} else {
		if ($setting['position'] == 'column_right') {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news_side.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/news_side.tpl';
			} else {
				$this->template = 'default/template/module/news_side.tpl';
			}
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/news.tpl';
			} else {
				$this->template = 'default/template/module/news.tpl';
			}
		}
		}
		$this->render(); 
	
	}
}
?>
