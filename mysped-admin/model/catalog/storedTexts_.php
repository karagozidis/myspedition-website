<?php
class ModelCatalogStoredTexts extends Model {
    
    
        public function addStoredTexts($name,$datas) { 
        //foreach($datas as $data)
        foreach ($datas['description'] as $language_id => $value) 
            {    
            $sqlQuery = "   INSERT INTO " . DB_PREFIX . "stored_mails SET " .
                    "   name = '" . $name . 
                    "', text = '" . $value['description'].
                    "', language_id = " . $language_id ;
                  
            $this->db->query($sqlQuery);
            }  
	}
    
    	public function editStoredTexts($name,$datas) {  
          $this->deleteStoredTexts($name);
          $this->addStoredTexts($name,$datas);
	}
    
        
    	public function getStoredTexts($name) {
		$query = $this->db->query(
                        " SELECT * FROM " . DB_PREFIX . "stored_mails " . 
                        " WHERE name = '" . $name . "'" ) ;
                  
		return $query->rows;
	}
    
        public function getStoredText($name) {
		$query = $this->db->query(
                        " SELECT * FROM " . DB_PREFIX . "stored_mails " . 
                        " WHERE name = '" . $name . "'" ) ;
                  
		return $query->row;
	}
        
    
        public function deleteStoredTexts($name) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "stored_mails WHERE name = '" . (int)$name . "'");
	}
        
}
?>
