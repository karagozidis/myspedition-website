<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box1">
    <div class="heading">
      <h1><img src="image/company.png" width="25" /> <?php echo $heading_title; ?></h1>
      
      <?php if ( isset($country['name']) ) { ?>
        <div class="buttons1">
             <?php echo $country_selected_text; ?> <img src="image/flags/<?php echo strToLower($country['iso_code_2']); ?>.png" >
             <?php echo $country['name'] ?>  
             <a href="?route=customer/warehouse/main" class="button">
                   << Back to map
             </a>     
        </div>
      <?php } else { ?>
        <div class="buttons1">
             <a href="?route=customer/warehouse/main" class="button">
                   << Back to map
             </a>  
        </div>
      <?php } ?>
      
    </div>
    <div class="content1">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr> 
               <td>
                    Country 
               </td>
               <td>
                   Region 
               </td>
              <td>
                   City
              </td>
              <td>
                    Address
              </td>
              <td>
                    M2          
              </td>
              <td>
                   Height               
              </td>              
              <td>
                    Owner                          
              </td>
              <td></td>
            </tr>
          </thead>
          <tbody>
          
            <?php if ( isset($warehouses) ) { ?>
            <?php foreach ($warehouses as $warehouse) { ?>
            <tr>                             
              <td class="left">
                  <img src="image/flags/<?php echo $warehouse['country_image']; ?>"> 
                 <?php echo $warehouse['country']; ?>
                 <!-- <img src="image/flags/<?php echo strtolower( $customer['country']['iso_code_2'] ); ?>.png">  
                  <?php echo $warehouse['country']['name']; ?> -->
              </td>       
              <td>
                  <?php echo $warehouse['zone']; ?>
              </td>
              <td>
                  <?php echo $warehouse['city']; ?>
              </td>
              <td>
                  <?php echo $warehouse['address_1']; ?>
              </td>
              <td>
                  <?php echo $warehouse['squaremeters']; ?>
              </td>
              <td>                
                  <?php echo $warehouse['wh_height']; ?>
              </td>              
              <td class="right">
                  <?php echo $warehouse['customer']['company'];  ?>
              </td>
              <td>
                  <a href="?route=customer/warehouse/view&address_id=<?php echo $warehouse['address_id']; ?>" class="button">
                        View
                  </a>  
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="10">
                  <?php echo $text_no_results; ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=sale/customer&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_email = $('input[name=\'filter_email\']').attr('value');
	
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
	
	var filter_customer_group_id = $('select[name=\'filter_customer_group_id\']').attr('value');
	
	if (filter_customer_group_id != '*') {
		url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
	}	
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}	
	
	var filter_approved = $('select[name=\'filter_approved\']').attr('value');
	
	if (filter_approved != '*') {
		url += '&filter_approved=' + encodeURIComponent(filter_approved);
	}	
	
	var filter_ip = $('input[name=\'filter_ip\']').attr('value');
	
	if (filter_ip) {
		url += '&filter_ip=' + encodeURIComponent(filter_ip);
	}
		
	var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	location = url;
}
//--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<?php echo $footer; ?> 