<?php
class ModelToolDictionary extends Model {
	public function getKeywords() {
		$query = $this->db->query("SELECT DISTINCT keyword FROM " . DB_PREFIX . "dictionary "    
                        );
		                           
		return $query->rows;
            }	
	
	public function getTermsByKeyword($keyword) {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "dictionary ".
                                " WHERE keyword = '".$keyword. "' " );
	
			return $query->rows;			
            }
            
       	public function getTerm($dictionary_id) {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "dictionary ".
                                " WHERE dictionary_id = '".$dictionary_id. "' " );
	
			return $query->row;			
            }
            
       public function getFirstIdByKeyword($keyword) {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "dictionary ".
                                " WHERE keyword = '".$keyword. "' " );
	
			return $query->row['dictionary_id'];			
            }
}
?>