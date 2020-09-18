<?php
class ModelLocalisationCountry extends Model {
	public function getCountry($country_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "' AND status = '1'");
		
		return $query->row;
	}	
	
	public function getCountries() {
		$country_data = $this->cache->get('country.status');
		
		if (!$country_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE status = '1' ORDER BY name ASC");
	
			$country_data = $query->rows;
		
			$this->cache->set('country.status', $country_data);
		}

		return $country_data;
	}
        
        public function getMarket() {
		$country_data = '';
		
                 $sql = 
                "SELECT oc_country.* ".
                    " , f_lctbl.f_lcnum AS Freights_From_Country ".
                    " , f_offlctbl.f_offlcnum AS Freights_To_Country ".
                    " , t_lctbl.t_lcnum AS Trucks_form_Country ".
                    " , t_offlctbl.t_offlcnum AS Trucks_to_Country ".

                    " , IF(f_lctbl.f_lcnum > t_lctbl.t_lcnum , ".
                    " f_lctbl.f_lcnum / t_lctbl.t_lcnum, " .
                    " t_lctbl.t_lcnum  / f_lctbl.f_lcnum ".
                    " ) as From_Diff ".

                    " , IF( f_offlctbl.f_offlcnum > t_offlctbl.t_offlcnum , f_offlctbl.f_offlcnum / t_offlctbl.t_offlcnum , " .
                    " t_offlctbl.t_offlcnum / f_offlctbl.f_offlcnum ) ".
                    " as To_Diff ".

                    " FROM ".
                    " oc_country ".

                    " LEFT JOIN ".
                      "  ( ".
                      "  SELECT loading_country_id ,Count(*) AS f_lcnum".
                      "  FROM `oc_freight`".
                      " GROUP BY loading_country_id".

                      "  ) AS f_lctbl ".
                    " ON oc_country.country_id = f_lctbl.loading_country_id ".

                    " LEFT JOIN ".
                      " ( ".
                       " SELECT offloading_country_id ,Count(*) AS f_offlcnum ".
                       " FROM `oc_freight` ".
                       " GROUP BY offloading_country_id ".

                      "  ) AS f_offlctbl ".
                    " ON oc_country.country_id = f_offlctbl.offloading_country_id ".

                    " LEFT JOIN ".
                       " ( ".
                        " SELECT loading_country_id ,Count(*) AS t_lcnum ".
                        " FROM `oc_truck` ".
                        " GROUP BY loading_country_id ".

                        " ) AS t_lctbl ".
                    " ON oc_country.country_id = t_lctbl.loading_country_id ".

                    " LEFT JOIN ".
                     "  ( ".
                     "   SELECT offloading_country_id ,Count(*) AS t_offlcnum ".
                     "   FROM `oc_truck` ".
                     "   GROUP BY offloading_country_id ".

                      "  ) AS t_offlctbl ".
                    " ON oc_country.country_id = t_offlctbl.offloading_country_id ".

                    " WHERE f_lctbl.f_lcnum != '' OR  f_offlctbl.f_offlcnum != '' ".
                    " OR t_lctbl.t_lcnum != '' OR t_offlctbl.t_offlcnum != '' " .
                    " ORDER BY  oc_country.name ".
                    " LIMIT 0 , 200 "; 
                

                    $query = $this->db->query($sql);
	
                    $country_data = $query->rows;
		
			
		return $country_data;
	}
        
               public function getTotalMarket() {
		$country_data = '';
		
                 $sql = 
                "SELECT count(*) AS total ".                

                    " FROM ".
                    " oc_country ".
                         
                    " LEFT JOIN ".
                      "  ( ".
                      "  SELECT loading_country_id ,Count(*) AS f_lcnum".
                      "  FROM `oc_freight`".
                      " GROUP BY loading_country_id".

                      "  ) AS f_lctbl ".
                    " ON oc_country.country_id = f_lctbl.loading_country_id ".

                    " LEFT JOIN ".
                      " ( ".
                       " SELECT offloading_country_id ,Count(*) AS f_offlcnum ".
                       " FROM `oc_freight` ".
                       " GROUP BY offloading_country_id ".

                      "  ) AS f_offlctbl ".
                    " ON oc_country.country_id = f_offlctbl.offloading_country_id ".

                    " LEFT JOIN ".
                       " ( ".
                        " SELECT loading_country_id ,Count(*) AS t_lcnum ".
                        " FROM `oc_truck` ".
                        " GROUP BY loading_country_id ".

                        " ) AS t_lctbl ".
                    " ON oc_country.country_id = t_lctbl.loading_country_id ".

                    " LEFT JOIN ".
                     "  ( ".
                     "   SELECT offloading_country_id ,Count(*) AS t_offlcnum ".
                     "   FROM `oc_truck` ".
                     "   GROUP BY offloading_country_id ".

                      "  ) AS t_offlctbl ".
                    " ON oc_country.country_id = t_offlctbl.offloading_country_id".

                    " WHERE f_lctbl.f_lcnum != '' OR  f_offlctbl.f_offlcnum != '' ".
                    " OR t_lctbl.t_lcnum != '' OR t_offlctbl.t_offlcnum != '' " .
                    " ORDER BY  oc_country.name"; 
                

                    $query = $this->db->query($sql);
	
                    $country_data = $query->rows;
		
			
		return $country_data;
	}
        
}
?>