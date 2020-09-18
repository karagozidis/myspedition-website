<?php
class ModelCatalogFreightLoadingType extends Model {
	public function getLoadingType($loading_type_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_loading_type ".
                        " WHERE loading_type_id = '" . (int)$loading_type_id . 
                        "' AND status = '1' ".
                        " ORDER BY sort_order "
                        );
		             
		return $query->row;
            }	
	
	public function getLoadingTypes() {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_loading_type ".
                                " WHERE status = '1' ".
                                " ORDER BY sort_order ");
	
			return $query->rows;			
            }
}
?>