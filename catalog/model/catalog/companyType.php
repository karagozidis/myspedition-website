<?php    class ModelCatalogCompanyType extends Model {	public function getCompanyType($company_type_id) {		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company_type WHERE company_type_id = '" . (int)$company_type_id . "' AND status = '1'");				return $query->row;            }			public function getCompanyTypes() {					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company_type WHERE status = '1' ORDER BY " . DB_PREFIX . "company_type.order ASC");				return $query->rows;			            }}?>