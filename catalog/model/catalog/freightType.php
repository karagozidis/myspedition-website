<?php
class ModelCatalogFreightType extends Model {
	public function getFreight($freight_type_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_type WHERE freight_type_id = '" . (int)$freight_type_id . "' AND status = '1'");
		
		return $query->row;
            }	
	
	public function getFreights() {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_type WHERE status = '1' ORDER BY  oc_freight_type.order ASC");
	
			return $query->rows;			
            }
}
?>