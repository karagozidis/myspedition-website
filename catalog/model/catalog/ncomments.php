<?php
class ModelCatalogNcomments extends Model {		
	public function addComment($news_id, $data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "ncomments SET author = '" . $this->db->escape($data['name']) . "', news_id = '" . (int)$news_id . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', date_added = NOW()");
	}
		
	public function getCommentsByNewsId($news_id, $start = 0, $limit = 20) {
	    if ($start < 0) {
			$start = 0;
		}
		
		if ($limit < 1) {
			$limit = 20;
		}
		$query = $this->db->query("SELECT n.ncomment_id, n.author, n.text, b.news_id, bd.title, n.date_added FROM " . DB_PREFIX . "ncomments n LEFT JOIN " . DB_PREFIX . "news b ON (n.news_id = b.news_id) LEFT JOIN " . DB_PREFIX . "news_description bd ON (b.news_id = bd.news_id) WHERE b.news_id = '" . (int)$news_id . "' AND b.status  = '1' AND n.status = '1' AND bd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY n.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);
		
		return $query->rows;
	}
	
		
	
	public function getTotalComments() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "ncomments n LEFT JOIN " . DB_PREFIX . "news b ON (n.newa_id = b.news_id) WHERE b.status = '1' AND n.status = '1'");
		
		return $query->row['total'];
	}

	public function getTotalNcommentsByNewsId($news_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "ncomments n LEFT JOIN " . DB_PREFIX . "news b ON (n.news_id = b.news_id) LEFT JOIN " . DB_PREFIX . "news_description bd ON (b.news_id = bd.news_id) WHERE b.news_id = '" . (int)$news_id . "' AND b.status = '1' AND n.status = '1' AND bd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row['total'];
	}
}
?>