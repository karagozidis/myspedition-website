<?php
class ModelCatalogFreightPaymentMethod extends Model {
	public function getPaymentMethod($payment_method_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_payment_method WHERE payment_method_id = '" . (int)$payment_method_id . "' AND status = '1'");
		
		return $query->row;
            }	
	
	public function getPaymentMethods() {		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "freight_payment_method WHERE status = '1' ORDER BY name ASC");
	
			return $query->rows;			
            }
}
?>