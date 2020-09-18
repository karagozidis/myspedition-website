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
    <h1><img src="image/favoritecompany.png" width="30" /> <?php echo $heading_title; ?></h1>
  <div class="box1">
    <div class="heading">
      <!-- <?php if ( isset($country['name']) ) { ?>
       <div class="buttons1">
             <?php echo $country_selected_text; ?> <img src="image/flags/<?php echo strToLower($country['iso_code_2']); ?>.png" >
             <?php echo $country['name'] ?>  
             <a href="?route=customer/customer/main" class="button">
                   <?php echo $back_to_map_text; ?>
             </a>    
        </div>  
      <?php } else { ?>
        <div class="buttons1">
             <a href="?route=customer/customer/main" class="button">
                   <?php echo $back_to_map_text; ?>
             </a>  
        </div>
      <?php } ?> -->

    </div>
    <div class="content1">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr> 
               <td style="text-align: center;"></td>
               <td class="left">
                    <?php echo $country_text; ?> 
               </td>
               <td class="left">
                    <?php echo $company_name_text; ?>
               </td>
              <td>
              Type
              </td>
              <td class="left">
                    <?php echo $manager_name_text; ?>
              </td>
             <!-- <td class="left">
                  
                    <?php echo $description_text; ?>                         
              </td>   -->    
             <td colspan="2">                        
             </td>
            </tr>
          </thead>
          <tbody>
          
            <?php if ($customers) { ?>
            <?php foreach ($customers as $customer) { ?>
            <tr id="tr<?php echo $customer['customer_id']; ?>">                            
              <td style="text-align: center;"></td>
              <td class="left">
                  <img src="image/flags/<?php echo strtolower( $customer['country']['iso_code_2'] ); ?>.png">  
                  <?php echo $customer['country']['name']; ?>
              </td>       
              <td>
                  <?php if( $customer['verified'] == 3 ) { ?>
                  <img src="image/getverified.png" width="20">
                  <?php } ?>
                  <?php echo $customer['company']; ?>
              </td>
              <td>
                  <?php echo $customer['company_type']['name']; ?>
              </td>
              <td class="left"><?php echo $customer['name']; ?></td>
            <!--  <td class="left">                
                  <?php echo substr($customer['description'], 0, 100) . " ......";    ?>
              </td>    -->  
            <td class="center">
                <?php $customer_id = $customer['customer_id'];  ?>
                <a onclick="removeFavorite('<?php echo $customer_id; ?>');">
                  <img src="image/delete.png" width="20">
                </a>
              </td>
              <td class="right">
                  <?php foreach ($customer['action'] as $action) { ?>
                  <a href="<?php echo $action['href']; ?>" class="button" target="_blank"><?php echo $view_text; ?></a> 
                  <?php } ?>
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
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
function removeFavorite(id) {
 if (!confirm('Are you sure?')) {
    return;
    } 
addToInterestCompany(id);
$('#tr' + id).fadeOut('slow');
//$('#tr' + id).remove();
}
//--></script>


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