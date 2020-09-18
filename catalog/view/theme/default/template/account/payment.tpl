<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1>
          Pay Us Now Using PayPal or Credit card
     <!-- <?php echo $heading_title; ?> -->
  </h1>
    
   <h2>
         Customer
  </h2>
      <table>
          <tr>
                <td><b>First name</b></td>
                <td> <?php echo $customer['firstname']; ?> </td>
                <td><b>Last Name </b></td>
                <td> <?php echo $customer['lastname']; ?> </td>
          </tr>
          <tr>
                <td><b>Mail</b></td>
                <td> <?php echo $customer['email']; ?> </td>
          </tr>
          <tr>
                <td><b>Telephone</b></td>
                <td> <?php echo $customer['telephone']; ?> </td>
          </tr>
          <tr>
                <td><b>Fax</b></td>
                <td> <?php echo $customer['fax']; ?> </td>
          </tr>
          <tr>
                <td><b>company name</b></td>
                <td> <?php echo $customer['company']; ?> </td>
          </tr>                 
      </table>
    
     <br><br>
         
     <h2> Package </h2>
     <table>
          <tr>
                <td><b>User:</b></td>
                <td><b> <?php echo $customer_group['name']; ?> </b></td>
          </tr>
         <!-- <tr>
                <td><b>Description</b></td>
                <td> <?php echo html_entity_decode($customer_group['description']); ?> </td>
          </tr>-->
          <tr>
                <td><b>Price:</b></td>
                <td><b> <?php echo $customer_group['registration_price']; ?> euros </b></td>
          </tr>               
      </table>
      
  <!-- <?php echo $text_message; ?> -->
  <div>

        <br>Please pay us using PayPal - Follow these instructions. 

        <br><br>Log in to your Pay Pal account. If you don't have one please sign up for an account.
        <br>Select from the tabs, 'Send Money' 
        <br>Enter into the "TO" section our email address for PayPal: payment@myspedition.net
        <br>Then Enter the amount of your invoice in the amount section. Please pay in € EURO. 
        <br>Please tick Goods 
        <br>Press Continue 
        <br>Complete your preferred method of finalising the payment. Please remember to put your invoice details in the message of the Email to recipient so we can ensure we mark your payment! 
        <br>Complete your purchase by pressing the 'Send Money' button. 

        <br>An email will be forwarded to us and to you confirming your payment! 

        <br>Please note: All charges incurred for Pay Pal processing must be paid by the client. Pay Pal charge approx 3.4% of the payments made as a processing fee.

  </div>
  <br>
  
 <!-- <div class="buttons">
    <div class="right">
    <a href="<?php echo $continue; ?>" class="button">      
           <?php echo $button_continue; ?>        
    </a>
    </div>
  </div>-->
 
  <div class="middle">
      <br>
      
     <!-- <form method="post" action= "https://www.paypal.com/cgi-bin/webscr">
       <input type="hidden" name="cmd" value="_ext-enter">
       <input type="hidden" name="redirect_cmd" value="_xclick">-->
       <!-- <input type="hidden" name="cmd" value="_xclick" />-->
        <!--<input type="hidden" name="cmd" value="_cart" />-->
      <!-- <input type="hidden" name="upload" value="1" />
        <input type="hidden" name="business" value="karagozidis@hotmail.com" />
        
        <input type="hidden" name="item_name" value="<?php echo $customer_group['name']; ?>">
        <input type="hidden" name="item_number" value="<?php echo $customer['customer_id']; ?>">
        <input type="hidden" name="amount" value="<?php echo $customer_group['registration_price']; ?>">
        <input type="hidden" name="no_shipping" value="2">-->
        
        <!--<input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>" />-->
       <!-- <input type="hidden" name="first_name" value="<?php echo $customer['firstname']; ?> " />
        <input type="hidden" name="last_name" value="<?php echo $customer['lastname']; ?>" />
        <input type="hidden" name="address1" value="<?php echo $address['address_1']; ?>" />
        <input type="hidden" name="address2" value="<?php echo $address['address_2']; ?>" /> 
        <input type="hidden" name="city" value="<?php echo $address['city']; ?>" /> 
        <input type="hidden" name="zip" value="<?php echo $address['postcode']; ?>" /> 
        <input type="hidden" name="country" value="<?php echo $address['country_id']; ?>" />
        <input type="hidden" name="address_override" value="0" />
        <input type="hidden" name="email" value="<?php echo $customer['email'];?>" />-->
        <!-- <input type="hidden" name="invoice" value="<?php echo $invoice; ?>" /> -->
        <!--<input type="hidden" name="lc" value="<?php echo $lc; ?>" />
        <input type="hidden" name="rm" value="2" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="charset" value="utf-8" />
        <input type="hidden" name="cancel_return" value="http://www.myspedition.net/index.php?route=information/information&information_id=13">
        <input type="hidden" name="notify_url" value="http://www.myspedition.net/index.php?route=payment/ipn">
        <input type="hidden" name="return" value="http://www.myspedition.net/index.php?route=information/information&information_id=12">
        <!--<input type="hidden" name="paymentaction" value="<?php echo $paymentaction; ?>" />-->
      <!--  <input type="hidden" name="custom" value="<?php echo $customer['customer_id']; ?>-<?php echo $customer['email'];?>">
        
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
     </form>  -->
      
      
       <a href="?route=account/payment/paypal">
         <img alt="" border="0" src="image/paypal.png" >
       </a>
      
      
     <!--
     <form method="post" action= "https://www.paypal.com/cgi-bin/webscr">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="karagozidis@hotmail.com">
        <input type="hidden" name="item_name" value="<?php echo $customer_group['name']; ?>">
        <input type="hidden" name="item_number" value="<?php echo $customer['customer_id']; ?>">
        <input type="hidden" name="amount" value="<?php echo $customer_group['registration_price']; ?>">
        <input type="hidden" name="no_shipping" value="2">
        <input type="hidden" name="cancel_return" value="www.myspedition.net">
        <input type="hidden" name="notify_url" value="www.myspedition.net">
        <input type="hidden" name="custom" value="<?php echo $customer['customer_id']; ?>">
        <input type="hidden" name="return" value="www.myspedition.net">
        <input type="hidden" name="rm" value="2">  
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
     </form> 
     -->
    
   <!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="amount" value="25.00">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="PBPM3FYDE7TQE">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>-->
       
   
  </div>
  <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>
