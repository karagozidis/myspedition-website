<?php
class ModelSaleCompanyType extends Model {
	public function getCompanyType($company_type_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company_type WHERE company_type_id = '" . (int)$company_type_id . "' AND status = '1'");
		
		return $query->row;
            }	
	
	public function getCompanyTypes() {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company_type WHERE status = '1' ORDER BY name ASC");
	
			return $query->rows;			
            }
}
?>