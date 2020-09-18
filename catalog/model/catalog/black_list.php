<?php
class ModelCatalogBlacklist extends Model {
	public function getBlack_list($black_list_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "black_list t LEFT JOIN " . DB_PREFIX . "black_list_description td ON (t.black_list_id = td.black_list_id) WHERE t.black_list_id = '" . (int)$black_list_id . "' AND td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t.status = '1'");
	
		return $query->rows;
	}
	
	public function getBlack_lists($start = 0, $limit = 20, $random = false,$data = null ) {
		//if ($random == false)
            
                  $sql = "";

                  $sql =   " SELECT t.* FROM " . DB_PREFIX . "black_list t ";
                  //  " LEFT JOIN " . DB_PREFIX . "black_list_description td ". 
                  //  " ON (t.black_list_id = td.black_list_id) ".
                  //  " WHERE td.language_id = '" . (int)$this->config->get('config_language_id') . "' ".
                  

                  $connector = " WHERE ";
                  
                  if ($data['filter_company'] != NULL || $data['filter_country_id'] != NULL )
                   {
                        $sql .= " LEFT JOIN " . DB_PREFIX . "customer c ". 
                            " ON (t.to_customer_id = c.customer_id) ";
                   }
                       
                       
                  if ($data['filter_company'] != NULL)
                  {
                      $sql .=  $connector. " c.company LIKE '" . $data['filter_company'] . "%' ";
                    $connector = " AND ";
                  }
                  
                  if ($data['filter_country_id'] != NULL)
                  {
                   
                    $sql .=   
                       $connector. " c.country_id = " . $data['filter_country_id'] . " ";
                    $connector = " AND ";
                  }
                  
                  
                  $sql .=  $connector. " t.status = '1' ". 
                    " ORDER BY t.date_added DESC ".
                    " LIMIT " . (int)$start . "," . (int)$limit
                    ;

                $query = $this->db->query($sql);
                  
		return $query->rows;
	}
	
	public function getTotalBlack_lists($filter_company = NULL) {
   
                  $sql = " SELECT COUNT(*) AS total FROM " . DB_PREFIX . "black_list t " ;
		
                  $connector = " WHERE ";
                  if ($filter_company != NULL)
                  {
                      $sql .=     " LEFT JOIN " . DB_PREFIX . "customer c ". 
                    " ON (t.to_customer_id = c.customer_id) ".
                    " WHERE c.company LIKE '" . $filter_company . "%' ";
                      
                    $connector = " AND ";
                  }
  
                  $sql .= $connector . " t.status = '1'";
                  
                $query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	
	public function addBlack_list($data, $status) {
		$this->db->query(
                        
                        " INSERT INTO " . DB_PREFIX . "black_list SET ".
                        " status = '".$status."', ".
                      //  " rating = '".$this->db->escape($data['rating'])."', ".
                      //  " name='".$this->db->escape($data['name'])."', ".
                      //  " city = '".$this->db->escape($data['city'])."', ".
                      //  " email='".$this->db->escape($data['email'])."', ".
                        " title='". $this->db->escape($data['title'])."', ".
                        " description='". $this->db->escape($data['description'])."', ".
                        " from_customer_id='". $this->customer->getId()."', ".
                        " to_customer_id='". (int)$data['customer_id']."', ".
                        " date_added = NOW()"
                        
                        );

		//$black_list_id = $this->db->getLastId(); 
		
		//$results = $this->db->query("SELECT * FROM " . DB_PREFIX . "language ORDER BY sort_order, name"); 

		//foreach ($results->rows as $result) {
		//		$this->db->query("INSERT INTO " . DB_PREFIX . "black_list_description SET black_list_id = '" . (int)$black_list_id . "', language_id = '".(int)$result['language_id']."', title = '" . $this->db->escape($data['title']) . "', description = '" . $this->db->escape($data['description']) . "'");
		//}		
	}
}
?>