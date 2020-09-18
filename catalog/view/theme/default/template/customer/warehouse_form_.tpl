<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <!--<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">-->
    <h2><?php echo $text_edit_address; ?></h2>
    <div class="content">
        
        <table>
            <tr>
                <td>
                    <a  href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                    <?php if($customer['company_logo'] == "") { ?>
                        <img src="image/companyLogo.png" width="120">
                    <?php } else { ?>
                        <img src="image/<?php echo $customer['company_logo'] ?>" width="120">
                    <?php } ?>
                    &nbsp;&nbsp;&nbsp;
                    </a>
                </td> 
                <td>
                    
                    <table>
                        <tr>                             
                            <td>
                                <a style="text-decoration: none;" href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                    <b>General Company Name:</b>
                                </a>
                            </td>
                            <td>
                                <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                    <input type="text" value="<?php echo $customer['company']; ?>" readonly>            
                               </a>
                            </td>
                            
                       </tr>
                       <tr>
                           <td>
                               <a style="text-decoration: none;" href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                <b>Owner:</b>
                               </a>
                           </td>
                            <td>
                               <a  href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                <input type="text" value="<?php echo $customer['firstname']; ?> <?php echo $customer['lastname']; ?>" readonly>       
                               </a>
                            </td> 
                        </tr>
                        <tr>

                            <td>
                              <a style="text-decoration: none;" href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                <b>Telephone:</b>
                              </a>       
                           </td>
                            <td>
                              <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                               <input type="text" value="<?php echo $customer['telephone']; ?>" readonly>                          
                              </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <a style="text-decoration: none;" href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                <b>Skype:</b>
                              </a>
                            </td>
                            <td> 
                              <a href="?route=customer/customer/update&customer_id=<?php echo $customer['customer_id']; ?>" target="_blank" >
                                <input type="text" value=" <?php echo $customer['skype']; ?>" readonly>                            
                              </a>
                            </td>
                        </tr>
                        
                    </table>
                
                </td>
            </tr>      
        </table>   
        
        
      <table class="form">
          
        <tr class="bottomline">
          <td></td>
          <td></td>
        </tr>
                 
        <tr>
          <td> <?php echo $entry_firstname; ?></td>
          <td>
              <input type="text" name="firstname" value="<?php echo $firstname; ?>" readonly />
          </td>
        </tr>
        <tr class="bottomline" >
          <td><?php echo $entry_lastname; ?></td>
          <td>
              <input type="text" name="lastname" value="<?php echo $lastname; ?>" readonly />
          </td>
        </tr>
        <tr>
          <td><?php echo $entry_company; ?></td>
          <td>
              <input type="text" name="company" value="<?php echo $company; ?>" readonly />
          </td>
        </tr>
        <?php if ($company_id_display) { ?>
        <tr>
          <td><?php echo $entry_company_id; ?></td>
          <td>
              <input type="text" name="company_id" value="<?php echo $company_id; ?>" readonly />
          </td>
        </tr>
        <?php } ?>
        <?php if ($tax_id_display) { ?>
        <tr>
          <td><?php echo $entry_tax_id; ?></td>
          <td>
              <input type="text" name="tax_id" value="<?php echo $tax_id; ?>" readonly />
          </td>
        </tr>
        <?php } ?>
        <tr>
          <td><?php echo $entry_address_1; ?></td>
          <td>
              <input type="text" name="address_1" value="<?php echo $address_1; ?>" readonly /> 
          </td>
        </tr>
        <tr>
          <td><?php echo $entry_address_2; ?></td>
          <td>
              <input type="text" name="address_2" value="<?php echo $address_2; ?>" readonly />
          </td>
        </tr>
        <tr>
          <td><?php echo $entry_city; ?></td>
          <td>
              <input type="text" name="city" value="<?php echo $city; ?>" readonly />
          </td>
        </tr>
        <tr>
          <td>Telephone</td>
          <td>
              <input type="text" name="telephone" value="<?php echo $telephone; ?>" readonly />
          </td>
        </tr>
        <tr>
          <td><?php echo $entry_postcode; ?></td>
          <td>
              <input type="text" name="postcode" value="<?php echo $postcode; ?>" readonly />
          </td>
        </tr>
        <tr>
          <td><?php echo $entry_country; ?></td>
          <td>
              <input type="text" value="<?php echo $country['name']; ?>" name="country" readonly >
          </td>
        </tr>
        <tr class="bottomline" >
          <td><?php echo $entry_zone; ?></td>
          <td>
            <input type="text" value="<?php echo $zone['name']; ?>" name="country" readonly >
          </td>
        </tr>
         
        <tr>
            <td colspan="2">
             <b> Warehouse features </b>
            </td>
        </tr>
        <tr>
            <td>  
                Warehouse Type 
            </td>
            <td>
                <input style="width:200px;" type="text" name="squaremeters" value="<?php echo $warehouse_type['name']; ?>" readonly />
            </td>
        </tr>
        <tr>
            <td>  
                Warehouse Squaremeter 
            </td>
            <td>
                <input type="text" name="squaremeters" value="<?php echo $squaremeters; ?>" readonly />
            </td>
        </tr>
        <tr>
            <td>  
                Warehouse height
            </td>
            <td>
                <input type="text" name="wh_height" value="<?php echo $wh_height; ?>" readonly />
            </td>
        </tr>   
        <tr>
            <td>  
                Ramp number 
            </td>
            <td>
                <input type="text" name="wh_ramp_number" value="<?php echo $wh_ramp_number; ?>" readonly />
            </td>
        </tr>
        <tr>
            <td>  
                Industrial  floor 
            </td>
            <td>
                <?php if($wh_industrial_floor == 1) { ?>
                <img src="image/yes.png">
                 <!-- <input type="checkbox" name="wh_industrial_floor" value="1" checked=""> -->
                <?php } else { ?> 
                <img src="image/no.png">
                  <!--<input type="checkbox" name="wh_industrial_floor" value="1">-->
                <?php } ?>
            </td>
        </tr>
        
        <tr class="bottomline" >
            <td>  
               Firefighting 
            </td>
            <td>
                <?php if($wh_firefighting == 1) { ?>
                 <img src="image/yes.png">
                 <!-- <input type="checkbox" name="wh_firefighting" value="1" checked=""> -->
                <?php } else { ?>
                 <img src="image/no.png">
                  <!--<input type="checkbox" name="wh_firefighting" value="1">-->
                <?php } ?>
            </td>
        </tr>
       
        <tr>
            <td>
            <b>Area in map</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="content1" style="padding: 0px 0px 0px 0px" >
                    <div id="googleMap" style="width:300px;height:220px;"></div>
                </div>
            </td>
        </tr>
    
      </table>
    </div>
  </div>
  <!--</form>-->
  <?php echo $content_bottom; ?></div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript" src="catalog/view/javascript/gmap/gMapMarker.js"></script>

<script type="text/javascript">  
        loadMarker("<?php echo $lat; ?>","<?php echo $lng; ?>","#");
</script>



<script type="text/javascript">
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=account/address/country&country_id=' + this.value,
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
</script> 
<?php echo $footer; ?>