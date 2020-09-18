<?php 
class ControllerAccountPayment extends Controller { 
    
    public function index() {
    	$this->language->load('account/success');
          
    	$this->document->setTitle($this->language->get('heading_title'));
	$this->data['breadcrumbs'] = array();
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),       	
        	'separator' => false
      	); 

        
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_success'),
			'href'      => $this->url->link('account/payment'),
        	'separator' => $this->language->get('text_separator')
      	);

    	$this->data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('account/customer_group');
	
                
       /* 
          if ( isset( $this->session->data['customer_id_to_pay'] ) )
           {
            $customer_id = $this->session->data['customer_id_to_pay'];
           }
           else{
               $this->redirect($this->url->link('cst/nwr', '', 'SSL'));
           } 
        */
                
           if ( isset( $this->request->post['customer_id'] ) )
           {
            $customer_id = $this->request->post['customer_id'];
            $this->session->data['payment_customer_id'] = $customer_id ;
           }
           else{
               $this->redirect($this->url->link('cst/nwr', '', 'SSL'));
           }

           if ( isset( $this->request->post['customer_group'] ) )
                {
                 $requested_customer_group_id = $this->request->post['customer_group'];
                  $this->session->data['requested_customer_group_id'] = $requested_customer_group_id ;
                }
           else {
                $this->redirect($this->url->link('cst/nwr', '', 'SSL'));
                }

            $this->load->model('account/customer');
            $this->load->model('account/address');                             	 
            
            $customer = $this->model_account_customer->getCustomer($customer_id);  
            $address = $this->model_account_address->getAddressByCustomer($customer_id); 
           

            


                
            $this->session->data['$requested_customer_group_id'] = $requested_customer_group_id;
                
            $customer_group = $this->model_account_customer_group->getCustomerGroup( $requested_customer_group_id );
           
            $this->data['customer_group'] =  $customer_group;
            
            
            $this->data['address']= $address;
            $this->data['customer']= $customer;
           
            
            $this->data['button_continue'] = $this->language->get('button_continue');
        


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/payment.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/payment.tpl';
		} else {
			$this->template = 'default/template/account/payment.tpl';
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
        
     public function paypal() {
               /*  PHP Paypal IPN Integration Class Demonstration File
                *  4.16.2005 - Micah Carrick, email@micahcarrick.com
                *
                *  This file demonstrates the usage of paypal.class.php, a class designed  
                *  to aid in the interfacing between your website, paypal, and the instant
                *  payment notification (IPN) interface.  This single file serves as 4 
                *  virtual pages depending on the "action" varialble passed in the URL. It's
                *  the processing page which processes form data being submitted to paypal, it
                *  is the page paypal returns a user to upon success, it's the page paypal
                *  returns a user to upon canceling an order, and finally, it's the page that
                *  handles the IPN request from Paypal.
                *
                *  I tried to comment this file, aswell as the acutall class file, as well as
                *  I possibly could.  Please email me with questions, comments, and suggestions.
                *  See the header of paypal.class.php for additional resources and information.
               */

              
         
               $this->load->model('tool/paypal');
               //$p = new paypal_class;             // initiate an instance of the class
              // $this->model_tool_paypal->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
               $this->model_tool_paypal->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url

               // setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
               $this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

               // if there is not action variable, set the default action of 'process'
               if (empty($_GET['action'])) $_GET['action'] = 'process';  

               switch ($_GET['action']) {

                 case 'process':      
                      
                    if ( isset( $this->session->data['payment_customer_id'] ) && $this->session->data['payment_customer_id'])
                    {
                     $customer_id = $this->session->data['payment_customer_id'];
                     unset($this->session->data['payment_customer_id']);
                    }
                    else
                    {
                        $this->redirect($this->url->link('payment/paymentError', '', 'SSL'));
                    }
                    
                    if ( isset( $this->session->data['requested_customer_group_id'] ) )
                    {
                    $requested_customer_group_id = $this->session->data['requested_customer_group_id'];
                    unset($this->session->data['requested_customer_group_id']);
                    }
                    else
                    {
                        $this->redirect($this->url->link('payment/paymentError', '', 'SSL'));
                    }

                    
                    $this->load->model('account/customer');
                    $this->load->model('account/customer_group');
                    $this->load->model('account/address');                             	 

                    $customer = $this->model_account_customer->getCustomer($customer_id);  
                    $address = $this->model_account_address->getAddressByCustomer($customer_id); 
                    
                    $customer_group = $this->model_account_customer_group->getCustomerGroup( $requested_customer_group_id );
           

                    $this->load->model('customer/customer_group_payment');
                     
                    $data= array();
                    $data['customer_group_id'] = $customer_group['customer_group_id'];
                    $data['customer_id'] =$customer['customer_id'];
                    $data['price'] = $customer_group['registration_price'];
                    
                    $data['description'] = '';
                    $customer_group_payment_id = $this->model_customer_customer_group_payment->addCustomerGroupPayment( $data );
                    
                    
                    $this->model_account_customer->editRequestedCustomerGroupId(
                            $customer['customer_id'],$requested_customer_group_id );
                     
                    
                     $this->model_tool_paypal->add_field('cmd', '_ext-enter');
                     $this->model_tool_paypal->add_field('redirect_cmd', '_xclick');
                     $this->model_tool_paypal->add_field('upload', '1');
                     //$this->model_tool_paypal->add_field('business', 'payments@myspedition.net');
                     //$this->model_tool_paypal->add_field('business', 'karagozidis@hotmail.com');
                     $this->model_tool_paypal->add_field('business', 'payment@myspedition.net');
                     $this->model_tool_paypal->add_field('item_name', $customer_group['name']);
                     $this->model_tool_paypal->add_field('item_number', $customer['customer_id']);
                     
                     $this->model_tool_paypal->add_field('amount', $customer_group['registration_price']);
                     $this->model_tool_paypal->add_field('no_shipping', '2');
                     $this->model_tool_paypal->add_field('first_name', $customer['firstname']);
                     $this->model_tool_paypal->add_field('last_name', $customer['lastname']);
                     $this->model_tool_paypal->add_field('address1', $address['address_1']);
                     $this->model_tool_paypal->add_field('address2', $address['address_2']);
                     
                     $this->model_tool_paypal->add_field('city', $address['city'] );
                     $this->model_tool_paypal->add_field('zip', $address['postcode']);
                     $this->model_tool_paypal->add_field('country',  $address['country_id'] );
                     $this->model_tool_paypal->add_field('address_override', '0');
                     $this->model_tool_paypal->add_field('email', $customer['email']);
                     $this->model_tool_paypal->add_field('lc', 'lc');
                     $this->model_tool_paypal->add_field('currency_code', 'EUR');
                     
                     $this->model_tool_paypal->add_field('rm', '2');
                     $this->model_tool_paypal->add_field('no_note', '1');
                     $this->model_tool_paypal->add_field('charset', 'utf-8');
                     //$this->model_tool_paypal->add_field('cancel_return', 'http://www.myspedition.net/index.php?route=information/information&information_id=13');
                     //$this->model_tool_paypal->add_field('notify_url', 'http://www.myspedition.net/index.php?route=payment/ipn');
                     //$this->model_tool_paypal->add_field('return', 'http://www.myspedition.net/index.php?route=information/information&information_id=12');
                     $this->model_tool_paypal->add_field('cancel_return', 'http://www.myspedition.net/index.php?route=account/payment/paypal&action=cancel&cgp='.$customer_group_payment_id);
                     $this->model_tool_paypal->add_field('notify_url', 'http://www.myspedition.net/index.php?route=account/payment/paypal&action=ipn&cgp='.$customer_group_payment_id);
                     $this->model_tool_paypal->add_field('return', 'http://www.myspedition.net/index.php?route=account/payment/paypal&action=success&cgp='.$customer_group_payment_id);
                     
                     $this->model_tool_paypal->add_field( 'custom', $customer['customer_id']."|".$customer['email']."|".$customer_group_payment_id );
     
                     
                     
                   /*  $this->model_tool_paypal->add_field('business', 'karagozidis@hotmail.com');
                     $this->model_tool_paypal->add_field('return', $this_script.'http://www.myspedition.net/index.php?route=information/information&information_id=12');
                     $this->model_tool_paypal->add_field('cancel_return', $this_script.'http://www.myspedition.net/index.php?route=information/information&information_id=13');
                     $this->model_tool_paypal->add_field('notify_url', $this_script.'http://www.myspedition.net/index.php?route=account/payment/ipn');
                     $this->model_tool_paypal->add_field('item_name', '1');
                     $this->model_tool_paypal->add_field('amount', '100'); */

                     $this->model_tool_paypal->submit_paypal_post(); // submit the fields to paypal
                     //$this->model_tool_paypal->dump_fields();      // for debugging, output a table of all the fields
                     break;

                  case 'success':      // Order was successful...
                        
                    // $data = explode('|', $this->request->post['custom']);
                      
                     $customer_group_payment_id =  $this->request->get['cgp'];
                     $this->load->model('customer/customer_group_payment');
                     $this->model_customer_customer_group_payment->successReceived($customer_group_payment_id);
                     
                    echo "<html>\n";
                    echo "<head><title>Success</title></head>\n";
                    echo "<body>\n";

                    echo "<center><h2>Welcome to myspedition premium users Group.<br>You will wait the myspedition technical department for a period of 24 hours to verify your payment.<br> Thank you.</h2></center>\n";
                    echo "<center><h2> ";
                        echo "<a href='?route=common/home' style='text-decoration:  none;' > ";
                            echo " Click here to go to the main page.";
                        echo "</a>";
                    echo "</h2></center>\n";

                    echo "<center><img src='image/paypal_l.png'></center>";

                    echo "</form>\n";
                    echo "</body></html>\n";
                     
                     // This is where you would probably want to thank the user for their order
                     // or what have you.  The order information at this point is in POST 
                     // variables.  However, you don't want to "process" the order until you
                     // get validation from the IPN.  That's where you would have the code to
                     // email an admin, update the database with payment status, activate a
                     // membership, etc.  

                     /*echo "<html><head><title>Success</title></head><body><h3>Thank you for your order.</h3>";
                     foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
                     echo "</body></html>"; */

                     // You could also simply re-direct them to another page, or your own 
                     // order status page which presents the user with the status of their
                     // order based on a database (which can be modified with the IPN code 
                     // below).

                     break;

                  case 'cancel':       // Order was canceled...
                                            
                     //$data = explode('|', $this->request->post['custom']);
                      
                     $customer_group_payment_id = $this->request->get['cgp'];
                     $this->load->model('customer/customer_group_payment');
                     $this->model_customer_customer_group_payment->cancelReceived($customer_group_payment_id);
                     
                     
                     
                            echo "<html>\n";
                            echo "<head><title>The order was canceled...</title></head>\n";
                            echo "<body>\n";
                            
                            echo "<center><h2>The order was canceled...</h2></center>\n";
                            echo "<center><h2> ";
                                echo "<a href='?route=common/home' style='text-decoration:  none;' > ";
                                    echo " Click here to go to the main page.";
                                echo "</a>";
                            echo "</h2></center>\n";
                             
                            echo "<center><img src='image/paypal_l.png'></center>";

                            echo "</form>\n";
                            echo "</body></html>\n";
                     

                    // echo "<html><head><title>Canceled</title></head><body><h3>The order was canceled.</h3>";
                    // echo "</body></html>"; 

                     break;

                  case 'ipn':          // Paypal is calling page for IPN validation...

                     // It's important to remember that paypal calling this script.  There
                     // is no output here.  This is where you validate the IPN data and if it's
                     // valid, update your database to signify that the user has payed.  If
                     // you try and use an echo or printf function here it's not going to do you
                     // a bit of good.  This is on the "backend".  That is why, by default, the
                     // class logs all IPN data to a text file.

                     if ($this->model_tool_paypal->validate_ipn()) {
                         
                       $data = explode('|', $this->request->post['custom']);
                       
                       $customer_group_payment_id = $data[2];// $this->request->get['customer_group_payment_id'];
                       $this->load->model('customer/customer_group_payment');
                       $this->model_customer_customer_group_payment->ipnReceived($customer_group_payment_id);
                     
                        // Payment has been recieved and IPN is verified.  This is where you
                        // update your database to activate or process the order, or setup
                        // the database with the user's order details, email an administrator,
                        // etc.  You can access a slew of information via the ipn_data() array.

                        // Check the paypal documentation for specifics on what information
                        // is available in the IPN POST variables.  Basically, all the POST vars
                        // which paypal sends, which we send back for validation, are now stored
                        // in the ipn_data() array.

                        // For this example, we'll just email ourselves ALL the data.
                        $subject = 'Instant Payment Notification - Received Payment';
                        $to = 'payment@myspedition.net';    //  your email
                        $body =  "An instant payment notification was successfully recieved\n";
                        $body .= "from ".$this->model_tool_paypal->ipn_data['payer_email']." on ".date('m/d/Y');
                        $body .= " at ".date('g:i A')."\n\nDetails:\n";

                        foreach ($this->model_tool_paypal->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
                        mail($to, $subject, $body);
                     }
                     break;
                }     
        }     
}
?>