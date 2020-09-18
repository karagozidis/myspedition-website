<?php  
class ControllerModuleCalendar extends Controller {
	protected function index() {
		$this->language->load('module/account');
		
    	               
                $this->data['monthNames']
                        = Array("January", "February", "March", "April", "May", "June", "July", 
                    "August", "September", "October", "November", "December"); 

                // $this->data["month"] = date("n");
                // $this->data["year"] = date("Y");
                 
                if ( isset($this->request->get['month']) )
                    {
                     $cMonth = $this->request->get['month'];
                    }
                else
                    {
                     $cMonth = date("n");
                    }
                
               if ( isset($this->request->get['year']) )
                    {
                     $cYear = $this->request->get['year'];
                    }
                else
                    {
                     $cYear = date("Y");
                    }
               
              
                    
                    
                
                $prev_year = $cYear;
                $next_year = $cYear;
                $prev_month = $cMonth-1;
                $next_month = $cMonth+1;

                if ($prev_month == 0 ) 
                    {
                    $prev_month = 12;
                    $prev_year = $cYear - 1;
                    }
                if ($next_month == 13 ) 
                    {
                    $next_month = 1;
                    $next_year = $cYear + 1;
                    }
  
                 $this->data["cMonth"] =$cMonth;        
                 $this->data["cYear"] =$cYear;      
                        
                 $this->data["prev_year"] =$prev_year;        
                 $this->data["next_year"] =$next_year; 
                 $this->data["prev_month"] =$prev_month;        
                 $this->data["next_month"] =$next_month; 
                 
                 $this->data["prev_url"] =  $this->url->link('account/account',"&month=".$prev_month."&year=".$prev_year, 'SSL');
                 $this->data["next_url"] =  $this->url->link('account/account',"&month=".$next_month."&year=".$next_year, 'SSL');
                
                 $this->load->model('catalog/freight');
                 $this->load->model('account/calendar_node');
                 
                 $data= array();
                 $data['month'] = $cMonth;
                 $data['year'] = $cYear;
               
                 $this->data['ftDays'] = $this->model_catalog_freight->getTotalGroupByDay($data);
                 $this->data['nodeDays'] = $this->model_account_calendar_node->getTotalNodesGroupByDay($data);
                 
                 
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/calendar.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/calendar.tpl';
		} else {
			$this->template = 'default/template/module/calendar.tpl';
		}
		
		$this->render();
	}
        
        public function loadMonth() {
		$json = array();
		$this->load->model('account/calendar_node');
                $this->load->model('catalog/freight');
                $ftDays = $this->model_catalog_freight->getTotalGroupByDay($this->request->get);
                $nodeDays = $this->model_account_calendar_node->getTotalNodesGroupByDay($this->request->get);

                
                $str = "";
                        
                $str .=  "<table style='Margin-right: auto;margin-left: auto;' border='0' cellpadding='2' cellspacing='2'>";
                $str .=  " <tr> ";
                $str .=  "  <td align='center' bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>S</strong></td>";
                $str .=  "    <td align='center' bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>M</strong></td>";
                $str .=  "    <td align='center' bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>T</strong></td>";
                $str .=  "    <td align='center' bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>W</strong></td>";
                $str .=  "    <td align='center' bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>T</strong></td>";
                $str .=  "    <td align='center' bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>F</strong></td>";
                $str .=  "    <td align='center' bgcolor='#999999' style='color:#FFFFFF;border: 1px #577EB8 solid;'><strong>S</strong></td>";
                $str .=  " </tr> ";
                
		$timestamp = mktime(0,0,0, (int)$this->request->get['month'] ,1,(int) $this->request->get['year'] );
                $maxday = date("t",$timestamp);
                //echo $maxday. " ";

                $thismonth = getdate ($timestamp);
                $startday = $thismonth['wday'];
                
                for ($i=0; $i<($maxday+$startday); $i++) {
                    if(($i % 7) == 0 )
                        {
                        $str .= "<tr>";
                        }
                        
                    if($i < $startday)
                        {
                        $str .= "<td></td>";
                        }
                    else 
                        {
                        $str .= "<td id='td_id_".($i - $startday + 1)."' align='center' valign='middle' height='20px'>";
                        $str .= "<div id='a_id_".($i - $startday + 1)."' >";
                        $str .= ($i - $startday + 1) ;
                        $str .= "</div id='a_id_end_".($i - $startday + 1)."' >";
                        $str .= "</td>";
                        }
                    if(($i % 7) == 6 )
                        {
                        $str .= "</tr>";
                        }
                }
                     
                
                 $str .=  " <tr>";
                    $str .=  "  <td>";
                       $str .=  "   <div style='background-color: #E0E0E0;border: 1px solid #BBDF8D;-webkit-border-radius: 5px 5px 5px 5px;'>";
                       $str .=  "   <a href='?route=product/calendar&month=".$this->request->get['month']."&year=".$this->request->get['year']."'>";
                       $str .=  "       <img src='image/zoom.png' width='17'> ";
                      $str .=  "    </a> ";
                      $str .=  "    </div> ";
                    $str .=  "  </td> ";
                    $str .=  "<td><div id='loading_area'></div></td>";
                $str .=  "  </tr> ";
                
                
                
                $str .=  " </table> ";
                
                foreach ($ftDays as $day)
                {
                   $str = str_replace("td_id_".$day['DAYS']."'" , "td__id_".$day['DAYS']."' style='border: 1px #0C99E9 solid;' " , $str); 
                   
                   $str = str_replace("<div id='a_id_".$day['DAYS']."' >" , "<a href='?route=product/calendar/nodelist&year=".$this->request->get['year']."&month=".$this->request->get['month']."&day=".$day['DAYS']."' > " , $str); 
                   
                   $str = str_replace("<div id='a_id_end_".$day['DAYS']."' >" , "</a>  " , $str); 
                    
                }
                
                foreach ($nodeDays as $day)
                {
                   $str = str_replace("td_id_".$day['DAYS']."'" , "td__id_".$day['DAYS']."' style='border: 1px #75DF2F solid;' " , $str); 
                   
                   $str = str_replace("<div id='a_id_".$day['DAYS']."' >" , "<a href='?route=product/calendar/nodelist&year=".$this->request->get['year']."&month=".$this->request->get['month']."&day=".$day['DAYS']."' > " , $str); 
                   
                   $str = str_replace("<div id='a_id_end_".$day['DAYS']."' >" , "</a>  " , $str); 
                    
                }
                
                
                
                $json['result'] = $str ;
                

		$this->response->setOutput(json_encode($json));
	}
    
        
        
        
        
}
?>