<?php
class ModelReportOnline extends Model {
	public function getCustomersOnline($data = array()) { 
		$sql = "SELECT co.ip, co.customer_id, co.url, co.referer, co.date_added FROM " . DB_PREFIX . "customer_online co LEFT JOIN " . DB_PREFIX . "customer c ON (co.customer_id = c.customer_id)";

		$implode = array();	

		if (isset($data['filter_ip']) && !is_null($data['filter_ip'])) {
			$implode[] = "co.ip LIKE '" . $this->db->escape($data['filter_ip']) . "'";
		}

		if (isset($data['filter_customer']) && !is_null($data['filter_customer'])) {
			$implode[] = "co.customer_id > 0 AND CONCAT(c.firstname, ' ', c.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "'";
		}

		if (isset($data['filter_customer_id']) && !is_null($data['filter_customer_id'])) {
			$implode[] = " co.customer_id = '" . $data['filter_customer_id'] . "'";
		}
               
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$sql .= " ORDER BY co.date_added DESC";	

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}



	public function getTotalCustomersOnline($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_online` co LEFT JOIN " . DB_PREFIX . "customer c ON (co.customer_id = c.customer_id)";
		
		$implode = array();
		
		if (isset($data['filter_ip']) && !is_null($data['filter_ip'])) {
			$implode[] = "co.ip LIKE '" . $this->db->escape($data['filter_ip']) . "'";
		}

		if (isset($data['filter_customer']) && !is_null($data['filter_customer'])) {
			$implode[] = "co.customer_id > 0 AND CONCAT(c.firstname, ' ', c.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "'";
		}

		if (isset($data['filter_customer_id']) && !is_null($data['filter_customer_id'])) {
			$implode[] = " co.customer_id = '" . $data['filter_customer_id'] . "'";
		}
                
                $implode[] = " TIME_TO_SEC(TIMEDIFF(NOW(),co.date_updated)) < 30 "; 
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);
		return $query->row['total'];
	}

        public function updateDate() {
			$this->db->query(" UPDATE `" . DB_PREFIX . "customer_online` co SET date_updated = SYSDATE() ".
                "WHERE co.customer_id = '".$this->customer->getId()."' ");
	}
        
}
?>