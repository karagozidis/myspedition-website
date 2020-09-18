<?php
class ModelDesignBanner extends Model {
	public function addBanner($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "banner SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "'");
	
		$banner_id = $this->db->getLastId();
	
		if (isset($data['banner_image'])) {
			foreach ($data['banner_image'] as $banner_image) {
// BOF - Zappo - Banner Language - ONE LINE - Added Language for Banner Images
				$this->db->query("INSERT INTO " . DB_PREFIX . "banner_image SET banner_id = '" . (int)$banner_id . "'");
				
				$banner_image_id = $this->db->getLastId();
				
// BOF - Zappo - Banner Language - TWO LINES - Added Language for Banner Images
				foreach ($banner_image as $language_id => $banner_image_description) {				
					$this->db->query("INSERT INTO " . DB_PREFIX . "banner_image_description SET banner_image_id = '" . (int)$banner_image_id . "', language_id = '" . (int)$language_id . "', banner_id = '" . (int)$banner_id . "', title = '" .  $this->db->escape($banner_image_description['title']) . "', link = '" .  $this->db->escape($banner_image_description['link']) . "', image = '" .  $this->db->escape($banner_image_description['image']) . "'");
				}
			}
		}		
	}
	
	public function editBanner($banner_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "banner SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "' WHERE banner_id = '" . (int)$banner_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_image WHERE banner_id = '" . (int)$banner_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_image_description WHERE banner_id = '" . (int)$banner_id . "'");
			
		if (isset($data['banner_image'])) {
			foreach ($data['banner_image'] as $banner_image) {
// BOF - Zappo - Banner Language - ONE LINE - Added Language for Banner Images
				$this->db->query("INSERT INTO " . DB_PREFIX . "banner_image SET banner_id = '" . (int)$banner_id . "'");
				
				$banner_image_id = $this->db->getLastId();
				
// BOF - Zappo - Banner Language - TWO LINES - Added Language for Banner Images
				foreach ($banner_image as $language_id => $banner_image_description) {				
					$this->db->query("INSERT INTO " . DB_PREFIX . "banner_image_description SET banner_image_id = '" . (int)$banner_image_id . "', language_id = '" . (int)$language_id . "', banner_id = '" . (int)$banner_id . "', title = '" .  $this->db->escape($banner_image_description['title']) . "', link = '" .  $this->db->escape($banner_image_description['link']) . "', image = '" .  $this->db->escape($banner_image_description['image']) . "'");
				}
			}
		}			
	}
	
	public function deleteBanner($banner_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "banner WHERE banner_id = '" . (int)$banner_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_image WHERE banner_id = '" . (int)$banner_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_image_description WHERE banner_id = '" . (int)$banner_id . "'");
	}
	
	public function getBanner($banner_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "banner WHERE banner_id = '" . (int)$banner_id . "'");
		
		return $query->row;
	}
		
	public function getBanners($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "banner";
		
		$sort_data = array(
			'name',
			'status'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY name";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}					

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}		
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
		
	public function getBannerImages($banner_id) {
		$banner_image_data = array();
		
		$banner_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image WHERE banner_id = '" . (int)$banner_id . "'");
		
		foreach ($banner_image_query->rows as $banner_image) {
			$banner_image_description_data = array();
			 
			$banner_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image_description WHERE banner_image_id = '" . (int)$banner_image['banner_image_id'] . "' AND banner_id = '" . (int)$banner_id . "'");
			
// BOF - Zappo - Banner Language - Added Language for Banner Images
			if (!isset($banner_image_description_query->row['image']) || isset($banner_image['image'])) {
				$this->install();
				return false;
			}
			foreach ($banner_image_description_query->rows as $banner_image_description) {			
				$banner_image_description_data[$banner_image_description['language_id']] = array('title' => $banner_image_description['title'], 'link' => $banner_image_description['link'], 'image' => $banner_image_description['image']);
			}
		
			$banner_image_data[] =  $banner_image_description_data;
		}
		
		return $banner_image_data;
// EOF - Zappo - Banner Language - Added Language for Banner Images
	}
		
// BOF - Zappo - Banner Language - Check if Banner Image Language is (Correctly-) Installed
public function install() {
		$set_l = $set_i = $lang_id = false;
		$QryCheck = $this->db->query("SHOW TABLES");
		foreach ($QryCheck->rows as $Field) $Fields[] = $Field['Tables_in_'.DB_DATABASE]; // Build array of all table columns
		if (!in_array(DB_PREFIX . 'banner_image_description', $Fields)) {
			$this->db->query("CREATE TABLE " . DB_PREFIX . "banner_image_description (`banner_image_id` int(11) NOT NULL,`language_id` int(11) NOT NULL, `banner_id` int(11) NOT NULL, `title` varchar(64) COLLATE utf8_bin NOT NULL, PRIMARY KEY (`banner_image_id`,`language_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		}
		$banner_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner");
		foreach ($banner_query->rows as $banner) {
			$ban = $banner['banner_id'];
			$banner_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image WHERE banner_id = '" . (int)$ban . "'");
			foreach ($banner_image_query->rows as $banner_image) {
				$banner_images = $banner_image;
				$data = array();
				$banner_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image_description WHERE banner_image_id = '" . (int)$banner_image['banner_image_id'] . "' AND banner_id = '" . (int)$ban . "'");
				foreach ($banner_image_description_query->rows as $banner_image_description) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "banner_image_description WHERE banner_image_id = '" . (int)$banner_image['banner_image_id'] . "' AND banner_id = '" . (int)$ban . "'");
					$data[$banner_image_description['language_id']] = array('title' => $banner_image_description['title']);
					$link = $image = '';
					if (isset($banner_image['link'])) $link = $banner_image['link'];
					elseif (isset($banner_image_description['link'])) $link = $banner_image_description['link'];
					$data[$banner_image_description['language_id']]['link'] = $link;
					if (isset($banner_image['image'])) $image = $banner_image['image'];
					elseif (isset($banner_image_description['image'])) $image = $banner_image_description['image'];
					$data[$banner_image_description['language_id']]['image'] = $image;
					$lang_id = $banner_image_description['language_id'];
					if (!isset($banner_image_description['link']) && !$set_l) {
						$this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image_description ADD `link` varchar(255) COLLATE utf8_bin NOT NULL");
						$set_l = true;
					}
					if (!isset($banner_image_description['image']) && !$set_i) {
						$this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image_description ADD `image` varchar(255) COLLATE utf8_bin NOT NULL");
						$set_i = true;
					}
				}
				if (!$data && isset($banner_image['lanuage_id']) && isset($banner_image['title']) && isset($banner_image['link']) && isset($banner_image['image'])) {
					$data[$banner_image['language_id']] = array('title' => $banner_image['title'], 'link' => $banner_image['link'], 'image' => $banner_image['image']);
					$lang_id = $banner_image['language_id'];
				}
				if ($data) {
					$language_query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language");
					foreach ($language_query->rows as $language) if (!isset($data[$language['language_id']])) $data[$language['language_id']] = $data[$lang_id];
					foreach ($data as $language_id => $banner_data) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "banner_image_description SET banner_image_id = '" . (int)$banner_image['banner_image_id'] . "', language_id = '" . (int)$language_id . "', banner_id = '" . (int)$ban . "', title = '" .  $this->db->escape($banner_data['title']) . "', link = '" .  $this->db->escape($banner_data['link']) . "', image = '" .  $this->db->escape($banner_data['image']) . "'");
					}
				}
			}
		}
		if (!$banner_query->num_rows) {
			$QryCheck = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "banner_image_description");
			foreach ($QryCheck->rows as $Field) $Fields[] = $Field['Field']; // Build array of all table columns
			if(!in_array('image', $Fields)) { // Database entry not found...
				$this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image_description ADD `image` varchar(255) COLLATE utf8_bin NOT NULL");
				$banner_images['image'] = 1;
			}
			if(!in_array('link', $Fields)) { // Database entry not found...
				$this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image_description ADD `link` varchar(255) COLLATE utf8_bin NOT NULL");
				$banner_images['link'] = 1;
			}
		}
		if (isset($banner_images['title'])) $this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image DROP `title`");
		if (isset($banner_images['language_id'])) $this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image DROP `language_id`");
		if (isset($banner_images['link'])) $this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image DROP `link`");
		if (isset($banner_images['image'])) $this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image DROP `image`");
	}
// EOF - Zappo - Banner Language - Check if Banner Image Language is (Correctly-) Installed
// BOF - Zappo - Banner Language - Un-Install Banner Image Language
	public function uninstall() {
		$set_l = $set_i = false;
		$banner_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner");
		foreach ($banner_query->rows as $banner) {
			$ban = $banner['banner_id'];
			$banner_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image WHERE banner_id = '" . (int)$ban . "'");
			if (!isset($banner_image_query->row['link']) && !$set_l) {
				$this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image  ADD `link` varchar(255) COLLATE utf8_bin NOT NULL");
				$set_l = true;
			} if (!isset($banner_image_query->row['image']) && !$set_i) {
				$this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image  ADD `image` varchar(255) COLLATE utf8_bin NOT NULL");
				$set_i = true;
			}
			foreach ($banner_image_query->rows as $banner_image) {
				$data = array('banner_image_description' => array());
				$banner_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image_description WHERE banner_image_id = '" . (int)$banner_image['banner_image_id'] . "' AND banner_id = '" . (int)$ban . "'");
				foreach ($banner_image_description_query->rows as $banner_image_description) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "banner_image_description WHERE banner_image_id = '" . (int)$banner_image['banner_image_id'] . "' AND banner_id = '" . (int)$ban . "'");
					$data['banner_image_description'][$banner_image_description['language_id']] = array('title' => $banner_image_description['title']);
					$data['link'] = $data['image'] = '';
					if (isset($banner_image['link']) && $banner_image['link']) $data['link'] = $banner_image['link'];
					elseif (isset($banner_image_description['link'])) $data['link'] = $banner_image_description['link'];
					if (isset($banner_image['image']) && $banner_image['image']) $data['image'] = $banner_image['image'];
					elseif (isset($banner_image_description['image'])) $data['image'] = $banner_image_description['image'];
				}
				if ($data) {
					$this->db->query("UPDATE " . DB_PREFIX . "banner_image SET link = '" .  $this->db->escape($data['link']) . "', image = '" .  $this->db->escape($data['image']) . "' WHERE banner_image_id = '" . (int)$banner_image['banner_image_id'] . "' AND banner_id = '" . (int)$ban . "'");
					foreach ($data['banner_image_description'] as $language_id => $banner_data) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "banner_image_description SET banner_image_id = '" . (int)$banner_image['banner_image_id'] . "', language_id = '" . (int)$language_id . "', banner_id = '" . (int)$ban . "', title = '" .  $this->db->escape($banner_data['title']) . "'");
					}
				}
			}
		}
		if (!isset($banner_image_description)) {
			$banner_image_description = array();
			$QryCheck = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "banner_image");
			foreach ($QryCheck->rows as $Field) $Fields[] = $Field['Field']; // Build array of all table columns
			if(!in_array('image', $Fields)) { // Database entry not found...
				$this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image  ADD `image` varchar(255) COLLATE utf8_bin NOT NULL");
				$banner_image_description['image'] = 1;
			}
			if(!in_array('link', $Fields)) { // Database entry not found...
				$this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image  ADD `link` varchar(255) COLLATE utf8_bin NOT NULL");
				$banner_image_description['link'] = 1;
			}
		}
		if (isset($banner_image_description['link'])) $this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image_description DROP `link`");
		if (isset($banner_image_description['image'])) $this->db->query("ALTER TABLE " . DB_PREFIX . "banner_image_description DROP `image`");
	}
// EOF - Zappo - Banner Language - Un-Install Banner Image Language

	public function getTotalBanners() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "banner");
		
		return $query->row['total'];
	}	
}
?>