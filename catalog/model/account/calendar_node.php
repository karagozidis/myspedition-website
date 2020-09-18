<?php
class ModelAccountCalendarnode extends Model {
    
	public function addNode($data) 
            {
            $this->db->query(
                    "INSERT INTO " . DB_PREFIX . "calendar_node SET " .
                    " title = '" . $this->db->escape($data['title']) . 
                    "', description = '" . $this->db->escape($data['description']) . 
                    "', date_refers = '" . $this->db->escape($data['date_refers']) . 
                    "', customer_id = '" . $this->customer->getId() . 
                    "', date_added = NOW()"
                    );
            }

	public function editNode($calendar_node_id, $data) 
            {
            $this->db->query(
                    " UPDATE " . DB_PREFIX . "calendar_node SET ".
                    " title = '" . $this->db->escape($data['title']) . 
                    "', description = '" . $this->db->escape($data['description']) . 
                    "', date_refers = '" . $this->db->escape($data['date_refers']) . 
                    "' WHERE calendar_node_id = '" . (int)$calendar_node_id . "'"
                    );  
            }
            
        public function deleteNode($calendar_node_id) 
            {
            $this->db->query(
                    " DELETE FROM " . DB_PREFIX . "calendar_node ".
                    " WHERE calendar_node_id = '" . (int)$calendar_node_id . "' " .
                    " AND customer_id = '". $this->customer->getId() ."'"
                    );  
            }
            
	public function getNodes($data = array()) 
            {
            
            $sql = " SELECT * , DAY(cn.date_refers) AS day_refers FROM " . DB_PREFIX . "calendar_node cn ".
                   " WHERE customer_id ='" . $this->customer->getId() . "'  ";

            if (!empty($data['filter_month'])) {
                    $sql .= " AND MONTH(date_refers) = '" .$data['filter_month'] . "' ";
            }
            
            if (!empty($data['filter_year'])) {
                    //$sql .= " AND DATE_FORMAT(date_refers,'%y') = '" .$data['filter_year'] . "' ";
                    $sql .= " AND YEAR(date_refers) = '" .$data['filter_year'] . "' ";
            }
            
            if (!empty($data['filter_day'])) {
                    $sql .= " AND DAY(date_refers) = '" .$data['filter_day'] . "' ";
            }
            
            //echo $sql;
            $query = $this->db->query($sql);

            return $query->rows;	
                
            }
            
	public function   getTotalNodes($data = array()) 
            {
            
            $sql = " SELECT COUNT(*) AS total  FROM " . DB_PREFIX . "calendar_node cn ".
                   " WHERE customer_id ='" . $this->customer->getId() . "'  ";

            if (!empty($data['filter_month'])) {
                    $sql .= "AND MONTH(date_refers) = '" .$data['filter_month'] . "'";
            }
            
            if (!empty($data['filter_year'])) {
                    $sql .= " AND YEAR(date_refers) = '" .$data['filter_year'] . "' ";
            }
            
            if (!empty($data['filter_day'])) {
                    $sql .= " AND DAY(date_refers) = '" .$data['filter_day'] . "' ";
            }
            
            $query = $this->db->query($sql);

            return $query->row['total'];	
                
            }
            
	public function getNode($node_id) 
            {	
            $query = $this->db->query(
                 " SELECT DISTINCT * , DAY(date_refers) AS day_refers ,"
               . " MONTH(date_refers) AS month_refers  ,"
               . " YEAR(date_refers) AS year_refers  "
               . "  FROM " . DB_PREFIX . "calendar_node WHERE customer_id = '" . (int) $this->customer->getId() . "'"
                ." AND calendar_node_id = '".(int)$node_id. "' "
                );

            return $query->row;      
            }
            
            
            
        public function getTotalNodesGroupByDay($data = array())
            {
             $query = $this->db->query(
                " SELECT DAY( date_refers ) AS DAYS ".
                " FROM oc_calendar_node ".
                " WHERE MONTH( date_refers ) =".$data['month'].
                " AND YEAR( date_refers ) =".$data['year'].
                " AND customer_id= ".$this->customer->getId().
                " GROUP BY DAY( date_refers ) "       
                );

            return $query->rows; 
            }
	
}
?>