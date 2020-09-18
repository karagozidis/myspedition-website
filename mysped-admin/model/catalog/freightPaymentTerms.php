<?php
class ModelCatalogFreightPaymentTerms extends Model {
	public function getPaymentTerm($payment_terms_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_payment_terms WHERE payment_terms_id = '" . (int)$payment_terms_id . "' AND status = '1'");
		
		return $query->row;
            }	
	
	public function getPaymentTerms() {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_payment_terms WHERE status = '1' ORDER BY name ASC");
	
			return $query->rows;			
            }
}
?>