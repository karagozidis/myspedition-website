<?php
class ModelCustomerCustomerMail extends Model {
    
    public function sendFreightToCustomers($freight_id) {
        
                        $this->load->model('customer/customer');
                        $this->load->model('localisation/country');
                        $this->load->model('localisation/zone');
                        $this->load->model('catalog/freight');
                        $this->load->model('catalog/storedTexts');
                        $this->load->model('catalog/treiler');

                        $storedText = $this->model_catalog_storedTexts->getStoredText('freightsMail'); 
                        
                        //******************************************************************
                        $freight = $this->model_catalog_freight->getProduct($freight_id);
                        //******************************************************************
                        
                        $interestCountries = array();
                        
                        $interestCountries[] = $freight['loading_country_id'];
                        $interestCountries[] = $freight['offloading_country_id'];
                      
                        
                        $data = array(
				'freightsMail'        => '1',
				'trucksMail'              => '0',
				'productsMail'        => '0'	
			);
                        $customers = $this->model_customer_customer->getCustomersByInterestCountries($data,$interestCountries); 
                        
                        //******************************************************************
                        
                        $loading_country = $this->model_localisation_country->getCountry($freight['loading_country_id']);
                        $offloading_country = $this->model_localisation_country->getCountry($freight['offloading_country_id']);
                        $loading_zone = $this->model_localisation_zone->getZone($freight['loading_zone_id']);
                        $offloading_zone = $this->model_localisation_zone->getZone($freight['offloading_zone_id']);
                        $trailer_type = $this->model_catalog_treiler->getTreiler( $freight['trailer_type_id'] );
                        
                        

                        $loading_zone_name = "---";
                        if( isset($loading_zone['name']) )
                        {
                            $loading_zone_name =  $loading_zone['name'];
                        }
                        
                        $offloading_zone_name = "---";
                        if( isset($offloading_zone['name']) )
                        {
                            $offloading_zone_name =  $offloading_zone['name'];
                        }
                        
                        $loading_date= "[Regular]<br> (Every Week, Month) ";
                        if( $freight['frequency'] == 0 )
                        {
                            $loading_date =  $freight["loading_date"];
                        }
                        
                        
                       $message = '';
                        if ( isset($storedText['text']) ) $message = $storedText['text'] . "<br>";
                       // $message = $storedText['text'] . "<br>";
                        
                        $message .=          
                         '
                           <table class="list1" style="border-collapse: collapse; width: 784px; border-top-width: 1px; border-top-style: solid; border-top-color: rgb(221, 221, 221); border-left-width: 1px; border-left-style: solid; border-left-color: rgb(221, 221, 221); margin-bottom: 20px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; line-height: normal; background-color: rgb(246, 246, 246);">
	<thead>
		<tr>
			<td class="center" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px; text-align: center;">&nbsp;</td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">Loading date</td>
			<td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 0px 5px;">Trailer</td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">Loading Country</td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">Region / state</td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">City / area</td>
			<td class="right" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 7px; text-align: right;">Offloading Country</td>
			<td class="right" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 7px; text-align: right;">Region / state</td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">City / area</td>
			<td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 0px 5px;">View</td>
			<td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 0px 5px;">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr style="cursor: pointer;">
			<td class="center" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181); text-align: center;">
                            <img src="www.myspedition.net/image/freight.png" width="25" height="25" alt="" style="padding: 1px; border: 1px solid #DDDDDD;">
                            </td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"> '.  $loading_date  .'  </td>
			<td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 0px 5px; background-color: rgb(231, 251, 181);">'. $trailer_type["name"] .'</td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"><img src="http://www.myspedition.net/image/flags/'. strToLower($loading_country["iso_code_2"]) .'.png" /> '. $loading_country["name"] .' </td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"> '. $loading_zone_name .' </td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"> '. $freight["loading_city"] .' </td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"><img src="http://www.myspedition.net/image/flags/'. strToLower($offloading_country["iso_code_2"]) .'.png" /> '. $offloading_country["name"] .'</td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);">'. $offloading_zone_name .'</td>
			<td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);">'. $freight["offloading_city"] .'</td>
			<td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 0px 5px; background-color: rgb(231, 251, 181);"><a href="http://www.myspedition.net/?route=product/freight&product_id='. $freight["freight_id"] .'" style="color: rgb(56, 176, 227); cursor: pointer;" target="_blank"><img src="http://www.myspedition.net/image/zoom.png" width="30"></a></td>
			<td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 0px 5px; background-color: rgb(231, 251, 181);">&nbsp;</td>
		</tr>
	</tbody>
</table>
';       

                        
                     //   echo  $message;
                        
                        //******************************************************************
                        
                        $mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
                        
			
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender('Myspediiton.net');
                        $mail->setSubject('New Freights available on Myspedition.net');
                        
			$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			

                        foreach($customers as $customer)
                            {
                           // echo $customer['email'] ."<br>";
                            $mail->setTo($customer['email']);
                            $mail->send(); 
                            } 
                 
	}
        
   public function sendTrucksToCustomers($truck_id) {
        
                        $this->load->model('customer/customer');
                        $this->load->model('localisation/country');
                        $this->load->model('localisation/zone');
                        $this->load->model('catalog/truck');
                        $this->load->model('catalog/storedTexts');
                        $this->load->model('catalog/treiler');

                        $storedText = $this->model_catalog_storedTexts->getStoredText('trucksMail'); 
                        
                        
                        
                                
                        //******************************************************************
                        
                        $truck = $this->model_catalog_truck->getProduct($truck_id);
                        
                        //******************************************************************
                        
                        $interestCountries = array();
                        
                        $interestCountries[] = $truck['loading_country_id'];
                        $interestCountries[] = $truck['offloading_country_id'];
                      
                      
                        $data = array(
				'freightsMail'        => '0',
				'trucksMail'              => '1',
				'productsMail'        => '0'	
			);
                        
                       // $emails = array();
                        $customers = $this->model_customer_customer->getCustomersByInterestCountries($data,$interestCountries); 
                        
                        //******************************************************************
                        
                        $loading_country = $this->model_localisation_country->getCountry($truck['loading_country_id']);
                        $offloading_country = $this->model_localisation_country->getCountry($truck['offloading_country_id']);
                        $loading_zone = $this->model_localisation_zone->getZone($truck['loading_zone_id']);
                        $offloading_zone = $this->model_localisation_zone->getZone($truck['offloading_zone_id']);
                        $trailer_type = $this->model_catalog_treiler->getTreiler( $truck['trailer_type_id'] );
                        
                        $loading_zone_name = "---";
                        if( isset($loading_zone['name']) )
                        {
                            $loading_zone_name =  $loading_zone['name'];
                        }
                        
                        $offloading_zone_name = "---";
                        if( isset($offloading_zone['name']) )
                        {
                            $offloading_zone_name =  $offloading_zone['name'];
                        }
                        
                        $loading_date= "[Regular]<br> (Every Week, Month) ";
                        if( $truck['frequency'] == 0 )
                        {
                            $loading_date =  $truck["loading_date"];
                        }
                        
                        $message = '';
                        if ( isset($storedText['text']) ) $message = $storedText['text'] . "<br>";
                        
                        $message .=          
    ' <table class="list1" style="border-collapse: collapse; width: 784px; border-top-width: 1px; border-top-style: solid; border-top-color: rgb(221, 221, 221); border-left-width: 1px; border-left-style: solid; border-left-color: rgb(221, 221, 221); margin-bottom: 20px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; line-height: normal; background-color: rgb(246, 246, 246);">
            <thead>
                    <tr>
                            <td class="center" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px; text-align: center;">&nbsp;</td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">Loading date</td>
                            <td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 0px 5px;">Trailer</td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">Loading Country</td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">Region / state</td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">City / area</td>
                            <td class="right" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 7px; text-align: right;">Offloading Country</td>
                            <td class="right" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 7px; text-align: right;">Region / state</td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 2px;">City / area</td>
                            <td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 0px 5px;">View</td>
                            <td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); background-color: rgb(239, 239, 239); padding: 0px 5px;">&nbsp;</td>
                    </tr>
            </thead>
            <tbody>
                    <tr style="cursor: pointer;">
                            <td class="center" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181); text-align: center;">
                                <img src="www.myspedition.net/image/truck.png" width="25" height="25" alt="" style="padding: 1px; border: 1px solid #DDDDDD;">                            
                            </td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"> '.  $loading_date  .'  </td>
                            <td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 0px 5px; background-color: rgb(231, 251, 181);">'. $trailer_type["name"] .'</td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"><img src="http://www.myspedition.net/image/flags/'. strToLower($loading_country["iso_code_2"]) .'.png" /> '. $loading_country["name"] .' </td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"> '. $loading_zone_name .' </td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"> '. $truck["loading_city"] .' </td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);"><img src="http://www.myspedition.net/image/flags/'. strToLower($offloading_country["iso_code_2"]) .'.png" /> '. $offloading_country["name"] .'</td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);">'. $offloading_zone_name .'</td>
                            <td class="left" style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 2px; background-color: rgb(231, 251, 181);">'. $truck["offloading_city"] .'</td>
                            <td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 0px 5px; background-color: rgb(231, 251, 181);"><a href="http://www.myspedition.net/?route=product/truck&product_id='. $truck["truck_id"] .'" style="color: rgb(56, 176, 227); cursor: pointer;" target="_blank"><img src="http://www.myspedition.net/image/zoom.png" width="30"></a></td>
                            <td style="border-right-width: 1px; border-right-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(221, 221, 221); vertical-align: middle; padding: 0px 5px; background-color: rgb(231, 251, 181);">&nbsp;</td>
                    </tr>
            </tbody>
    </table>
    ';       


                        //******************************************************************
                        
                        $mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
                        
			
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender('Myspedition.net');
			$mail->setSubject('New Truck routes available on Myspedition.net');

			$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			

                        foreach($customers as $customer)
                            {
                           //  echo $customer['email'] ;
                            $mail->setTo($customer['email']);
                            $mail->send(); 
                            } 
                 
	}
        
	
}
?>