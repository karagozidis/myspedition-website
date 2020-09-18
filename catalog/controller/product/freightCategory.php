<?php 
class ControllerProductFreightCategory extends Controller {  
	public function index() { 
		$this->language->load('product/freightCategory');
		
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/freight');
		
		$this->load->model('tool/image'); 
		
		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}
				
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'DATE(p.date_added),cg.priority_view';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}	
							
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}
		                               
                
                if (isset($this->request->get['search_loading_country'])) {
			$loading_country = $this->request->get['search_loading_country'];
		} else {
			$loading_country = null;
		}
                
               if (isset($this->request->get['search_loading_zone'])) {
			$loading_zone = $this->request->get['search_loading_zone'];
		} else {
			$loading_zone = null;
		}
                
                if (isset($this->request->get['search_loading_city'])) {
			$loading_city = $this->request->get['search_loading_city'];
		} else {
			$loading_city = null;
		}
                
                if (isset($this->request->get['search_offloading_country'])) {
			$offloading_country = $this->request->get['search_offloading_country'];
		} else {
			$offloading_country = null;
		}
                
                if (isset($this->request->get['search_offloading_zone'])) {
			$offloading_zone = $this->request->get['search_offloading_zone'];
		} else {
			$offloading_zone = null;
		}
                                
                if (isset($this->request->get['search_offloading_city'])) {
			$offloading_city = $this->request->get['search_offloading_city'];
		} else {
			$offloading_city = null;
		}             
                
                if (isset($this->request->get['search_loading_date_from'])) {
			$loading_date_from = $this->request->get['search_loading_date_from'];
		} else {
			$loading_date_from = null;
		}
                
                if (isset($this->request->get['search_loading_date_to'])) {
			$loading_date_to = $this->request->get['search_loading_date_to'];
		} else {
			$loading_date_to = null;
		}
                
 
                $trailer_type = array();
                if (isset($this->request->get['search_trailer_type'])) {
			$trailer_type[] = $this->request->get['search_trailer_type'];
		} 
                
                if (isset($this->request->get['search_trailer_type2'])) {
			$trailer_type[] = $this->request->get['search_trailer_type2'];
		} 
                
                if (isset($this->request->get['search_trailer_type3'])) {
			$trailer_type[] = $this->request->get['search_trailer_type3'];
		} 
                
                if (isset($this->request->get['search_trailer_type4'])) {
			$trailer_type[] = $this->request->get['search_trailer_type4'];
		} 
                
                if (isset($this->request->get['search_trailer_type5'])) {
			$trailer_type[] = $this->request->get['search_trailer_type5'];
		} 
                
                if (isset($this->request->get['search_trailer_type6'])) {
			$trailer_type[] = $this->request->get['search_trailer_type6'];
		} 
                
                if (isset($this->request->get['search_trailer_type7'])) {
			$trailer_type[] = $this->request->get['search_trailer_type7'];
		}
                
                if (isset($this->request->get['search_trailer_type8'])) {
			$trailer_type[] = $this->request->get['search_trailer_type8'];
		} 
                
                if (isset($this->request->get['search_trailer_type9'])) {
			$trailer_type[] = $this->request->get['search_trailer_type9'];
		} 
                
                if (isset($this->request->get['search_trailer_type10'])) {
			$trailer_type[] = $this->request->get['search_trailer_type10'];
		} 
                
                if (isset($this->request->get['search_trailer_type11'])) {
			$trailer_type[] = $this->request->get['search_trailer_type11'];
		} 
                
                if (isset($this->request->get['search_trailer_type12'])) {
			$trailer_type[] = $this->request->get['search_trailer_type12'];
		} 
                
                
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);
                
                $this->data['breadcrumbs'][] = array(
       		'text'      => 'Find Freights',
			'href'      => $this->url->link('', /*'token=' . $this->session->data['token']*/'', 'SSL'),
      		'separator' => ' :: '
   		);
                                
                
	  		$this->document->setTitle($this->language->get('freights_list_text'));
			$this->document->setDescription($this->language->get('freights_list_text'));
			$this->document->setKeywords($this->language->get('freights_list_text'));
			$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
			
			$this->data['heading_title'] = $this->language->get('freights_list_text');
			
                          /*******************************************************************************/
                         $this->data['trucks_list_text'] = $this->language->get('trucks_list_text');
                         $this->data['find_trucks_text'] = $this->language->get('find_trucks_text');
                         $this->data['na_text'] = $this->language->get('na_text');
                         $this->data['loading_country_text'] = $this->language->get('loading_country_text');
                         $this->data['region_state_text'] = $this->language->get('region_state_text');
                         $this->data['city_area_text'] = $this->language->get('city_area_text');
                         $this->data['offloading_country_text'] = $this->language->get('offloading_country_text');
                         $this->data['loading_date_at_text'] = $this->language->get('loading_date_at_text');
                         $this->data['date_to_text'] = $this->language->get('date_to_text');
                         $this->data['search_text'] = $this->language->get('search_text');
                         $this->data['clear_text'] = $this->language->get('clear_text');
                         $this->data['loading_date_text'] = $this->language->get('loading_date_text');
                         $this->data['trailer_text'] = $this->language->get('trailer_text');
                         $this->data['company_text'] = $this->language->get('company_text');
                         $this->data['other_text'] = $this->language->get('other_text');
                         $this->data['text_empty'] = $this->language->get('text_empty');
                         
                         $this->data['search_filters_text'] = $this->language->get('search_filters_text');
                         $this->data['compare_text'] = $this->language->get('compare_text');
                         $this->data['search_text'] = $this->language->get('search_text');
                         $this->data['clear_text'] = $this->language->get('clear_text');
                        /*******************************************************************************/
                        
                        $this->data['text_compare'] = sprintf('Compare(%s)', (isset($this->session->data['compareFreight']) ? count($this->session->data['compareFreight']) : 0));
                        
			$this->data['description'] = html_entity_decode("Freights' List"/*$category_info['description']*/, ENT_QUOTES, 'UTF-8');
			$this->data['compare'] = $this->url->link('product/compare');
			
			
			$this->data['products'] = array();
			
                         $data = array(
                                    'filter_filter'         =>    $filter, 
                                    'sort'                  =>    $sort,
                                    'order'                 =>    $order,
                                    'start'                 =>    ($page - 1) * $limit,
                                    'limit'                 =>    $limit , 
                                    'loading_country_id'    =>    $loading_country,
                                    'loading_zone_id'       =>    $loading_zone,
                                    'loading_city'          =>    $loading_city,
                                    'offloading_country_id' =>    $offloading_country,
                                    'offloading_zone_id'    =>    $offloading_zone,
                                    'offloading_city'       =>    $offloading_city,
                                    'loading_date_from'     =>    $loading_date_from,
                                    'loading_date_to'       =>    $loading_date_to,
                                    'trailer_type_id'       =>    $trailer_type
                                    ); 
                        
                        
					
			$product_total = $this->model_catalog_freight->getTotalProducts($data); 
			$results = $this->model_catalog_freight->getProducts($data);
			$this->addFreights($results);
                       
                       
                        if ($results == null && $loading_country != -1 && $offloading_country != -1 )
                            {
                            $data['loading_country_id'] = -1;
                            $results = $this->model_catalog_freight->getProducts($data);
                            $product_total = $this->model_catalog_freight->getTotalProducts($data); 
                            $this->addFreights($results);
                            
                            
                            $data['loading_country_id'] = $loading_country;
                            $data['offloading_country_id'] = -1;
                            $results = $this->model_catalog_freight->getProducts($data);
                            $product_total += $this->model_catalog_freight->getTotalProducts($data); 
                            $this->addFreights($results);
                            
                            if ($this->data['products'] != null)    $this->data['suggestions'] = true;    
                            }
                        
                       

                        $this->data['countries']  = $this->model_localisation_country->getCountries();
                                                                   
			$url = '';
			
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
				
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->data['limits'] = array();
	
			$limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));
			
			sort($limits);
	
			foreach($limits as $limits){
				$this->data['limits'][] = array(
					'text'  => $limits,
					'value' => $limits,
					'href'  => $this->url->link('product/freightCategory', $url . '&limit=' . $limits)
				);
			}
			
			$url = '';
			
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
                        
	
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
					
                        
                         
                        if (isset($this->request->get['search_loading_country'] )) {
				$url .= '&search_loading_country=' . $this->request->get['search_loading_country'];
			}                       
                        
                        if (isset($this->request->get['search_loading_zone'] )) {
				$url .= '&search_loading_zone='. $this->request->get['search_loading_zone'];
			}                      
                        
                        if (isset( $this->request->get['search_loading_city'] )) {
				$url .=  '&search_loading_city=' . $this->request->get['search_loading_city'];
			}           
                        
                        if (isset( $this->request->get['search_offloading_country'] )) {
				$url .= '&search_offloading_country=' . $this->request->get['search_offloading_country'];
			}               
                        
                        if (isset( $this->request->get['search_offloading_zone'] )) {
				$url .= '&search_offloading_zone='.$this->request->get['search_offloading_zone'];
			}                     
                        
                        if (isset( $this->request->get['search_offloading_city'] )) {
				$url .= '&search_offloading_city=' . $this->request->get['search_offloading_city'];
			} 

                        if (isset( $this->request->get['search_loading_date_from'] )) {
				$url .= '&search_loading_date_from=' . $this->request->get['search_loading_date_from'];
			}
                            
                        if (isset( $this->request->get['search_loading_date_to'] )) {
				$url .= '&search_loading_date_to=' . $this->request->get['search_loading_date_to'];
			} 
                                   
                        
                        if (isset( $this->request->get['search_trailer_type'] )) {
				$this->data['search_trailer_type'] = "checked";
			} 
                        else $this->data['search_trailer_type'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type2'] )) {
				$this->data['search_trailer_type2'] = "checked";
			} 
                        else $this->data['search_trailer_type2'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type3'] )) {
				$this->data['search_trailer_type3'] = "checked";
			} 
                        else $this->data['search_trailer_type3'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type4'] )) {
				$this->data['search_trailer_type4'] = "checked";
			} 
                        else $this->data['search_trailer_type4'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type5'] )) {
				$this->data['search_trailer_type5'] = "checked";
			} 
                        else $this->data['search_trailer_type5'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type6'] )) {
				$this->data['search_trailer_type6'] = "checked";
			} 
                        else $this->data['search_trailer_type6'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type7'] )) {
				$this->data['search_trailer_type7'] =  "checked";
			} 
                        else $this->data['search_trailer_type7'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type8'] )) {
				$this->data['search_trailer_type8'] = "checked";
			} 
                        else $this->data['search_trailer_type8'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type9'] )) {
				$this->data['search_trailer_type9'] = "checked";
			} 
                        else $this->data['search_trailer_type9'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type10'] )) {
				$this->data['search_trailer_type10'] = "checked";
			} 
                        else $this->data['search_trailer_type10'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type11'] )) {
				$this->data['search_trailer_type11'] = "checked";
			} 
                        else $this->data['search_trailer_type11'] = "";
                        
                        if (isset( $this->request->get['search_trailer_type12'] )) {
				$this->data['search_trailer_type12'] = "checked";
			}  
                        else $this->data['search_trailer_type12'] = "";
                        
                        
                        
                        if (isset($this->request->get['page'])) {
                                $pageStr = '&page=' . $this->request->get['page'];
                        }else{
                            $pageStr = '';
                        }
                        
			
                                                	/* Gia ta pedia tou pinaka start */     
                        $tmpOrder = '';
                        if ( isset( $this->request->get['sort']  ) && $this->request->get['sort'] == 'p.loading_date' )
                        {

                        if ( isset($this->request->get['order'] ) && $this->request->get['order'] == 'ASC' )  
                                {
                                $this->data['filterImage'] = "image/filter.png";
                                $curOrder = '&order=DESC' ;                               
                                }
                        else
                                {
                                $this->data['filterImage'] = "image/filter_desc.png";
                                $curOrder = '&order=ASC' ;
                                }
                        }        
                        else
                        {    
                            if ($order = 'DESC')
                            {
                                $tmpOrder = 'ASC';
                            }
                         else
                            { 
                                $tmpOrder = 'DESC';
                            }
                            
                        $curOrder = '&order='.$tmpOrder;
                        $this->data['filterImage'] = "image/filter_desc.png";
                        }
                        
                        $this->data['sort_loading_date'] = $this->url->link('product/freightCategory', $url . '&sort=p.loading_date'.$curOrder ); 
                        
                        $url .= $tmpOrder;
                        if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

                        
                        
                        
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('product/freightCategory', $url . '&page={page}');
		
			$this->data['pagination'] = $pagination->render();
		
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['limit'] = $limit;
		
                        
                       
                        if (isset($this->request->get['search_loading_country'] )) {
				$this->data['search_loading_country'] = $this->request->get['search_loading_country'];
                                $this->data['search'] = 'true';
			}
                        else $this->data['search_loading_country'] = "";
                        
                        if (isset($this->request->get['search_loading_zone'] )) {
				$this->data['search_loading_zone'] = $this->request->get['search_loading_zone'];
                                $this->data['search'] = 'true';
			}
                        else $this->data['search_loading_zone'] ="";
                        
                       if (isset( $this->request->get['search_loading_city'] )) {
				$this->data['search_loading_city'] = $this->request->get['search_loading_city'];
                                $this->data['search'] = 'true';
			}
                        else $this->data['search_loading_city'] ="";
                        
                        if (isset( $this->request->get['search_offloading_country'] )) {
				$this->data['search_offloading_country'] = $this->request->get['search_offloading_country'];
                                $this->data['search'] = 'true';
			}
                        else $this->data['search_offloading_country'] = "" ;
                        
                        if (isset( $this->request->get['search_offloading_zone'] )) {
				$this->data['search_offloading_zone'] = $this->request->get['search_offloading_zone'];
                                $this->data['search'] = 'true';
			}
                        else $this->data['search_offloading_zone'] = "";
                        
                        if (isset( $this->request->get['search_offloading_city'] )) {
				$this->data['search_offloading_city'] = $this->request->get['search_offloading_city'];
                                $this->data['search'] = 'true';
			} 
                        else $this->data['search_offloading_city'] = "";

                        if (isset( $this->request->get['search_loading_date_from'] )) {
				$this->data['search_loading_date_from'] = $this->request->get['search_loading_date_from'];
                                $this->data['search'] = 'true';
			}
                        else $this->data['search_loading_date_from'] = "";
                            
                        if (isset( $this->request->get['search_loading_date_to'] )) {
				$this->data['search_loading_date_to'] = $this->request->get['search_loading_date_to'];
                                $this->data['search'] = 'true';
			} 
                        else $this->data['search_loading_date_to'] = "";
                                   
                        if (isset( $this->request->get['search_trailer_type'] )) {
				$this->data['search_trailer_type_id'] = $this->request->get['search_trailer_type'];
                                $this->data['search'] = 'true';
			} 
                        else $this->data['search_trailer_type'] = "";
                        
                        
                        
			$this->data['continue'] = $this->url->link('common/home');

                        $this->load->model('catalog/storedTexts');
                        $this->data['companyViewText'] = $this->model_catalog_storedTexts->getStoredText('companyViewText'); 
                        
                        if ($this->customer->isLogged())
                        {   
                        
                            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/freightCategory_logged.tpl')) {
                                    $this->template = $this->config->get('config_template') . '/template/product/freightCategory_logged.tpl';
                            } else {
                                    $this->template = 'default/template/product/freightCategory_logged.tpl';
                            }
                        }
                        else 
                        {
                            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/freightCategory_general.tpl')) {
                                    $this->template = $this->config->get('config_template') . '/template/product/freightCategory_general.tpl';
                            } else {
                                    $this->template = 'default/template/product/freightCategory.tpl';
                            }
                        }
                        
                        
                        
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
				
			$this->response->setOutput($this->render());										
    	
  	}
        
      public function addFreights($results = array())
        {
           $this->load->model('localisation/country');   
          
           foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = false;
				}
				
                                $loading_country = $this->model_localisation_country->getCountry($result['loading_country_id']);
                                $offloading_country = $this->model_localisation_country->getCountry($result['offloading_country_id']);
                                
                                $this->load->model('localisation/zone');                 
                                $loading_zone = $this->model_localisation_zone->getZone( $result['loading_zone_id'] );
                                $offloading_zone = $this->model_localisation_zone->getZone( $result['offloading_zone_id'] );
                                
                                $this->load->model('catalog/treiler');             
                                $trailer = $this->model_catalog_treiler->getTreiler($result['trailer_type_id'])   ;   

                                $this->load->model('account/customer');             
                                $owner = $this->model_account_customer->getCustomerByFreight($result['freight_id'])   ;  
                                
                                if( $result['frequency'] == 1 ) $loading_date = '[Regular]';
                                else  $loading_date =  $result['loading_date'];
                                
				$this->data['products'][] = array(
					'product_id'  => $result['freight_id'],
                                        'number_of_trucks' => $result['number_of_trucks'],
                                        'est_date' => $result['est_date'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'loading_date' => $loading_date,
                                        'loading_country' => $loading_country,
                                        'loading_city' => $result['loading_city'],
                                        'offloading_country' => $offloading_country,
                                        'offloading_city' => $result['offloading_city'],
                                        'href'         => '?route=product/freight&product_id='.$result['freight_id'],
                                        'loading_zone'       =>  $loading_zone,
                                        'offloading_zone'    =>  $offloading_zone,
                                        'trailer'            =>  $trailer,
                                        'owner' => $owner
				);
			}
        }
}
?>