<?php
class ModelCatalogTreiler extends Model {
	public function getTreiler($treiler_type_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "treiler_type WHERE treiler_type_id = '" . (int)$treiler_type_id . "' AND status = '1'");
		
		return $query->row;
            }	
	
	public function getTreilers() {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "treiler_type WHERE status = '1' ORDER BY name ASC");
	
			return $query->rows;			
            }
}
?>