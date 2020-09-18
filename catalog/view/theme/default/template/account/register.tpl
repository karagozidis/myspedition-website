<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  
  
  <p><?php echo $text_account_already; ?></p>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
      
      

      

    <h2><?php echo $text_your_details; ?></h2>
    <div class="content">
      <table class="form">
        <tr>
          <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>
          <td><input type="text" name="firstname" value="<?php echo $firstname; ?>" />
            <?php if ($error_firstname) { ?>
            <span class="error"><?php echo $error_firstname; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
          <td><input type="text" name="lastname" value="<?php echo $lastname; ?>" />
            <?php if ($error_lastname) { ?>
            <span class="error"><?php echo $error_lastname; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_email; ?></td>
          <td><input type="text" name="email" value="<?php echo $email; ?>" />
            <?php if ($error_email) { ?>
            <span class="error"><?php echo $error_email; ?></span>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_telephone; ?></td>
          <td><input type="text" name="telephone" value="<?php echo $telephone; ?>" />
            <?php if ($error_telephone) { ?>
            <span class="error"><?php echo $error_telephone; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_fax; ?></td>
          <td><input type="text" name="fax" value="<?php echo $fax; ?>" /></td>
        </tr>
        <tr>
          <td>Skype</td>
          <td><input type="text" name="skype" value="<?php echo $skype; ?>" /></td>
        </tr>
        
        <tr>
          <td>ICQ</td>
          <td><input type="text" name="icq" value="<?php echo $icq; ?>" /></td>
        </tr>
        
       <tr>
          <td>WebSite</td>
          <td><input type="text" name="website" value="<?php echo $website; ?>" /></td>
        </tr>
        
        <tr>
          <td><span class="required">*</span>
              <?php echo $text_general_company_name; ?>   
          </td>
          <td>
                <input type="text" name="main_company" value="<?php echo $main_company; ?>" />
            <?php if ($error_main_company) { ?>
                <span class="error">Company name must be between 3 and 100 characters!</span>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td>
              <?php echo $text_company_type; ?>   
          </td>
          <td>
             <select name="company_type_id">
              <?php foreach ($company_types as $company_type) { ?>
                  <?php  if ($company_type['company_type_id'] == $company_type_id ) { ?>
                    <option value="<?php echo $company_type['company_type_id']; ?>" selected><?php echo $company_type['name']; ?></option>  
                 <?php } else { ?>  
                    <option value="<?php echo $company_type['company_type_id']; ?>"><?php echo $company_type['name']; ?></option>  
                 <?php } ?>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
              <span id="main_country_id-required" class="required">*</span>
              <?php echo $text_company_country; ?>   
          </td>
          <td>
             <select name="main_country_id">
                  <option value="" selected>----</option>  
              <?php foreach ($countries as $country) { ?>
                  <?php  if ($country['country_id'] == $main_country_id ) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected><?php echo $country['name']; ?></option>  
                 <?php } else { ?>  
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>  
                 <?php } ?>
              <?php } ?>
            </select>
             <?php if ($error_main_country) { ?>
                <span class="error">Select country</span>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td> 
              <?php echo $text_company_description ?>
          </td>
          <td>
          <textarea rows="10" class="ckeditor" cols="70" name="main_description"><?php echo $main_description; ?></textarea>
          </td>
        </tr>      
      </table>
                    
    </div>
    <h2><?php echo $text_your_address; ?></h2>
    <div class="content">
      <table class="form">
        <!--<tr>
          <td><?php echo $entry_company; ?></td>
          <td><input type="text" name="company" value="<?php echo $company; ?>" /></td>
        </tr>   -->     
        <input type="hidden" name="company" value="" >
        <tr style="display: <?php echo (count($customer_groups) > 1 ? 'table-row' : 'none'); ?>;">
          <td><?php echo $entry_customer_group; ?></td>
          <td><?php foreach ($customer_groups as $customer_group) { ?>
            <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
            <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
            <label for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
            <br />
            <?php } else { ?>
            <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" />
            <label for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
            <br />
            <?php } ?>
            <?php } ?></td>
        </tr>      
        <tr id="company-id-display">
          <td><span id="company-id-required" class="required">*</span> <?php echo $entry_company_id; ?></td>
          <td><input type="text" name="company_id" value="<?php echo $company_id; ?>" />
            <?php if ($error_company_id) { ?>
            <span class="error"><?php echo $error_company_id; ?></span>
            <?php } ?></td>
        </tr>
        <tr id="tax-id-display">
          <td><span id="tax-id-required" class="required">*</span> <?php echo $entry_tax_id; ?></td>
          <td><input type="text" name="tax_id" value="<?php echo $tax_id; ?>" />
            <?php if ($error_tax_id) { ?>
            <span class="error"><?php echo $error_tax_id; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_address_1; ?></td>
          <td><input type="text" name="address_1" value="<?php echo $address_1; ?>" />
            <?php if ($error_address_1) { ?>
            <span class="error"><?php echo $error_address_1; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_address_2; ?></td>
          <td><input type="text" name="address_2" value="<?php echo $address_2; ?>" /></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_city; ?></td>
          <td><input type="text" name="city" value="<?php echo $city; ?>" />
            <?php if ($error_city) { ?>
            <span class="error"><?php echo $error_city; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span id="postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></td>
          <td><input type="text" name="postcode" value="<?php echo $postcode; ?>" />
            <?php if ($error_postcode) { ?>
            <span class="error"><?php echo $error_postcode; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_country; ?></td>
          <td><select name="country_id">
              <option value=""><?php echo $text_select; ?></option>
              <?php foreach ($countries as $country) { ?>
              <?php if ($country['country_id'] == $country_id) { ?>
              <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
            <?php if ($error_country) { ?>
            <span class="error"><?php echo $error_country; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_zone; ?></td>
          <td><select name="zone_id">
            </select>
            <?php if ($error_zone) { ?>
            <span class="error"><?php echo $error_zone; ?></span>
            <?php } ?></td>
        </tr>
      </table>
    </div>
    <h2><?php echo $text_your_password; ?></h2>
    <div class="content">
      <table class="form">
        <tr>
          <td><span class="required">*</span> <?php echo $entry_password; ?></td>
          <td><input type="password" name="password" value="<?php echo $password; ?>" />
            <?php if ($error_password) { ?>
            <span class="error"><?php echo $error_password; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_confirm; ?></td>
          <td><input type="password" name="confirm" value="<?php echo $confirm; ?>" />
            <?php if ($error_confirm) { ?>
            <span class="error"><?php echo $error_confirm; ?></span>
            <?php } ?></td>
        </tr>
      </table>
    </div>
    
             
    <h2><?php echo $entry_captcha; ?></h2>
    <div class="content">
      <table class="form">
        <tr>
          <td>
            <input type="text" name="captcha" value="<?php echo $captcha; ?>" />
          </td>
          <td>
            <img src="index.php?route=information/contact/captcha" alt="" />
            <?php if ($error_captcha) { ?>
            <span class="error"><?php echo $error_captcha; ?></span>
            <?php } ?>
          </td>
        </tr>       
      </table>
    </div>
    
    <h2><?php echo $text_newsletter; ?></h2>
    <div class="content">
      <table class="form">
        <tr>
          <td><?php echo $entry_newsletter; ?></td>
          <td><?php if ($newsletter) { ?>
            <input type="radio" name="newsletter" value="1" checked="checked" />
            <?php echo $text_yes; ?>
            <input type="radio" name="newsletter" value="0" />
            <?php echo $text_no; ?>
            <?php } else { ?>
            <input type="radio" name="newsletter" value="1" />
            <?php echo $text_yes; ?>
            <input type="radio" name="newsletter" value="0" checked="checked" />
            <?php echo $text_no; ?>
            <?php } ?>
          </td>
        </tr>
      </table>
    </div>
     
     <h2><?php echo $text_become_premium_user; ?></h2>

    <div class="content">
        
            <div class="show_hide"  style="border: 1px solid #EEEEEE;background: #E6E6E6;cursor: pointer;">
                <table>
                  <tr class="bottomline">
                      <td>
                          <img src="image/upgrade.png" width="100">
                      </td>
                      <td>
                         <img alt="" src="http://www.myspedition.net/image/data/ok.png" style="line-height: normal; text-align: center; width: 15px; height: 15px;" /><span style="font-size: 12px;"><span style="font-family: 'comic sans ms', cursive;">&nbsp;Get&nbsp;</span></span><span style="font-family: 'comic sans ms', cursive;">top View Priorities&nbsp;of your Freights , Trucks , Warehouses , Commerce products.</span><br>
                         <img alt="" src="http://www.myspedition.net/image/data/ok.png" style="line-height: normal; text-align: center; width: 15px; height: 15px;" />&nbsp;<span style="font-family: 'comic sans ms', cursive;">Receive&nbsp;notifications&nbsp;about your favorite destinations of&nbsp;Freights , Trucks and commerce products.</span><br>
                         <img alt="" src="http://www.myspedition.net/image/data/ok.png" style="line-height: normal; text-align: center; width: 15px; height: 15px;" /><span style="font-family: 'comic sans ms', cursive;">&nbsp;Assistance to establish new Corporations with other companies more Effectively &amp; Faster.</span>
                      </td>
                  </tr>
                </table>
            </div>
            
        <div class="slidingDiv" style="display: none;" >
                <table align="center" valign="top" > 
                  <tr  align="center" valign="top">
                   <?php  foreach($available_customer_groups as $customer_group) { ?>
                   <td  align="center" valign="top" style="padding: 15px;">
                     <table align="center" valign="top" >
                         <tr>
                             <td>    
                                <h2> <?php echo $customer_group['name'];  ?>  </h2>
                             </td>
                         </tr><tr>
                             <td>
                                 <?php echo html_entity_decode($customer_group['description']);  ?>  
                             </td>
                         </tr>
                         <!--<tr>
                             <td><b>
                                 <?php if($customer_group['registration_price'] == 0) { ?>
                                 Free
                                 <?php } else { ?>
                                 Only on:  
                                 <?php echo $customer_group['registration_price'];  ?>  $
                                 <?php } ?>
                             </b></td>
                         </tr>-->
                      </table> 
                     </td>
                    <?php } ?> 
                  </tr>
                </table>

              <table class="form">
                <tr>
                    <td>  
                       <h2> <?php echo $text_choose; ?> </h2>
                    </td>
                    <td>

                        <input type="hidden" id="payment" name="payment" value="0">
                        <select name="customer_group_id">
                         <?php  foreach($available_customer_groups as $customer_group) { ?>                 
                            <option 
                                value="<?php echo $customer_group['customer_group_id'];  ?>"
                                onclick="document.getElementById('payment').value='<?php echo $customer_group['registration_price'];  ?>';"                       
                            >
                               <?php echo $customer_group['name'];  ?>  
                            </option>
                        <?php } ?> 
                        </select>                  
                    </td>
                </tr>
              </table>   
       
        
            <table class="form1">
                <tr>
                    <td>
                    <a href="?route=information/information&information_id=10" target="_black">
                         See Users and prices in detail from Here  <img src="image/zoom.png" width="16">
                    </a>
                </td>
                </tr>
            </table>
      </div>         
    </div>  
     
     
    <?php if ($text_agree) { ?>
    <div class="buttons">
      <div class="right"><?php echo $text_agree; ?>
        <?php if ($agree) { ?>
        <input type="checkbox" name="agree" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="agree" value="1" />
        <?php } ?>
        <input type="submit" value="<?php echo $button_continue; ?>" class="button" />
      </div>
    </div>
    <?php } else { ?>
    <div class="buttons">
      <div class="right">
        <input type="submit" value="<?php echo $button_continue; ?>" class="button" />
      </div>
    </div>
    <?php } ?>
  </form>
  <?php echo $content_bottom; ?></div>


<script type="text/javascript">
 
$(document).ready(function(){
 
       <?php if( isset($search) ) 
       echo" $('.slidingDiv').show(); ";
             ?>
 
    $('.show_hide').click(function(){
    $(".slidingDiv").slideToggle();
    });
 
});
 
</script>

<script type="text/javascript" src="catalog/view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
$('input[name=\'customer_group_id\']:checked').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_required'] = '<?php echo $customer_group['company_id_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_required'] = '<?php echo $customer_group['tax_id_required']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('#company-id-display').show();
		} else {
			$('#company-id-display').hide();
		}
		
		if (customer_group[this.value]['company_id_required'] == '1') {
			$('#company-id-required').show();
		} else {
			$('#company-id-required').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('#tax-id-display').show();
		} else {
			$('#tax-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_required'] == '1') {
			$('#tax-id-required').show();
		} else {
			$('#tax-id-required').hide();
		}	
	}
});

$('input[name=\'customer_group_id\']:checked').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=account/register/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.colorbox').colorbox({
		width: 640,
		height: 480
	});
});
//--></script> 

<?php echo $footer; ?>